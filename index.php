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
//valmistame paarid malli_element => väärtus
$main_tmp->set('user', 'Kasutajanimi');
$main_tmp->set('title', 'Avaleht');
$main_tmp->set('lang_bar', 'keeleriba');
$main_tmp->set('menu', 'lehe_peamenüü');
$main_tmp->set('content', 'lehe sisu');
// Kontrollime antud objekti sisu
echo '<pre>';
print_r($main_tmp);
echo '</pre>';
?>
