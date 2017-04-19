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
    var $timeout = 900; // 15 min = 900s

    // klassi meetodid
    // konstruktor
    function __construct(&$http, &$db) {
        $this->http = &$http;
        $this->db = &$db;
        // võtame sessiooni id andmed
        $this->clearSessions();
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

    function clearSessions() {
        $sql = 'DELETE FROM session WHERE '.
            time().' - UNIX_TIMESTAMP(changed) > '.
            $this->timeout;
        $this->db->query($sql);
    }

    // sessiooni kontroll
    function checkSession() {
        $this->clearSessions();
        // kui sid on puudu ja anonüümne on lubatud, tekitame alustamiseks anonüümse sessiooni
        if($this->sid === false and $this->anonymous) {
            $this->createSession();
        }
        // kui sid on olemas
        if($this->sid !== false) {
            //võtame andmed sessiooni tabelist, mis on antud id-ga seotud
            $sql = 'SELECT * FROM session WHERE '.
                'sid='.fixDb($this->sid);
            // saadame päringu andmebaasi ja võtame andmed
            $res = $this->db->getArray($sql);
            // juhul kui andmebaasist andmeid ei tule
            if($res == false) {
                // kui anonüümne on lubatud, siis loome uue sessiooni
                if($this->anonymous) {
                    $this->createSession();
                }
                else {
                    // tuleb maha kustutada kõik antud sessiooniga tulevad andmed veebist
                    $this->sid = false;
                    $this->http->del('sid');
                }
            }
            else {
                // kui andmebaaist on võimalik sessiooni kohta andmeid saada
                // kõigepealt sessiooni andmed
                $vars = unserialize($res[0]['svars']);
                if(!is_array($vars)) {
                    $vars = array();
                }
                $this->vars = $vars;
                // nüüd kasutaja andmed
                $user_data = unserialize($res[0]['user_data']);
                $this->user_data = $user_data;
            }
        }
        else {
            // kui $this->sid === false
            // hetkel sessiooni pole
            echo 'Sessiooni hetkel pole<br>';
        }
    } // checkSession end
    function flush() {
        if($this->sid !== false) {
            $sql = 'UPDATE session SET changed=NOW(), '.
                'svars='.fixDb(serialize($this->vars)).
                ' WHERE sid='.fixDb($this->sid);
            $this->db->query($sql);
        }
    }

}