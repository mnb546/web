<?php

/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 29.03.2017
 * Time: 14:22
 */

class linkobject extends http
{
    // klassi muutujad - omadused
    var $baseUrl = false;
    var $delim = '&amp;';
    var $eq = '=';
    var $protocol = 'http://';
    var $aie = array('lang_id','sid'=>'sid'); // keel

    // klassi meetodid
    // klassi konstruktor
    function __construct() {
        parent::__construct(); // kutsub tööle http konstruktori
        // lingi loomine
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME;
    }
    
    // andmete paari koostamine kujul
    // nimi=väärtus&nimi1=väärtus1 jne
    function addToLink(&$link, $name, $val) {
        if ($link != '') {
            $link = $link.$this->delim;
        }
        $link = $link.fixUrl($name).$this->eq.fixUrl($val);
    }

    // saame täislink valmis
    function getLink($add = array(), $aie = array(), $not = array()){
        $link = '';
        foreach($add as $name=>$val){
            $this->addToLink($link, $name, $val);
        }
        // juhul kui antud element juba meie lehel ette defineeritud
        foreach ($aie as $name) {
            $val = $this->get($name);
            if($val != false) {
                $this->addToLink($link, $name, $val);
            }
        }
        // juhul, kui antud objektis see väärtus juba määratud - nt keele id
        foreach ($this->aie as $name) {
            $val = $this->get($name);
            // kontrollida, kas olemasoelv asi juba lingis lisatud või mitte
            if($val != false and !in_array($name, $not)) {
                $this->addToLink($link, $name, $val);
            }
        }

        if($link != '') {
            $link = $this->baseUrl.'?'.$link;
        }
        else {
            $link = $this->baseUrl;
        }
        return $link;
    }
}