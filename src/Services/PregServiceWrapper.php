<?php


namespace App\Services;


class PregServiceWrapper
{
    public function pregMatchAll(string $pattern, string $subject, array &$matches = null, int $flags = 0, int $offset = 0) : int|false
    {
        return preg_match_all($pattern, $subject, $matches, $flags, $offset);
    }
}