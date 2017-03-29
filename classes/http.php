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

    // klassi meetodid
    // paneme algandmed paika - initsialiseerimine neid
    function init() {
        $this->vars = array_merge($_GET, $_POST, $_FILES);
        $this->server = $_SERVER;
    }
}
?>