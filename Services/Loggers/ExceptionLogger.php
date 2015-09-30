<?php

namespace EXS\ErrorBundle\Services\Loggers;

use Doctrine\Bundle\DoctrineBundle\Registry;
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
     * @var Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $registry;

    /**
     * The constructor
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $registry
     * @access public
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
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
