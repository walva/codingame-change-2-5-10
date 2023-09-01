<?php

require_once('Change.php');

function optimalChange(int $required_change): Change|null
{
    if ($required_change <= 1 || $required_change === 3) {
        return null;
    }

    $change = new Change();

    $leftover_change = $required_change;

    $change->bill10 = intdiv($leftover_change, 10);
    $leftover_change %= 10;

    if ($leftover_change === 1 || $leftover_change === 3) {
        $change->bill10--;
        $leftover_change += 10;
    }

    $change->bill5 = intdiv($leftover_change, 5);
    $leftover_change %= 5;

    if ($leftover_change === 1 || $leftover_change === 3) {
        $change->bill5--;
        $leftover_change += 5;
    }

    $change->coin2 = intdiv($leftover_change, 2);

    return $change;
}