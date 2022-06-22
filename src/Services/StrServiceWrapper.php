<?php


namespace App\Services;

/**
 * Class StrServiceWrapper
 * @package App\Services
 */
class StrServiceWrapper
{
    /**
     * Возвращает позицию первого вхождения подстроки
     * @param string $haystack - строка, в которой производится поиск.
     * @param string $needle - искомое значение
     * @param int $offset - смещение
     * @return int|false
     */
    public function strpos(string $haystack, string $needle, int $offset = 0): int|false
    {
        return strpos($haystack, $needle, $offset);
    }
}