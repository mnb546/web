<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 5.04.2017
 * Time: 10:29
 */

class mysql {

    // klassi omadused
    var $conn = false;
    var $host = false;
    var $user = false;
    var $pass = false;
    var $dbname = false;

    // klassi tegevused
    function __construct($h, $u, $p, $dn) {
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->dbname = $dn;
        $this->connect();
    }

    function connect() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if (mysqli_connect_error()) {
            echo 'Viga andmebaasiserveriga ühendamisel <br>';
            exit;
        }
    }

}

?>