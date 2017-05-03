<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 3.05.2017
 * Time: 9:08
 */
// sisse logimisobjekti loomine
$login = new template('login');
// reaalsete väärtuste lisamine template elementidele
$login->set('Kasutajanimi', 'Kasutaja');
$login->set('Parool', 'Parool');
$login->set('nupp', 'Logi sisse');

// lingi loomine
$link = $http->getLink(array('act' => 'login_do'));
$login->set('link', $link);

// paneme sisu template sisse
$main_tmp->set('content', $login->parse());
