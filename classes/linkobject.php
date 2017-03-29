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
    function getLink($add = array()){
        $link = '';
        foreach($add as $name=>$val){
            $this->addToLink($link, $name, $val);
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