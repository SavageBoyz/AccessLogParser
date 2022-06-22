<?php

namespace App\Entity;

class AccessLogFullInfo
{
    private int $_views = 0;

    private array $_uniqueUrls = [];

    private int $_trafficVolume = 0;

    private array $_crawlers = [];

    private array $_statusCodes = [];

    public function views()
    {
        return $this->_views;
    }

    public function increaseViews()
    {
        $this->_views++;
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

    public function addUniqueUrl($url)
    {
        $this->_uniqueUrls[] = $url;
        return $this;
    }

    public function crawlers()
    {
        return $this->_crawlers;
    }

    public function addCrawler($crawler, $count = 0) {
        $this->_crawlers[$crawler] = $count;
    }

    public function increaseCrawlerCount($crawler)
    {
        $this->_crawlers[$crawler]++;
    }

    public function statusCodes()
    {
        return $this->_statusCodes;

    }

    public function addStatusCode($statusCode, $count = 0)
    {
        $this->_statusCodes[$statusCode] = $count;
    }

    public function increaseStatusCodeCount($statusCode)
    {
        $this->_statusCodes[$statusCode]++;
    }
}