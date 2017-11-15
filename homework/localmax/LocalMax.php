<?php

class LocalMax {

    public $arrMax = [];

    public function setLocalMax($arrMain = []) {
        for ($i = 1; $i <= count($arrMain)-1; $i++) {
            if ($arrMain[$i] > $arrMain[$i-1] && $arrMain[$i] > $arrMain[$i+1]) {
                $this->arrMax[] = $arrMain[$i];
            }
        }
        return ($this->arrMax);
    }

}