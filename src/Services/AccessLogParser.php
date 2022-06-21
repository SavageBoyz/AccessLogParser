<?php

namespace App\Services;

use App\Models\AccessLog;

class AccessLogParser
{
    private $_accessLog;
    private $_pregServiceWrapper;

    public function __construct(AccessLog $accessLog, PregServiceWrapper $pregServiceWrapper)
    {
        $this->_accessLog = $accessLog;
        $this->_pregServiceWrapper = $pregServiceWrapper;
    }

    public function getFullInfo() {
        $accessLogAllRecords = $this->_accessLog->allRecords();
        $accessLogParsePattern = $this->_accessLog->parsePattern();

        foreach($accessLogAllRecords as $key => $accessLogRecord) {
            $this->_pregServiceWrapper->pregMatchAll($accessLogParsePattern, $accessLogRecord, $matches);
        }
    }
}