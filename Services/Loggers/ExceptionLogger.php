<?php

namespace EXS\ErrorBundle\Services\Loggers;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Exception\FlattenException;
use EXS\ErrorBundle\Services\Loggers\Interfaces\ExceptionLoggerInterface;

/**
 * Description ExceptionLogger
 * Abstract class for logging exceptions to entity
 *
 * Created      03/10/2015
 * @author      Charles Weiss
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
abstract class ExceptionLogger implements ExceptionLoggerInterface
{

    /**
     * The entity manager
     * @var Doctrine\ORM\EntityManager
     */
    protected $EntityManager;

    /**
     * The constructor
     * @param \Doctrine\ORM\EntityManager $EntityManager
     * @access public
     */
    public function __construct(EntityManager $EntityManager)
    {
        $this->EntityManager = $EntityManager;
    }

    /**
     * Implodes the trace into a readable string representation
     * @param  array  $trace
     * @return string
     */
    public function getTrace($trace = array())
    {
        $traceMessage = '';
        foreach ($trace as $t) {
            $traceMessage .= sprintf('  at %s line %s', $t['file'], $t['line']) . "\n";
        }

        return $traceMessage;
    }

    /**
     * Parses the server super global for command line arguments
     * Uses the command line arguments as the request
     * @param  Symfony\Component\HttpFoundation\Request $request
     * @return string
     */
    public function getRequest(Request $request)
    {
        $str = '';
        if (isset($_SERVER['argv'])) {
            $str = "$ " . implode(" ", filter_input(INPUT_SERVER, 'argv'));
        } elseif (!empty($request)) {
            $str = $request->getRequestUri();
        }

        return $str;
    }

    /**
     * Attempts to extract a nice exception code string
     * @param  FlattenException $exception
     * @return string
     */
    public function getStatusCode(FlattenException $exception)
    {
        $str = '';
        if (method_exists($exception, 'getStatusCode') == true) {
            $str = $exception->getStatusCode();
        } elseif (method_exists($exception, 'getCode') == true) {
         $str = $exception->getCode();
        }

        return $str;
    }

}
