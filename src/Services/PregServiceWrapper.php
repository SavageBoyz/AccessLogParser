<?php


namespace App\Services;

/**
 * Class PregServiceWrapper
 * @package App\Services
 */
class PregServiceWrapper
{
    /**
     * Выполняет проверку на соответствие регулярному выражению
     * @param string $pattern - искомый шаблон в виде строки.
     * @param string $subject - входная строка
     * @param array|null $matches
     * @param int $flags
     * @param int $offset
     * @return int|false
     */
    public function pregMatch(string $pattern, string $subject, ?array &$matches = null, int $flags = 0, int $offset = 0): int|false
    {
        return preg_match($pattern, $subject, $matches, $flags, $offset);
    }
}