<?php

namespace EXS\ErrorBundle\Services\Subscribers;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use EXS\ErrorBundle\Services\Loggers\ExceptionLogManager;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Debug\Exception\FlattenException;

/**
 * Class ExceptionSubscriber
 */
class ExceptionSubscriber implements  EventSubscriberInterface
{
    /**
     * The symfony kernel
     * @var \Symfony\Component\HttpKernel\Kernel
     */
    private $kernel;

    /**
     * The debug level
     * @var bool
     */
    private $debug = false;

    /**
     * The exception logger
     * @var EXS\ErrorBundle\Services\Loggers\ExceptionLogManager
     */
    private $logger;

    /**
     * @var boolean
     */
    private $logDeprecated;

    /**
     * Constructor
     *
     * @param Kernel              $kernel
     * @param ExceptionLogManager $logger
     */
    public function __construct(Kernel $kernel, ExceptionLogManager $logger,$deprecatedErrorLogging)
    {
        // Set the kernel
        $this->kernel = $kernel;

        // Set the debug level
        $this->debug = $this->kernel->isDebug();

        // Set the logger
        $this->logger = $logger;

        $this->logDeprecated = $deprecatedErrorLogging;

    }
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => array('onKernelException', 10),
            KernelEvents::REQUEST => array('onKernelRequest', 0),
            ConsoleEvents::COMMAND => array('onConsoleCommand', 0),
        ];
    }
    /**
     * Catch fatal error.
     * (used with register_shutdown_function)
     * @return void
     */
    public function errorAtShutdown()
    {
        $error = error_get_last();
        if (isset($error)) {
            $this->onAnyException(new \ErrorException($error['message'], $error['type'], 1, $error['file'], $error['line']));
        }
    }

    /**
     * Raise error on any php error found.
     *
     * @param  type            $level
     * @param  type            $message
     * @param  type            $file
     * @param  type            $line
     * @param  type            $context
     * @throws \ErrorException
     */
    public function errorToException($level = 0, $message = '', $file = null, $line = 0, $context = array())
    {
        $deprecated = false;
        switch ($level) {
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                $deprecated = true;
                $errors = "Deprecated";
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                $errors = "Notice";
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $errors = "Warning";
                break;
            case E_ERROR:
            case E_USER_ERROR:
                $errors = "Fatal Error";
                break;
            default:
                $errors = "Unknown Error";
                break;
        }

        error_log(sprintf("PHP %s: %s in %s on line %d", $errors, $message, $file, $line));
        //save any error
        if($this->logDeprecated || !$deprecated){
            return $this->onAnyException(new \ErrorException($message, 1, $level, $file, $line));
        } else {
            //silence deprecated errors
        }
    }

    /**
     * Use to log any controlled exception.
     *
     * @param  \Exception   $exception
     * @return Exception5xx
     */
    public function onAnyException(\Exception $exception)
    {
        $exception = FlattenException::create($exception);

        return $this->logException($exception, new Request());
    }

    /**
     * Executed on kernel event exception.
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) { // don't do anything if it's not the master request

            return;
        }

        // We get the exception object from the received event
        $exception = FlattenException::create($event->getException());

        // We get the request
        $request = $event->getRequest();

        // Process the exception
        return $this->logException($exception, $request);
    }

    /**
     * Register set_error_handler and register_shutdown_function on first event.
     * @param voids
     */
    public function onKernelRequest()
    {
        // Set the error handler
        set_error_handler(array($this, 'errorToException'));

        //to catch fatal error, set a shutdown function
        register_shutdown_function(array($this, 'errorAtShutdown'));
    }

    /**
     * Register set_error_handler and register_shutdown_function on first event.
     *
     * @param $event
     */
    public function onConsoleCommand($event)
    {
        set_error_handler(array($this, 'errorToException'));
        //to catch fatal error, set a shutdown function
        register_shutdown_function(array($this, 'errorAtShutdown'));
    }

    /**
     * Log the actual exception
     * Should catch any exception so we dont end up in recursion hell
     * Anything missed *should* be in the php error log file if set
     * @param FlattenException $exception
     * @param Request          $request
     */
    public function logException(FlattenException $exception, Request $request = null)
    {
        try {
            $this->logger->logException($exception, $request);
        } catch (\Exception $ex) {
            // Silence
        }
    }

}