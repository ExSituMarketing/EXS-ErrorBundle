<?php
namespace EXS\ErrorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="exception5xx")
 */
class Exception5xx
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $statusCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $file;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $line;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $message;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $trace;

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
     * @return Exception5xx
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
     * Set file
     *
     * @param  string       $file
     * @return Exception5xx
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set line
     *
     * @param $line
     * @return Exception5xx
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return \integer
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set message
     *
     * @param  string       $message
     * @return Exception5xx
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
     * Set trace
     *
     * @param  string       $trace
     * @return Exception5xx
     */
    public function setTrace($trace)
    {
        $this->trace = $trace;

        return $this;
    }

    /**
     * Get trace
     *
     * @return string
     */
    public function getTrace()
    {
        return $this->trace;
    }

    /**
     * Set requestUrl
     *
     * @param  string       $requestUrl
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
     * @return Exception5xx
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
