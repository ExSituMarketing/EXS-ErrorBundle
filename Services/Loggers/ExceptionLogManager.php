<?php

namespace EXS\ErrorBundle\Services\Loggers;

use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ExceptionLogManager
 * CDetermines where the log is persisted
 *
 * Created      03/09/2015
 * @author      Charles Weiss
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
class ExceptionLogManager
{

    /**
     * The 400 series logger
     * @var EXS\ErrorBundle\Services\Loggers\Exception4xxLogger
     */
    private $Exception4xxLogger;

    /**
     * The 500 series logger
     * @var EXS\ErrorBundle\Services\Loggers\Exception5xxLogger
     */
    private $Exception5xxLogger;

    /**
     * The constructor
     */
    public function __construct(Exception4xxLogger $Exception4xxLogger, Exception5xxLogger $Exception5xxLogger)
    {
        $this->Exception4xxLogger = $Exception4xxLogger;
        $this->Exception5xxLogger = $Exception5xxLogger;
    }

    /**
     * Method called to log an actual exception
     * Requires the request for debugging purposes and the exception
     *
     * @param  Symfony\Component\Debug\Exception\FlattenException $exception
     * @param  Symfony\Component\HttpFoundation\Request           $request
     * @return boolean
     */
    public function logException(FlattenException $exception, Request $request)
    {
        // Get the code
        $code = $this->getCode($exception);

        // Log the exception
        if ((strlen($code) > 0) && (substr($code, 0, 1) == 4)) {
            $this->Exception4xxLogger->logException($exception, $request);
        } else {
            $this->Exception5xxLogger->logException($exception, $request);
        }

        return;
    }

        /**
     * Method called to log an actual exception
     * Requires the request for debugging purposes and the exception
     *
     * @param  Symfony\Component\Debug\Exception\FlattenException $exception
     * @param  string $command
     * @return boolean
     */
    public function logConsoleException(FlattenException $exception, $command = '')
    {
        $this->Exception5xxLogger->logConsoleException($exception, get_class($command));
        return;
    }
    
    /**
     * Get the type of exception to log (dictates entity)
     * @param  Symfony\Component\Debug\Exception\FlattenException $exception
     * @return string
     */
    public function getCode(FlattenException $exception)
    {
        if (method_exists($exception, 'getStatusCode') == true) {
            $code = $exception->getStatusCode();
        } else {
            $code = $exception->getCode();
        }

        return $code;
    }

}
