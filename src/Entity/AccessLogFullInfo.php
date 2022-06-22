<?php

namespace App\Entity;

/**
 * Класс-сущность данных о access log
 * Class AccessLogFullInfo
 * @package App\Entity
 */
class AccessLogFullInfo
{
    /**
     * Количество хитов/просмотров
     * @var int
     */
    private int $_views = 0;

    /**
     * Количество уникальных url
     * @var string[]
     */
    private array $_uniqueUrls = [];

    /**
     * Объем трафика
     * @var int
     */
    private int $_trafficVolume = 0;

    /**
     * Запросы от поисковиков
     * @var array
     */
    private array $_crawlers = [];

    /**
     * Коды ответов
     * @var array
     */
    private array $_statusCodes = [];

    /**
     * Получение поля views
     * @return int
     */
    public function views(): int
    {
        return $this->_views;
    }

    /**
     * Икремент поля views
     * @return $this
     */
    public function increaseViews(): AccessLogFullInfo
    {
        $this->_views++;
        return $this;
    }

    /**
     * Получение поля trafficVolume
     * @return int
     */
    public function trafficVolume(): int
    {
        return $this->_trafficVolume;
    }

    /**
     * Икремент поля trafficVolume
     * @param int $value - значение инкремента
     * @return $this
     */
    public function increaseTrafficVolume(int $value): AccessLogFullInfo
    {
        $this->_trafficVolume += $value;
        return $this;
    }

    /**
     * Получение поля uniqueUrls
     * @return array
     */
    public function uniqueUrls(): array
    {
        return $this->_uniqueUrls;
    }

    /**
     * Добавление ссылки в uniqueUrls
     * @param string $url - ссылка
     * @return $this
     */
    public function addUniqueUrl(string $url): AccessLogFullInfo
    {
        $this->_uniqueUrls[] = $url;
        return $this;
    }

    /**
     * Получение поля crawlers
     * @return array
     */
    public function crawlers(): array
    {
        return $this->_crawlers;
    }

    /**
     * Добавление записи в crawlers
     * @param string $crawler - название crawler
     * @param int $count - значение
     * @return $this
     */
    public function addCrawler(string $crawler, int $value = 0): AccessLogFullInfo
    {
        $this->_crawlers[$crawler] = $value;
        return $this;
    }

    /**
     * Икремент значения в поле Crawler
     * @param string $crawler - название crawler
     * @return $this
     */
    public function increaseCrawler(string $crawler): AccessLogFullInfo
    {
        $this->_crawlers[$crawler]++;
        return $this;
    }

    /**
     * Получение statusCodes
     * @return array
     */
    public function statusCodes(): array
    {
        return $this->_statusCodes;

    }

    /**
     * Добавление записи в statusCodes
     * @param string $statusCode - код статуса
     * @param int $value - значение
     * @return $this
     */
    public function addStatusCode(string $statusCode, int $value = 0): AccessLogFullInfo
    {
        $this->_statusCodes[$statusCode] = $value;
        return $this;
    }

    /**
     * Икремент значения в поле statusCodes
     * @param string $statusCode
     * @return $this
     */
    public function increaseStatusCode(string $statusCode): AccessLogFullInfo
    {
        $this->_statusCodes[$statusCode]++;
        return $this;
    }
}