<?php

namespace Estudacom;

class Database
{
    /**
     * Read content from json file
     *
     * @param string $filename
     * @return ?array
     */
    public function readJsonFile(string $filename): ?array
    {
        try {
            $content = file_get_contents($filename);
        } catch (\Throwable $th) {
            return null;
        }

        return json_decode($content, false);
    }
} 