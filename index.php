<?php
/**
 * @var mysqli $link
 */

require_once 'vendor/autoload.php';
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';

use Academy\classes\entities\users\highLevel\UserMaster;
use Academy\classes\entities\users\lowLevel\UserStudent;
use Academy\classes\entities\users\mediumLevel\UserTeacher;

$formationsData = getFormationsData($link);

$insignis = [];
$caedes = [];
$camarilla = [];
$brujah = [];
$sabbat = [];
$gangrel = [];

foreach ($formationsData as $formation) {
    switch ($formation['name']) {
        case 'Insignis':
            $insignis = $formation;
            break;
        case 'Caedes':
            $caedes = $formation;
            break;
        case 'Camarilla':
            $camarilla = $formation;
            break;
        case 'Brujah':
            $brujah = $formation;
            break;
        case 'Sabbat':
            $sabbat = $formation;
            break;
        case 'Gangrel':
            $gangrel = $formation;
            break;
        default: break;
    }
}

$testStudent = new UserStudent($link, 13000);
$testTeacher = new UserTeacher($link, 9737);
$testMaster = new UserMaster($link, 8855);