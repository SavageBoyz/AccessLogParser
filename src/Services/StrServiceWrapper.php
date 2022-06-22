<?php


namespace App\Services;


class StrServiceWrapper
{
    /**
     * @param string $haystack
     * @param string $needle
     * @param int $offset
     * @return int|false
     */
    public function strpos(string $haystack, string $needle, int $offset = 0)
    {
        return strpos($haystack, $needle, $offset);
    }
}