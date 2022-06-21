<?php

namespace App\Services;

use App\Models\AccessLog;

class AccessLogParser
{
    private $_accessLog;
    private $_pregServiceWrapper;
    private $_arrayServiceWrapper;

    public function __construct(AccessLog $accessLog, PregServiceWrapper $pregServiceWrapper, ArrayServiceWrapper $arrayServiceWrapper)
    {
        $this->_accessLog = $accessLog;
        $this->_pregServiceWrapper = $pregServiceWrapper;
        $this->_arrayServiceWrapper = $arrayServiceWrapper;
    }

    public function getFullInfo()
    {
        $accessLogAllRecords = $this->_accessLog->allRecords();
        $accessLogParsePattern = $this->_accessLog->parsePattern();

        foreach ($accessLogAllRecords as $key => $accessLogRecord) {
            $this->_pregServiceWrapper->pregMatchAll($accessLogParsePattern, $accessLogRecord, $matches);

            if (count($matches) !== 9) {
                continue;
            }
//
//            $uniqueUrls = $this->_accessLog->uniqueUrls();
//
//            //$this->_arrayServiceWrapper->inArray();
//
//            if (inArray())
//
//            $this->_accessLog->
//            var_dump($matches);
//            break;
        }
    }
}