<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 15.03.2017
 * Time: 13:10
 */
// Konfugratsiooni kasutusele võtmine
require_once 'conf.php';

// Pealehe sisu
echo '<h1>Veebipõhine esileht</h1> <h3>Rainer ISP14</h3>';

// Valmistame peatemplate objekti
$main_tmp = new template('main');
require_once('lang.php');
//valmistame paarid malli_element => väärtus
$main_tmp->set('header', 'minu lehe pealkiri');
$main_tmp->set('user', $sess->user_data['username']);
$main_tmp->set('title', 'Avaleht');

$main_tmp->set('menu', 'Lehe peamenüü');
// kutsume menüü tööletestimiseks
require_once 'menu.php';
$main_tmp->set('menu', $menu->parse());
require_once 'act.php';
$main_tmp->set('nav_bar', 'username');


// töstsime vaikimisi väljundi default tegevuse sisse
$main_tmp->set('site_title', 'Veebiprogrammeerimise kursus');
// Kontrollime antud objekti sisu
/*echo '<pre>';
print_r($main_tmp);
echo '</pre>';*/
echo $main_tmp->parse();
// Uuendame sessiooni andmeid
$sess->flush();

?>
