<?php

namespace EXS\ErrorBundle\Services\Loggers\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Exception\FlattenException;

/**
 * Description of ExceptionLoggerInterface
 *
 * Part of the Error LoggerBundle
 *
 * Abstraction for grabbing the accounts by affiliate
 *
 * Created      03/09/2015
 * @author      Charles Weiss
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
interface ExceptionLoggerInterface
{

    public function logException(FlattenException $exception, Request $request);

    public function getTrace($trace = array());
}
