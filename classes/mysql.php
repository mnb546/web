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

    // päringu teostamine
    function query($sql) {
        $res = mysqli_query($this->conn, $sql);
        if ($res == false) {
            echo 'Viga päringus!<br>';
            echo '<b>'.$sql.'</b><br>';
            echo mysqli_error($this->conn).'<br>';
            exit;
        }
        return $res;
    }

    // andmetega päringu testimine
    function getArray() {
        $res = $this->query($sql);
        $data = array();
        while($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
        if(count($data) == 0) {
            return false;
        }
        return $data;
    }
}

?>