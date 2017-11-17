<?php

require_once dirname(__FILE__) . "/../app/Bonuses.php";

$bonus = new Bonuses();
echo 'Укажите количество работников:' . PHP_EOL;

while ($employeeCount = trim(fgets(STDIN), "\r\n")) {
    $bonus->setEmployeeCount($employeeCount);
    break;
}

$counter = 0;
echo 'Введите имена работников:' . PHP_EOL;
while ($counter < $bonus->getEmployeeCount() && $employeesName = trim(fgets(STDIN), "\r\n")) {
    echo sprintf('Задан работник под номером %s - %s' . PHP_EOL, $counter + 1, $employeesName);
    $bonus->addEmployee($employeesName);
    $counter++;
}

$bonuses = [];
foreach ($bonus->getEmployee() as $employee => $value) {
    $counter = 0;
    $bonuses[$value] = '';
    echo sprintf('Укажите обращения для работника %s' . PHP_EOL, $employee+1);
    echo 'Введите количество дней работы для работника:' . PHP_EOL;

    while ($days = trim(fgets(STDIN), "\r\n")) {
        $bonus->setWorkDays($days);
        break;
    }

    $pointsScore = 0;
    echo 'Укажите оценки за обращения за день (через пробел):' . PHP_EOL;
    while ($counter < $bonus->getWorkDays() && $pointsScore = trim(fgets(STDIN), "\r\n")) {
        echo sprintf('Оценки за %s день выставлены.' . PHP_EOL, $counter+1);
        $arr = explode(" ", $pointsScore);
        foreach ($arr as $val) {
            if ($pointsScore < 3) {
                echo 'Работник получил меньше 3 баллов. Он не получит премию!' . PHP_EOL;
                unset($bonuses[$value]);
                continue 3;
            }
            $bonuses[$value]++;
        }
        $counter++;
    }
}

echo 'Работники, которые получат премию:'.PHP_EOL;

echo($bonus->getBonusEmployee($bonuses));