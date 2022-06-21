<?php

namespace App\Models;

class AccessLog
{
    private $_parsePattern;

    private $_allRecords;

    private $_uniqueUrls = [];

    private $_trafficVolume;

    private $_crawlers;

    private $_statusCodes = [];

    public function __construct(array $allRecords, $parsePattern)
    {
        $this->_allRecords = $allRecords;
        $this->_parsePattern = $parsePattern;
    }

    public function parsePattern()
    {
        return $this->_parsePattern;
    }

    public function allRecords()
    {
        return $this->_allRecords;
    }

    public function trafficVolume()
    {
        return $this->_trafficVolume;
    }

    public function uniqueUrls()
    {
        return $this->_uniqueUrls;
    }

    public function setTrafficVolume($trafficVolume)
    {
        $this->_trafficVolume = $trafficVolume;
    }
//    public function increaseTrafficVolume($value)
//    {
//        $this->_trafficVolume += $value;
//    }
}