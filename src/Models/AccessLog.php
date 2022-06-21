<?php

namespace App\Models;

class AccessLog
{
    private $_parsePattern = null;
    private $_allRecords = [];
    private $_urls = [];
    private $_views = [];
    private $_traffics = [];
    private $_statusCodes = [];

    public function __construct(array $allRecords, $parsePattern)
    {
        $this->_allRecords = $allRecords;
        $this->_parsePattern = $parsePattern;
    }

    public function parsePattern() {
        return $this->_parsePattern;
    }

    public function allRecords() {
        return $this->_allRecords;
    }
}