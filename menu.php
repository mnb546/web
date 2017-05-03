<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 22.03.2017
 * Time: 15:26
 */
// Loome menüü mallide objektid
$menu = new template('menu.menu');
$item = new template('menu.item');
// lisame sisu
// menüü sql lause
$sql = 'SELECT content_id, title FROM content WHERE '.'parent_id='.fixDB(0).' AND show_in_menu='.fixDb(1);

// saame päringu tulemuse
$res = $db->getArray($sql);
// tulemuse sisu kontrollimine

if ($res != false) {
    foreach ($res as $page) {
        // nimetame menüüs väljastatava elemendi
        $item->set('name', tr($page['title']));
        //loome antud menüü elemendil lingi
        $link = $http->getLink(array('page_id'=>$page['content_id']));
        // lisame antud link menüüsse
        $item->set('link', tr($link));
        // lisame valmis lingi menüü objekti sisse
        $menu->add('items', ($item->parse()));
    }
}

// sisse logimine


// kui soovime pidevat asendamist, siis set funktsioon add asemel
$main_tmp->add('menu', $menu->parse());
?>