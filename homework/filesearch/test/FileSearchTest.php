<?php

require_once dirname(__FILE__) . "/../app/MainScript.php";
require_once dirname(__FILE__) . "/../app/FileSearch.php";

use PHPUnit\Framework\TestCase;

class FileSearchTest extends TestCase
{

    private $searchFiles;
    private $fileName;
    private $fileSize;

    protected function setUp()
    {
        $this->searchFiles = new FileSearch();
        $this->fileName = "testfile";
        $this->fileSize = 4000;
    }

    public function testRegexSearch()
    {
        $result = $this->searchFiles->regexSearch($this->fileName,0);
        $this->assertEquals(['testfile.tst','testfile.txt'],$result);
    }

    public function testSizeSearch()
    {
        $files = $this->searchFiles->sizeSearch(1500,0);

        $result = [];
        foreach($files as $file) {
            $result[] = $file->getFileName();
        }
        $this->assertEquals(['testfile.txt'],$result);
    }

    public function testMostBigFiles()
    {
        $result = $this->searchFiles->getBigFiles(1);
        $this->assertEquals(['.\testfile.txt'=>2360],$result);
    }
}