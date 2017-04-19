<?php

/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 29.03.2017
 * Time: 13:45
 */
class http
{
    // klassi muutujad
    var $vars = array(); // http päringute andmed
    var $server = array(); // serveri (masina) andmed

    // klassi konstruktor
    function __construct() {
        $this->init();
        $this->initCont();
    }

    // klassi meetodid
    // paneme algandmed paika - initsialiseerimine neid
    function init() {
        $this->vars = array_merge($_GET, $_POST, $_FILES);
        $this->server = $_SERVER;
    }

    // defineerime vajalikud konstandid
    function initCont() {
        $consts = array('REMOTE_ADDR', 'HTTP_HOST', 'PHP_SELF', 'SCRIPT_NAME');
        foreach ($consts as $const){
            if(!defined($const) and isset($this->server[$const])) {
                define($const, $this->server[$const]);
            }
        }
    }

    //saame kätte veebis olevad andmed - nagu $_POST või $_GET - emulatsioon
    // tegelikult need andmed on lingi kaudu saadud
    function get($name) {
        // tagastame selle väärtuse
        if($this->vars[$name]) {
            return $this->vars[$name];
        }
        // või tagastame tühja väärtuse
        return false;
    }

    // Lisame vajalikud väärtused veebi kujul nimi=väärtus
    function set($name, $val) {
        $this->vars[$name] = $val;
    }

    function del($name) {
        if(isset($this->vars[$name])) {
            unset($this->vars[$name]);
        }
    }
}
?>