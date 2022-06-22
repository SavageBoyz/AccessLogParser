<?php


namespace App\Services;

/**
 * Сервис-прослойка для работы с массивами
 * Class ArrayServiceWrapper
 * @package App\Services
 */
class ArrayServiceWrapper
{
    /**
     * Проверяет, присутствует ли в массиве значение
     * @param mixed $needle - искомое значение
     * @param array $haystack - массив
     * @param bool $strict - проверка на соответствие типов
     * @return bool
     */
    public function inArray($needle, array $haystack, bool $strict = false): bool
    {
        return in_array($needle, $haystack, $strict);
    }

    /**
     * Проверяет, присутствует ли в массиве указанный ключ или индекс
     * @param string|int $key - проверяемое значение.
     * @param array $array - массив с проверяемыми ключами.
     * @return bool
     */
    public function arrayKeyExists(string $key, array $array): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * Подсчитывает количество элементов массива
     * @param array $value - массив или объект
     * @param int $mode
     * @return int
     */
    public function count(array $value, int $mode = COUNT_NORMAL): int
    {
        return count($value, $mode);
    }
}