<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 5.04.2017
 * Time: 9:18
 */
// lehe id saamine ja teisendamine - andmebaasis BIGINT
$page_id = $http->get('page_id');

//sql lause lehe sisu itsimiseks vastavalt id-le
$sql = 'SELECT * FROM content WHERE '.'content_id='.fixDb($page_id);
// sadame päringu andmebaasi sisu saamiseks
$res = $db->getArray($sql);
if ($res === false) {
    $sql = 'SELECT * FROM content WHERE '.'is_first_page='.fixDB(1);
    $res = $db->getArray($sql);
}
if($res !== false) {
    $page = $res[0];
    $http->set('page_id', $page['content_id']);
    $main_tmp->set('content', $page['content']);
}

?>