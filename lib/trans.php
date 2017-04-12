<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 12.04.2017
 * Time: 13:28
 */
function tr($txt) {
    static $trans = false; // static - jätab väärtuse meelde, kui funktsioon ei tööta

    // kui vaikimis keel...
    if(LANG_ID == DEFAULT_LANG) {
        return $txt;
    }
    // kui ei ole, otsida vastav lang file
    if($trans === false) {
        $fn = LANG_DIR.'lang_'.LANG_ID.'.php';
        if(file_exists($fn) and is_file($fn)) {
            require_once ($fn);
            $trans = $_trans; // lang_en.php'st saadud massiiv
        }
        else {
            $trans = array();
        }
    }
    if(isset($trans[$txt])) {
        return $trans[$txt];
    }

    // juhul kui mingit vastavust ei leia - tagastatakse algtekst
    return $txt;

}