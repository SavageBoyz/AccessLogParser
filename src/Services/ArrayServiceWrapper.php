<?php


namespace App\Services;


class ArrayServiceWrapper
{
    /**
     * @param mixed $needle
     * @param array $haystack
     * @param bool $strict
     * @return bool
     */
    public function inArray($needle, array $haystack, bool $strict = false): bool
    {
        return in_array($needle, $haystack, $strict);
    }

    /**
     * @param string|int $key
     * @param array $array
     * @return bool
     */
    public function arrayKeyExists(string $key, array $array): bool
    {
        return array_key_exists($key, $array);
    }
}