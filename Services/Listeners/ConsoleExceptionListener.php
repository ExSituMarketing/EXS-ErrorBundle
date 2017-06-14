<?php

namespace EXS\ErrorBundle\Services\Listeners;

use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\Debug\Exception\FlattenException;
use EXS\ErrorBundle\Services\Loggers\ExceptionLogManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ConsoleExceptionListener
 *
 * Part of the Error LoggerBundle
 *
 * Listens for any console exception and persists it via doctrine entity
 *
 * Created      03/26/2015
 * @author      Charles Weiss
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
class ConsoleExceptionListener
{
    /**
     * The exception logger
     * @var EXS\ErrorBundle\Services\Loggers\ExceptionLogManager
     */
    private $logger;
    /**
     * Constructor
     *
     * @param Kernel              $kernel
     * @param ExceptionLogManager $logger
     */
    public function __construct(ExceptionLogManager $logger)
    {
        // Set the logger
        $this->logger = $logger;
    }

    public function onConsoleException(ConsoleExceptionEvent $event)
    {
        // Handle the exception
        try {
            $this->logger->logConsoleException(FlattenException::create($event->getException()), $event->getCommand());
        } catch (Exception $ex) {
            // Silence
        }
    }

}
