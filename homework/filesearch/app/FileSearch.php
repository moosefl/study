<?php

require_once "MainScript.php";

class FileSearch
{
    const LIMIT = 10;

    private function getRecursiveIteratorIterator() : RecursiveIteratorIterator
    {
       return new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                '.',  FilesystemIterator::SKIP_DOTS | FilesystemIterator::KEY_AS_FILENAME | FilesystemIterator::CURRENT_AS_FILEINFO));
    }

    private function getAll() : array
    {
        $iterator = $this->getRecursiveIteratorIterator();
        $array = [];
        foreach ($iterator as $value) {
            $array[] = $iterator->key();
        }
        return $array;
    }

    public function regexSearch(string $fileName, int $offset) : array
    {
        $regexIterator = new RegexIterator(new ArrayIterator($this->getAll()),  '/^'.$fileName.'\b/i' );
        $limitIterator = new LimitIterator($regexIterator, $offset,self::LIMIT);

        if (iterator_count($limitIterator) <= 0) {
            throw new RuntimeException('Не найдены файлы');
        }

        $result = [];
        foreach ($limitIterator as $value) {
            $result[] = $value;
        }
        return $result;
    }

    public function sizeSearch(int $fileSize, int $offset) : array
    {
        $iterator = $this->getRecursiveIteratorIterator();

        $fileArray = [];
        foreach ($iterator as $file) {
            if($file->getSize() < $fileSize) {
                continue;
            }
            $fileArray[] = $file;
        }

        $arrayIterator = new ArrayIterator($fileArray);
        $limitIterator = new LimitIterator($arrayIterator, $offset,self::LIMIT);

        if (iterator_count($limitIterator) <= 0) {
            throw new RuntimeException('Файлов не найдено');
        }

        $result = [];

        foreach ($limitIterator as $value) {
            $result[] = $value;
        }
        return $result;
    }


    public function getBigFiles(int $filesCount) : array
    {
        $iterator = $this->getRecursiveIteratorIterator();

        $fileArray = [];

        foreach ($iterator as $file) {
           $fileArray[$file->getPathname()] = $file->getSize();
        }

        arsort($fileArray);
        return array_slice($fileArray,0, $filesCount);
    }
}
