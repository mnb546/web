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

    //html malli faili lugemine
    function loadFile(){
        // lokaalne asendus
        $f = $this->file;
        // kontrollime mallide kausta olemasolu
        if(!is_dir(TMP_DIR)){
            echo 'Kataloogi '.TMP_DIR.' ei ole leitud<br />';
            exit;
        }
        // Kui fail on olemas ja loetav
        if(file_exists($f) and is_file($f) and is_readable($f)){
            // loeme failist malli sisu
            $this->readFile($f);
        }
        // Kui sisu ei ole võimalik lugeda
        if($this->content === false) {
            echo 'Ei suutnud lugeda faili '.$this->file.'<br />';
        }
    }

    // Loeme sisu html failist
    function readFile($f) {
        $this->content = file_get_contents($f);
    }

}

?>