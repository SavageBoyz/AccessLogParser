<?php


namespace App\Entity;

/**
 * Класс-сущность данных о выводе информации о access log
 * Class AccessLogOutput
 * @package App\Entity
 */
class AccessLogOutput
{
    /**
     * Количество хитов/просмотров
     * @var int
     */
    public int $views;

    /**
     * Количество уникальных url
     * @var int
     */
    public int $urls;

    /**
     * Объем трафика
     * @var int
     */
    public int $traffic;

    /**
     * Запросы от поисковиков
     * @var array
     */
    public array $crawlers;

    /**
     * Коды ответов
     * @var array
     */
    public array $statusCodes;

    /**
     * AccessLogOutput constructor.
     * @param int $views - количество хитов/просмотров
     * @param int $urls - количество уникальных url
     * @param int $traffic - объем трафика
     * @param array $crawlers - запросы от поисковиков
     * @param array $statusCodes - коды ответов
     */
    public function __construct(int $views, int $urls, int $traffic, array $crawlers, array $statusCodes)
    {
        $this->views = $views;
        $this->urls = $urls;
        $this->traffic = $traffic;
        $this->crawlers = $crawlers;
        $this->statusCodes = $statusCodes;
    }
}