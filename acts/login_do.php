<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 3.05.2017
 * Time: 9:40
 */

$username = $http->get('kasutaja');
$passwd = $http->get('parool');

// koostame päringu kasutaja kontrollimiseks andmebaasis
$sql = 'SELECT * FROM user '.
    'WHERE username='.fixDb($username).
    'AND password='.fixDb(md5($passwd));
$res = $db->getArray($sql);
echo $sql;
echo '<pre>';
print_r($res);

// teeme päringu tulemuse kontrolli
if($res == false){
    // siis tuleb suunata kasutaja sisselogimine tagasi
    $sess->set('error', 'Probleem sisse logimisega :/ ');
    $link = $http->getLink(array('act' => 'login'));
    $http->redirect($link);
}
else {
    $sess->createSession($res[0]);
    // tuleb suunata pealehele
    // kus väljastada kasutaja andmed sessiooni kontrolliks
    $http->redirect();
}