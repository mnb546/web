<?php

/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 19.04.2017
 * Time: 8:53
 */
class session
{ // klassi algus

    // klassi muutujad
    var $sid = false; // sessiooni id
    var $vars = array(); // sessiooni ajal kasutatavad andmed
    var $http = false; // objekt veebiandmete kasutamiseks
    var $db = false; // objekt, mis läheb andmebaasi kasutamiseks
    var $anonymous = true; // anonüümne kasutaja on lubatud

    // klassi meetodid
    // konstruktor
    function __construct(&$http, &$db) {
        $this->http = &$http;
        $this->db = &$db;
    }

}