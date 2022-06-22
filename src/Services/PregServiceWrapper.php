<?php


namespace App\Services;


class PregServiceWrapper
{
    public function pregMatchAll(string $pattern, string $subject, array &$matches = null, int $flags = 0, int $offset = 0)
    {
        return preg_match_all($pattern, $subject, $matches, $flags, $offset);
    }

    /**
     * @param string $pattern
     * @param string $subject
     * @param array|null $matches
     * @param int $flags
     * @param int $offset
     * @return int|false
     */
    public function pregMatch(string $pattern, string $subject, array &$matches = null, int $flags = 0, int $offset = 0)
    {
        return preg_match($pattern, $subject, $matches, $flags, $offset);
    }
}