<?php

namespace App\Services;

/**
 * Сервис-прослойка для работы с файлами
 * Class FileServiceWrapper
 * @package App\Services
 */
class FileServiceWrapper
{
    /**
     * Читает содержимое файла в строку
     * @param string $filename - имя читаемого файла.
     * @param bool $use_include_path
     * @param resource|null $context - корректный ресурс контекста
     * @param int $offset - смещение, с которого начнётся чтение оригинального потока
     * @param int|null $length - максимальный размер читаемых данных
     * @return string|false
     */
    public function fileGetContents(string $filename, bool $use_include_path = false, $context = null, int $offset = 0, ?int $length = null): string|false
    {
        return file_get_contents($filename, $use_include_path, $context, $offset, $length);
    }

    /**
     * Читает содержимое файла и помещает его в массив
     * @param string $fileName - путь к файлу.
     * @param int $flags
     * @param resource|null $context - ресурс
     * @return array|false
     */
    public function file(string $fileName, int $flags = 0, $context = null): array|false
    {
        return file($fileName, $flags, $context);
    }
}