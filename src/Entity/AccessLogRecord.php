<?php

namespace App\Entity;

class AccessLogRecord
{
    private $_ip;

    private $_date;

    private $_type;

    private $_url;

    private $_version;

    private $_code;

    private $_traffic;

    private $_sourceUrl;

    private $_userAgent;

    public function ip()
    {
        return $this->_ip;
    }

    public function setIp($ip)
    {
        $this->_ip = $ip;

        return $this;
    }

    public function date()
    {
        return $this->_date;
    }

    public function setDate($date)
    {
        $this->_date = $date;

        return $this;
    }

    public function type()
    {
        return $this->_type;
    }

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    public function url()
    {
        return $this->_url;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    public function version()
    {
        return $this->_version;
    }

    public function setVersion($version)
    {
        $this->_version = $version;
        return $this;
    }

    public function code()
    {
        return $this->_code;
    }

    public function setCode($code)
    {
        $this->_code = $code;
        return $this;
    }

    public function traffic()
    {
        return $this->_traffic;
    }

    public function setTraffic($traffic)
    {
        $this->_traffic = $traffic;
        return $this;
    }

    public function sourceUrl()
    {
        return $this->_sourceUrl;
    }

    public function setSourceUrl($sourceUrl)
    {
        $this->_sourceUrl = $sourceUrl;
        return $this;
    }

    public function userAgent()
    {
        return $this->_userAgent;
    }

    public function setUserAgent($userAgent)
    {
        $this->_userAgent = $userAgent;
        return $this;
    }
}