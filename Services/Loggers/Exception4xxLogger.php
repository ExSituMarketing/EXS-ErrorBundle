<?php
namespace EXS\ErrorBundle\Services\Loggers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Exception\FlattenException;
use EXS\ErrorBundle\Entity\Exception4xx;
use EXS\ErrorBundle\Services\Utils\Flattener;

/**
 * Description of Exception5xxLogger
 *
 * Persists a 4xx series exception
 *
 * Created      03/09/2015
 * @author      Charles Weiss
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
class Exception4xxLogger extends ExceptionLogger
{

    /**
     * Log the actual exception
     *
     * @param FlattenException $exception
     * @param Request          $request
     */
    public function logException(FlattenException $exception, Request $request)
    {
        $ex = new Exception4xx();
        $ex->setStatusCode($this->getStatusCode($exception));
        $ex->setMessage($exception->getMessage());
        $ex->setRequestUrl($request->getRequestUri());
        $ex->setReferrer($request->server->get('HTTP_REFERER'));
        $ex->setUserAgent($request->server->get('HTTP_USER_AGENT'));
        $ex->setRemoteIp($request->server->get('REMOTE_ADDR'));
        $ex->setMethod($request->server->get('REQUEST_METHOD'));
        $ex->setQueryString($request->server->get('QUERY_STRING'));
        $ex->setHostname($request->getHttpHost());
        $ex->setRequest(Flattener::flattenArrayToString($request->request->all()));

        $ex->setLogged(new \DateTime("now"));
        try {
            $manager = $this->registry->getManagerForClass('EXSErrorBundle:Exception4xx');
            $manager->persist($ex);
            //you dont want to flush the full entity manager. only the error.
            $manager->flush($ex);
        } catch (\Exception $e) {
            //silence
        }
    }

}
