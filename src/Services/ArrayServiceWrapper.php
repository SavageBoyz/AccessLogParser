<?php


namespace App\Services;


class ArrayServiceWrapper
{
    public function inArray(mixed $needle, array $haystack, bool $strict = false): bool
    {
        return in_array($needle, $haystack, $strict);
    }
}