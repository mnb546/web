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

    // klassi konstruktor
    function __construct($f){
        $this->file = $f; // määrame html malli
        $this->loadFile(); // loome määratud failist sisu
    }

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

        // Lisame TMP_DIR kasutusele
        $f = TMP_DIR.$this->file;
        if(file_exists($f) and is_file($f) and is_readable($f)){
            // loeme failist malli sisu
            $this->readFile($f);
        }

        // Lisame .html laienduse kasutusele
        $f = TMP_DIR.$this->file.'.html'; //
        if(file_exists($f) and is_file($f) and is_readable($f)){
            // loeme failist malli sisu
            $this->readFile($f);
        }

        // lisame alamkataloogid kasutusele
        $f = TMP_DIR.str_replace('.', '/', $this->file).'.html'; //
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

    // koostame paarid malli_elemendi_nimi => reaalne_Väärtus
    function set($name, $val) {
        $this->vars[$name] = $val;
    }

    // lisame väärtused olemasolevatele elementidele
    function add($name, $val) {
        // kui antud nimega elementi ei eksisteeri
        if(!isset($this->vars[$name])) {
            $this->set($name, $val);
        }
        else {
            $this->vars[$name] = $this->vars[$name].$val;
            
        }
    }

    // html malli täitmine reaalse sisuga
    function parse() {
        $str = $this->content; //lokaalne asendus
        // vaatame malli
        foreach ($this->vars as $name=>$val) {
            $str = str_replace('{'.$name.'}', $val, $str);
        }
        
        //tagastan täos täidetud malli sisu
        return $str;
    }
}

?>