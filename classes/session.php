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
        // võtame sessiooni id andmed
        $this->createSession();
        $this->sid = $http->get('sid');
    }

    // sessiooni loomine
    function createSession($user = false) {
        // kui kasutaja on anonüümne
        if($user == false) {
            // tekitame andmed session tabeli jaoks
            $user = array(
                'user_id' => 0,
                'role_id' => 0,
                'username' => 'Anonymous'
            );
        }

        // unikaalse sessiooni id loomine
        $sid = md5(uniqid(time().mt_rand(1, 1000), true));
        // päring sessiooni andmete salvestamiseks andmebaasi
        $sql = 'INSERT INTO session SET '.
            'sid='.fixDb($sid).', '.
            'user_id='.fixDb($user['user_id']).', '.
            'user_data='.fixDb(serialize($user)).', '.
            'login_ip='.fixDb(REMOTE_ADDR).', '.
            'created=NOW()';
        // sisestame päringu andmeebasi
        $this->db->query($sql);
        // määrame sid ka antud klassi muutujale var $sid
        $this->sid = $sid;
        // paneme antud väärtuse ka veebi - lehtede vahel kasutamiseks
        $this->http->set('sid', $sid);
    }

}