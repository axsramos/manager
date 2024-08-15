<?php

use app\models\CasIdy;

$identity = '';

$csCasIdy = new CasIdy();
$csCasIdy->setCasIdyTkn($token);

if($csCasIdy->getIdentity()) {
    if($csCasIdy->getCasIdyLck() == 'N') {
        $identity = $csCasIdy->getCasIdyCod();
    }
}

$GLOBALS['Identity'] = $identity;
