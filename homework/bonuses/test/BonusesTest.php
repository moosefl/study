<?php

require_once dirname(__FILE__) . "/../app/Bonuses.php";

use PHPUnit\Framework\TestCase;

class BonusesTest extends TestCase
{
    private $testEmptyData;
    private $bonuses;
    private $emptyArray;
    private $arrayWithData;

    protected function setUp()
    {
        $this->bonuses = new Bonuses();
        $this->testEmptyData = null;
        $this->emptyArray = [];
        $this->arrayWithData = [
          'Artem' => '5',
        ];
    }

    public function testEmployeeCountOnNull()
    {
        $result = $this->bonuses->setEmployeeCount($this->testEmptyData);
        $this->assertEquals("Не задано количество работников", $result);
    }

    public function testWorkDaysOnNull()
    {
        $result = $this->bonuses->setWorkDays($this->testEmptyData);
        $this->assertEquals("Не задано количество рабочих дней", $result);
    }

    public function testGetEmployee()
    {
        $result = $this->bonuses->getEmployee($this->emptyArray);
        $this->assertEquals("Нет данных по работникам", $result);
    }

    public function testGetAwardEmployeeOnEmpty()
    {
        $result = $this->bonuses->getBonusEmployee($this->emptyArray);
        $this->assertEquals("Никто не заслужил премию", $result);
    }

    public function testGetAwardEmployee()
    {
        $result = $this->bonuses->getBonusEmployee($this->arrayWithData);
        $this->assertEquals("Artem\r\n", $result);
    }
}