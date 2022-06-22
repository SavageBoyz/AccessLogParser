<?php

namespace App\Services;

require_once 'src/Entity/AccessLogRecord.php';
require_once 'src/Entity/AccessLogFullInfo.php';

use App\Entity;

class AccessLogParser
{
    private const PARSE_PATTERN = '/(.+)\s-\s-\s\[(.+)\]\s"([a-zA-Z]+)\s(\S+)\s([^"]+)"\s(\d+)\s(\d+)\s"([^"]+)"\s"([^"]+)"/';

    private const VALID_MATCH_COUNT = 10;

    private const CROWLERS = [
        'Google' => 'Googlebot',
        'Bing' => 'Bingbot',
        'Yahoo' => 'Slurp',
        'DuckDuckGo' => 'DuckDuckBot',
        'Baidu' => 'Baiduspider',
        'Yandex' => 'YandexBot'
    ];

    private PregServiceWrapper $_pregServiceWrapper;

    private ArrayServiceWrapper $_arrayServiceWrapper;

    private StrServiceWrapper $_strServiceWrapper;

    public function __construct(PregServiceWrapper $pregServiceWrapper, ArrayServiceWrapper $arrayServiceWrapper, StrServiceWrapper $strServiceWrapper)
    {
        $this->_pregServiceWrapper = $pregServiceWrapper;
        $this->_arrayServiceWrapper = $arrayServiceWrapper;
        $this->_strServiceWrapper = $strServiceWrapper;
    }

    public function getFullInfo($fileContext): Entity\AccessLogFullInfo
    {
        $accessLogFullInfo = new Entity\AccessLogFullInfo();

        foreach ($fileContext as $key => $accessLogRecord) {
            $this->_pregServiceWrapper->pregMatch(self::PARSE_PATTERN, $accessLogRecord, $matches);

            if (count($matches) !== self::VALID_MATCH_COUNT) {
                continue;
            }

            $accessLogFullInfo->increaseViews();

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
            $accessLogFullInfoUniqueUrls = $accessLogFullInfo->uniqueUrls();

            if (count($accessLogFullInfoUniqueUrls) === 0 || !$this->_arrayServiceWrapper->inArray($accessLogRecordUrl, $accessLogFullInfoUniqueUrls)) {
                $accessLogFullInfo->addUniqueUrl($accessLogRecordUrl);
            }

            $accessLogRecordCode = $accessLogRecord->code();
            $accessLogFullInfoStatusCodes = $accessLogFullInfo->statusCodes();

            if ($this->_arrayServiceWrapper->arrayKeyExists($accessLogRecordCode, $accessLogFullInfoStatusCodes)) {
                $accessLogFullInfo->increaseStatusCodeCount($accessLogRecordCode);
            } else {
                $accessLogFullInfo->addStatusCode($accessLogRecordCode, 1);
            }

            if ($accessLogRecordCode === '200') {
                $accessLogRecordTraffic = $accessLogRecord->traffic();
                $accessLogFullInfo->increaseTrafficVolume($accessLogRecordTraffic);
            }

            $accessLogRecordUserAgent = $accessLogRecord->userAgent();
            $accessLogFullInfoCrawlers = $accessLogFullInfo->crawlers();

            foreach (self::CROWLERS as $crowler) {
                if (!$this->_arrayServiceWrapper->arrayKeyExists($crowler, $accessLogFullInfoCrawlers)) {
                    $accessLogFullInfo->addCrawler($crowler);
                }

                if ($this->_strServiceWrapper->strpos($accessLogRecordUserAgent, $crowler) !== false) {
                    $accessLogFullInfo->increaseCrawlerCount($crowler);
                    break;
                }
            }
        }

        return $accessLogFullInfo;
    }
}