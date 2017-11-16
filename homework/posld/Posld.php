<?php

class Posld {

    public function findPosld ($arrMain = []) {
        $current = 0;    // текущая длина последовательности
        $longest = 0;    // длина самой длинной последовательности
        $previous = $arrMain[0];   // предыдущий элемент массива

        foreach ($arrMain as $value) {
            if ($value <= $previous) {
                $current++;
            } else {
                if ($current > $longest) {
                    $longest = $current;
                }
                $current = 1;
            }
            $previous = $value;
        }

        if ($current > $longest) {
            $longest = $current;
        }

        return ($longest);

    }
}