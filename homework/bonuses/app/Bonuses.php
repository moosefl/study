<?php

class Bonuses
{

    private $employee = [];
    private $employeeCount;
    private $workDays;

    public function addEmployee(string $employee)
    {
        array_push($this->employee, $employee);
    }


    public function setEmployeeCount($count)
    {
        if(!is_null($count))
        {
            $this->employeeCount = $count;
        }
        return 'Не задано количество работников';
    }


    public function getEmployeeCount() : int
    {
        return $this->employeeCount;
    }


    public function getEmployee()
    {
        if(!empty($this->employee)) {
            return $this->employee;
        }
        return 'Нет данных по работникам';
    }


    public function setWorkDays($workDays)
    {
        if(!is_null($workDays))
        {
            $this->workDays = $workDays;
        }
        return 'Не задано количество рабочих дней';
    }


    public function getWorkDays() : int
    {
        return $this->workDays;
    }


    public function getBonusEmployee($bonuses)
    {
        if (empty($bonuses)) {
            return 'Никто не заслужил премию';
        }
        $str = '';
        foreach ($bonuses as $bonus => $value) {
            $str .= $bonus . PHP_EOL;
        }
        return $str;
    }
}