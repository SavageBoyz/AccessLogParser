<?php

namespace App\Services;

class FileServiceWrapper
{
    public function fileGetContents(string $filename, bool $use_include_path = false, ?resource $context = null, int $offset = 0, ?int $length = null): string|false
    {
        return file_get_contents($filename, $use_include_path, $context, $offset, $length);
    }

    public function file(string $fileName, int $flags = 0, ?resource $context = null): array|false
    {
        return file($fileName, $flags, $context);
    }
}