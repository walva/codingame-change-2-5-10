<?php

require_once('Change.php');

function optimalChange($s): Change|null
{
    return Change::computeOptimalChange(null, $s);
}