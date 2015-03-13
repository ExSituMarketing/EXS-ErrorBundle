<?php
namespace EXS\ErrorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="exception4xx")
 */
class Exception4xx
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $statusCode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $requestUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $referrer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $userAgent;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $remoteIp;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $method;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $queryString;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $hostname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $request;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $logged;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set statusCode
     *
     * @param  integer      $statusCode
     * @return Exception4xx
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get statusCode
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set message
     *
     * @param  string       $message
     * @return Exception4xx
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set requestUrl
     *
     * @param  string       $requestUrl
     * @return Exception4xx
     */
    public function setRequestUrl($requestUrl)
    {
        $this->requestUrl = $requestUrl;

        return $this;
    }

    /**
     * Get requestUrl
     *
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * Set referrer
     *
     * @param  string       $referrer
     * @return Exception4xx
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * Get referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set userAgent
     *
     * @param  string       $userAgent
     * @return Exception4xx
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set remoteIp
     *
     * @param  string       $remoteIp
     * @return Exception4xx
     */
    public function setRemoteIp($remoteIp)
    {
        $this->remoteIp = $remoteIp;

        return $this;
    }

    /**
     * Get remoteIp
     *
     * @return string
     */
    public function getRemoteIp()
    {
        return $this->remoteIp;
    }

    /**
     * Set method
     *
     * @param  string       $method
     * @return Exception4xx
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set queryString
     *
     * @param  string       $queryString
     * @return Exception4xx
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;

        return $this;
    }

    /**
     * Get queryString
     *
     * @return string
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Set hostname
     *
     * @param  string       $hostname
     * @return Exception4xx
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set request
     *
     * @param  string       $request
     * @return Exception4xx
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set logged
     *
     * @param  \DateTime    $logged
     * @return Exception4xx
     */
    public function setLogged($logged)
    {
        $this->logged = $logged;

        return $this;
    }

    /**
     * Get logged
     *
     * @return \DateTime
     */
    public function getLogged()
    {
        return $this->logged;
    }
}
