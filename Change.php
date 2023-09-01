<?php

class Change
{
    public $coin2 = 0;
    public $bill5 = 0;
    public $bill10 = 0;

    public function add($coinOrBill){
        switch($coinOrBill){
            case 2: $this->coin2 += 1; break;
            case 5 : $this->bill5 += 1; break;
            case 10 : $this->bill10 += 1; break;
        }
    }

    public function computeRest($amount){
        return $amount
        - $this->coin2 * 2
        - $this->bill5 * 5
        - $this->bill10 * 10;
    }
    public function getTotal(){
        return $this->coin2 * 2
        + $this->bill5 * 5
        + $this->bill10 * 10;
    }

    public static function computeOptimalChange(Change $change = null, $amount, $toAdd = null)
    {
        $change = $change??new Change();
        if ($change->getTotal() > $amount) {
            return null;
        }
        if ($change->computeRest($amount) == 0) {
            return $change;
        }
    
        foreach([10,5,2] as $coin){
            $candidate = (clone $change);
            $candidate->add($coin);
            $result = self::computeOptimalChange($candidate, $amount, $coin);
            if($result != null) return $result;
        }
        return null;
    }

}


