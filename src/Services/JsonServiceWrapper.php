<?php


namespace App\Services;

/**
 * Class JsonServiceWrapper
 * @package App\Services
 */
class JsonServiceWrapper
{
    /**
     * Возвращает JSON-представление данных
     * @param mixed $value - значение, которое будет закодировано
     * @param int $flags - битовая маска, составляемая из значений
     * @param int $depth - устанавливает максимальную глубину. Должен быть больше нуля.
     * @return string|false
     */
    public function jsonEncode(mixed $value, int $flags = 0, int $depth = 512): string|false
    {
        return json_encode($value, $flags, $depth);
    }
}