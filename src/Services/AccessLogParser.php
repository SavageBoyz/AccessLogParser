<?php

namespace App\Services;

require_once 'src/Entity/AccessLogRecord.php';
require_once 'src/Entity/AccessLogFullInfo.php';

use App\Entity;

/**
 * Сервис для парсинга access log
 * Class AccessLogParser
 * @package App\Services
 */
class AccessLogParser
{
    /**
     * Регулярное выражение для получения данных из access log записи
     */
    private const PARSE_PATTERN = '/(.+)\s-\s-\s\[(.+)\]\s"([a-zA-Z]+)\s(\S+)\s([^"]+)"\s(\d+)\s(\d+)\s"([^"]+)"\s"([^"]+)"/';

    /**
     * Валидный размер массива, полученного по регулярке
     */
    private const VALID_MATCH_COUNT = 10;

    /**
     * Поисковые системы и боты
     * <Поисковая система> => <Название бота поисковой системы>
     */
    private const CROWLERS = [
        'Google' => 'Googlebot',
        'Bing' => 'Bingbot',
        'Yahoo' => 'Slurp',
        'DuckDuckGo' => 'DuckDuckBot',
        'Baidu' => 'Baiduspider',
        'Yandex' => 'YandexBot'
    ];

    /**
     * Сервис-обертка для работы с регуляными выражениями
     * @var PregServiceWrapper
     */
    private PregServiceWrapper $_pregServiceWrapper;

    /**
     * Сервис-обертка для работы с массивами
     * @var ArrayServiceWrapper
     */
    private ArrayServiceWrapper $_arrayServiceWrapper;

    /**
     * Сервис-обертка для работы со строками
     * @var StrServiceWrapper
     */
    private StrServiceWrapper $_strServiceWrapper;

    /**
     * AccessLogParser constructor.
     * @param PregServiceWrapper $pregServiceWrapper - сервис-обертка для работы с регуляными выражениями
     * @param ArrayServiceWrapper $arrayServiceWrapper - сервис-обертка для работы с массивами
     * @param StrServiceWrapper  - сервис-обертка для работы со строками
     */
    public function __construct(PregServiceWrapper $pregServiceWrapper, ArrayServiceWrapper $arrayServiceWrapper, StrServiceWrapper $strServiceWrapper)
    {
        $this->_pregServiceWrapper = $pregServiceWrapper;
        $this->_arrayServiceWrapper = $arrayServiceWrapper;
        $this->_strServiceWrapper = $strServiceWrapper;
    }

    /**
     * Получение данных по access log
     * @param string[] $accessLogRows - строки access log
     * @return Entity\AccessLogFullInfo
     */
    public function getFullInfo(array $accessLogRows): Entity\AccessLogFullInfo
    {
        $accessLogFullInfo = new Entity\AccessLogFullInfo();

        foreach ($accessLogRows as $accessLogRecord) {
            $this->_pregServiceWrapper->pregMatch(self::PARSE_PATTERN, $accessLogRecord, $matches);

            if ($this->_arrayServiceWrapper->count($matches) !== self::VALID_MATCH_COUNT) {
                continue;
            }

            $accessLogRecord = $this->_getAccessLogRecord($matches);

            $accessLogFullInfo->increaseViews();
            $this->_addUrl($accessLogFullInfo, $accessLogRecord);
            $this->_addStatusCode($accessLogFullInfo, $accessLogRecord);
            $this->_increaseTrafficVolume($accessLogFullInfo, $accessLogRecord);
            $this->_addCrawler($accessLogFullInfo, $accessLogRecord);
        }

        return $accessLogFullInfo;
    }

    /**
     * Получение AccessLogRecord из массива совпавших значений
     * @param array $matches - массив совпавших значений
     * @return Entity\AccessLogRecord
     */
    private function _getAccessLogRecord(array $matches): Entity\AccessLogRecord
    {
        $accessLogRecord = new Entity\AccessLogRecord();
        $accessLogRecord->setIp($matches[1]);
        $accessLogRecord->setDate($matches[2]);
        $accessLogRecord->setType($matches[3]);
        $accessLogRecord->setUrl($matches[4]);
        $accessLogRecord->setVersion($matches[5]);
        $accessLogRecord->setCode($matches[6]);
        $accessLogRecord->setTraffic((int)$matches[7]);
        $accessLogRecord->setSourceUrl($matches[8]);
        $accessLogRecord->setUserAgent($matches[9]);

        return $accessLogRecord;
    }

    /**
     * Добавление ссылки в общую информацию
     * @param Entity\AccessLogFullInfo $accessLogFullInfo - общая информация о access log файле
     * @param Entity\AccessLogRecord $accessLogRecord - информация о текущей записи
     */
    private function _addUrl(Entity\AccessLogFullInfo $accessLogFullInfo, Entity\AccessLogRecord $accessLogRecord): void
    {
        $accessLogRecordUrl = $accessLogRecord->url();
        $accessLogFullInfoUniqueUrls = $accessLogFullInfo->uniqueUrls();

        if (count($accessLogFullInfoUniqueUrls) === 0 || !$this->_arrayServiceWrapper->inArray($accessLogRecordUrl, $accessLogFullInfoUniqueUrls)) {
            $accessLogFullInfo->addUniqueUrl($accessLogRecordUrl);
        }
    }

    /**
     * Добавление данных об статусе кода в общую информацию
     * @param Entity\AccessLogFullInfo $accessLogFullInfo - общая информация о access log файле
     * @param Entity\AccessLogRecord $accessLogRecord - информация о текущей записи
     */
    private function _addStatusCode(Entity\AccessLogFullInfo $accessLogFullInfo, Entity\AccessLogRecord $accessLogRecord): void
    {
        $accessLogRecordCode = $accessLogRecord->code();
        $accessLogFullInfoStatusCodes = $accessLogFullInfo->statusCodes();

        if ($this->_arrayServiceWrapper->arrayKeyExists($accessLogRecordCode, $accessLogFullInfoStatusCodes)) {
            $accessLogFullInfo->increaseStatusCode($accessLogRecordCode);
        } else {
            $accessLogFullInfo->addStatusCode($accessLogRecordCode, 1);
        }
    }

    /**
     * Добавление данных о трафике в общую информацию
     * @param Entity\AccessLogFullInfo $accessLogFullInfo - общая информация о access log файле
     * @param Entity\AccessLogRecord $accessLogRecord - информация о текущей записи
     */
    private function _increaseTrafficVolume(Entity\AccessLogFullInfo $accessLogFullInfo, Entity\AccessLogRecord $accessLogRecord): void
    {
        $accessLogRecordCode = $accessLogRecord->code();

        if ($accessLogRecordCode === '200') {
            $accessLogRecordTraffic = $accessLogRecord->traffic();
            $accessLogFullInfo->increaseTrafficVolume($accessLogRecordTraffic);
        }
    }

    /**
     * Добавление информации о ботах (user agent) в общую информацию
     * @param Entity\AccessLogFullInfo $accessLogFullInfo - общая информация о access log файле
     * @param Entity\AccessLogRecord $accessLogRecord - информация о текущей записи
     */
    private function _addCrawler(Entity\AccessLogFullInfo $accessLogFullInfo, Entity\AccessLogRecord $accessLogRecord): void
    {
        $accessLogRecordUserAgent = $accessLogRecord->userAgent();
        $accessLogFullInfoCrawlers = $accessLogFullInfo->crawlers();

        foreach (self::CROWLERS as $searchEngineName => $crowler) {
            if (!$this->_arrayServiceWrapper->arrayKeyExists($searchEngineName, $accessLogFullInfoCrawlers)) {
                $accessLogFullInfo->addCrawler($searchEngineName);
            }

            if ($this->_strServiceWrapper->strpos($accessLogRecordUserAgent, $crowler) !== false) {
                $accessLogFullInfo->increaseCrawler($searchEngineName);
                break;
            }
        }
    }
}