<?php

namespace EXS\ErrorBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ErrorController extends Controller
{
    /**
     * @Route("/_test/error/silent", name="error_silent")
     */
    public function silentAction()
    {
        try {
            throw new \Exception("This exception is caught and logged without breaking the app.");
        } catch (\Exception $e) {
            $this->container->get("exs.exception_subscriber")->onAnyException($e);
        }

        $resp = $this->renderView('EXSErrorBundle:Error:index.html.twig', array());
        $response = new Response($resp);

        return $response;
    }

    /**
     * @Route("/_test/error/http/{code}", name="error_http_status")
     */
    public function badpageAction($code)
    {
        switch ($code) {
            case 403:
                throw new AccessDeniedHttpException(' 403 Test');
                break;
            case 404:
                throw new NotFoundHttpException('404 Test');
                break;
            case 405:
                throw new MethodNotAllowedHttpException(array());
                break;
            case 410:
                throw new GoneHttpException('410 Test');
                break;
            case 500:
            default:
                throw new \Exception('500 Test');
                break;
        }
    }

    /**
     * @Route("/_test/error/php/fatal", name="error_php_fatal")
     */
    public function phpFatalAction()
    {
        trigger_error('sample PHP Fatal', E_USER_ERROR);
    }

    /**
     * @Route("/_test/error/php/notice", name="error_php_notice")
     */
    public function phpNoticeAction()
    {
        trigger_error('sample PHP Notice', E_USER_NOTICE);
    }

}
