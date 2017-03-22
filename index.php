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
$main_tmp = new template('main.html');
// Kontrollime antud objekti sisu
echo '<pre>';
print_r($main_tmp);
echo '</pre>';
?>
