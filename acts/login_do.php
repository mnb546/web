<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 3.05.2017
 * Time: 9:40
 */

$username = $http->get('Kasutajanimi');
$passwd = $http->get('Parool');

// koostame päringu kasutaja kontrollimiseks andmebaasis
$sql = 'SELECT * FROM user '.
    'WHERE username='.fixDb($username).
    'AND password='.fixDb(md5($passwd));
$res = $db->getArray($sql);

// teeme päringu tulemuse kontrolli
if($res == false){
    // siis tuleb suunata kasutaja sisselogimine tagasi
    echo 'Probleem sisse logimisega :/ ';
}
else {
    $sess->createSession($res[0]);
    // tuleb suunata pealehele
    // kus väljastada kasutaja andmed sessiooni kontrolliks
    
}