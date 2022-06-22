<?php

namespace App\Services;

require_once 'src/Entity/AccessLogRecord.php';

use App\Entity;

class AccessLogParser
{
    private const PARSE_PATTERN = '/(.+)\s-\s-\s\[(.+)\]\s"([a-zA-Z]+)\s(\S+)\s([^"]+)"\s(\d+)\s(\d+)\s"([^"]+)"\s"([^"]+)"/';

    private const VALID_MATCH_COUNT = 9;

    private $_pregServiceWrapper;

    private $_arrayServiceWrapper;

    public function __construct(PregServiceWrapper $pregServiceWrapper, ArrayServiceWrapper $arrayServiceWrapper)
    {
        $this->_pregServiceWrapper = $pregServiceWrapper;
        $this->_arrayServiceWrapper = $arrayServiceWrapper;
    }

    public function getFullInfo($fileContext)
    {
        $accessLogFullInfo = new Entity\AccessLogFullInfo();
        $allRecordsCount = count($fileContext);
        $accessLogFullInfo->setViews($allRecordsCount);

        foreach ($fileContext as $key => $accessLogRecord) {
            $this->_pregServiceWrapper->pregMatchAll(self::PARSE_PATTERN, $accessLogRecord, $matches);

            if (count($matches) !== self::VALID_MATCH_COUNT) {
                continue;
            }

            $accessLogRecord = new Entity\AccessLogRecord();

            $accessLogRecord->setIp($matches[1]);
            $accessLogRecord->setDate($matches[2]); // TODO: Перевести в \DateTime()
            $accessLogRecord->setType($matches[3]);
            $accessLogRecord->setUrl($matches[4]);
            $accessLogRecord->setVersion($matches[5]);
            $accessLogRecord->setCode($matches[6]);
            $accessLogRecord->setTraffic($matches[7]);
            $accessLogRecord->setSourceUrl($matches[8]);
            $accessLogRecord->setUserAgent($matches[9]);

            $accessLogRecordUrl = $accessLogRecord->url();
            $accessLogUniqueUrls = $accessLogFullInfo->uniqueUrls();

            if (!$this->_arrayServiceWrapper->inArray($accessLogRecordUrl, $accessLogUniqueUrls)) {
                $accessLogFullInfo->addUniqueUrls($accessLogRecordUrl);
            }

            $accessLogRecordCode = $accessLogRecord->code();

            if ($accessLogRecordCode === '200') {
                $accessLogRecordTraffic = $accessLogRecord->traffic();
                $accessLogFullInfo->increaseTrafficVolume($accessLogRecordTraffic);
            }


        }
    }
}