<?php

/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 22.03.2017
 * Time: 12:11
 */
class template
{
    // template klassi omadused - muutujad
    var $file = ''; // template fail
    var $content = false; //html malli faili sisu
    var $vars = array(); //html vaate sisu - reaalsed väärtused
    // klassi tegevused - meetodid - funktsioonid
    // Loeme sisu html failist
    function readFile($f) {
        $this->content = file_get_contents($f);
    }
}

?>