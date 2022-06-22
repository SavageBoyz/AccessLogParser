<?php

namespace App\Entity;

/**
 * Класс-сущность записи access log
 * Class AccessLogRecord
 * @package App\Entity
 */
class AccessLogRecord
{
    /**
     * IP
     * @var string
     */
    private string $_ip;

    /**
     * Дата обращения
     * @var string
     */
    private string $_date;

    /**
     * Тип запроса
     * @var string
     */
    private string $_type;

    /**
     * URL запроса
     * @var string
     */
    private string $_url;

    /**
     * HTTP версия
     * @var string
     */
    private string $_version;

    /**
     * Код ответа
     * @var string
     */
    private string $_code;

    /**
     * Объем трафика
     * @var int
     */
    private int $_traffic;

    /**
     * Источник запроса
     * @var string
     */
    private string $_sourceUrl;

    /**
     * Данные о user agent
     * @var string
     */
    private string $_userAgent;

    /**
     * Getter поля ip
     * @return string
     */
    public function ip(): string
    {
        return $this->_ip;
    }

    /**
     * Setter поля ip
     * @param string $ip - подставляемое значение
     * @return $this
     */
    public function setIp(string $ip): AccessLogRecord
    {
        $this->_ip = $ip;

        return $this;
    }

    /**
     * Getter поля date
     * @return string
     */
    public function date(): string
    {
        return $this->_date;
    }

    /**
     * Setter поля date
     * @param string $date - подставляемое значение
     * @return $this
     */
    public function setDate(string $date): AccessLogRecord
    {
        $this->_date = $date;

        return $this;
    }

    /**
     * Getter поля type
     * @return string
     */
    public function type(): string
    {
        return $this->_type;
    }

    /**
     * Setter поля type
     * @param string $type - подставляемое значение
     * @return $this
     */
    public function setType(string $type): AccessLogRecord
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * Getter поля url
     * @return string
     */
    public function url(): string
    {
        return $this->_url;
    }

    /**
     * Setter поля url
     * @param string $url - подставляемое значение
     * @return $this
     */
    public function setUrl(string $url): AccessLogRecord
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * Getter поля version
     * @return string
     */
    public function version(): string
    {
        return $this->_version;
    }

    /**
     * Setter поля version
     * @param string $version - подставляемое значение
     * @return $this
     */
    public function setVersion(string $version): AccessLogRecord
    {
        $this->_version = $version;
        return $this;
    }

    /**
     * Getter поля code
     * @return string
     */
    public function code(): string
    {
        return $this->_code;
    }

    /**
     * Setter поля code
     * @param string $code - подставляемое значение
     * @return $this
     */
    public function setCode(string $code): AccessLogRecord
    {
        $this->_code = $code;
        return $this;
    }

    /**
     * Getter поля traffic
     * @return string
     */
    public function traffic(): string
    {
        return $this->_traffic;
    }

    /**
     * Setter поля traffic
     * @param int $traffic - подставляемое значение
     * @return $this
     */
    public function setTraffic(int $traffic): AccessLogRecord
    {
        $this->_traffic = $traffic;
        return $this;
    }

    /**
     * Getter поля sourceUrl
     * @return string
     */
    public function sourceUrl(): string
    {
        return $this->_sourceUrl;
    }

    /**
     * Setter поля sourceUrl
     * @param string $sourceUrl - подставляемое значение
     * @return $this
     */
    public function setSourceUrl(string $sourceUrl): AccessLogRecord
    {
        $this->_sourceUrl = $sourceUrl;
        return $this;
    }

    /**
     * Getter поля userAgent
     * @return string
     */
    public function userAgent(): string
    {
        return $this->_userAgent;
    }

    /**
     * Setter поля userAgent
     * @param string $userAgent - подставляемое значение
     * @return $this
     */
    public function setUserAgent(string $userAgent): AccessLogRecord
    {
        $this->_userAgent = $userAgent;
        return $this;
    }
}