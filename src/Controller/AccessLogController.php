<?php


namespace App\Controller;

use App\Services\AccessLogParser;

class AccessLogController
{
    private $_accessLogParser;

    public function __construct(AccessLogParser $accessLogParser)
    {
        $this->_accessLogParser = $accessLogParser;
    }

    public function getFullInfo()
    {
        $accessLogParserFullInfo = $this->_accessLogParser->getFullInfo();
    }
}