<?php

namespace App\Entity;

class AccessLogFullInfo
{
    private $_views;

    private $_uniqueUrls = [];

    private $_trafficVolume;

    private $_crawlers;

    private $_statusCodes = [];

    public function views()
    {
        return $this->_views;
    }

    public function setViews($views)
    {
        $this->_views = $views;
        return $this;
    }

    public function trafficVolume()
    {
        return $this->_trafficVolume;
    }

    public function increaseTrafficVolume(int $value)
    {
        $this->_trafficVolume += $value;
        return $this;
    }

    public function uniqueUrls()
    {
        return $this->_uniqueUrls;
    }

    public function addUniqueUrls($url)
    {
        $this->_uniqueUrls[] = $url;
        return $this;
    }


    public function getParsePattern()
    {
        return self::PARSE_PATTERN;
    }

    public function getValidMatchCount()
    {
        return self::VALID_MATCH_COUNT;
    }
}