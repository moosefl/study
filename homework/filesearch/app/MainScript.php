<?php

require_once "FileSearch.php";

class MainScript
{

    private $searchFiles;
    private $offset;
    private $limit;

    public function __construct()
    {
        $this->offset = 0;
        $this->limit = 10;
        $this->searchFiles = new FileSearch();
    }

    public function selectOption() : void
    {
        echo '1 - Искать по регулярному выражению (имя файла)' . PHP_EOL;
        echo '2 - Искать файлы больше указанного размера' . PHP_EOL;
        echo '3 - Искать самые большие по размеру файлы' . PHP_EOL;

        $select = trim(fgets(STDIN));
        switch ($select) {
            case '1':
                $this->input();
                break;
            case '2':
               $this->inputFileSize();
                break;
            case '3':
                $this->getLargestFiles();
                break;
            default:
                $this->input();
                break;
        }
    }

    private function output(array $data): void
    {
        foreach ($data as $string) {
            echo $string . PHP_EOL;
        }

        echo "Далее - n" . PHP_EOL;
    }

    private function input(): void
    {
        echo 'Укажите название файла:';

        $fileName = trim(fgets(STDIN));

        try {
            $this->output($this->searchFiles->regexSearch($fileName, $this->offset));

            while (trim(fgets(STDIN)) === 'n') {

                $this->offset = $this->offset + $this->limit;
                $this->output($this->searchFiles->regexSearch($fileName, $this->offset));

            }

        } catch (RuntimeException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    private function parseFileSize(string $line): int
    {
        $fileSize = explode(' ', $line);

        $fileSize[0] = intval($fileSize[0]);
        $result = 0;
        switch ($fileSize[1]) {
            case 'b':
                $result = $fileSize[0];
                break;
            case 'kb':
                $result = $fileSize[0] * 1024;
                break;
            case 'mb':
                $result = $fileSize[0] * pow(1024, 2);
                break;
            case 'gb':
                $result = $fileSize[0] * pow(1024, 3);
                break;
        }
        return $result;
    }

    private function inputFileSize(): void
    {
        echo 'Укажите размер файла (пример: 512 mb)' . PHP_EOL;
        echo 'Допустимые ключи: b, kb, mb, gb' . PHP_EOL;

        $line = trim(fgets(STDIN));

        $fileSize = $this->parseFileSize($line);
        try {
            $this->output($this->searchFiles->sizeSearch($fileSize, $this->offset));

            while (trim(fgets(STDIN)) === 'n') {

                $this->offset = $this->offset + $this->limit;
                $this->output($this->searchFiles->sizeSearch($fileSize, $this->offset));

            }
        } catch (RuntimeException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    private function getLargestFiles() : void
    {
        echo 'Укажите количество файлов' . PHP_EOL;

        $filesCount = intval(trim(fgets(STDIN)));

        $files = $this->searchFiles->getBigFiles($filesCount);
        foreach ($files as $pathName => $fileSize) {
            echo $pathName." == ".$fileSize . " b" . PHP_EOL;
        }
    }
}
