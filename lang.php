<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 12.04.2017
 * Time: 12:28
 */
$sep = new Template('lang.sep');
$sep = $sep->parse();
$count = 0;
echo $lang_id;
// kõik keeled
foreach($siteLangs as $lang_id => $lang_name) {

    //suurendame keele eraldajate joonistamiseks
    $count++;
    // kui tegu on aktiivse keelega ,kasutame aktiivset malli

    if($lang_id == LANG_ID) {
        $item = new Template('lang.active');
    }
    else {
        $item = new Template ('lang.item');
    }

    $link = $http->getLink(array('lang_id'=>$lang_id), array('act', 'page_id'), array('lang_id'));
    $item->set('link', $link);
    $item->set('name', $lang_name);
    $main_tmp->add('lang_bar', $item->parse());

    // keelte eraldamiseks paneme separaatori
    if($count < count($siteLangs)) {
        $main_tmp->add('lang_bar', $sep);
    }
}