<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 5.04.2017
 * Time: 9:03
 */
$act = $http->get('act'); // küsime hetkel valitud tegevuse

// koostame otsitava faili nime failisüsteemi jaoks
$fn = ACTS_DIR.str_replace('.', '/', $act).'.php';
// kui selline fail olemas ja lugemiseks lubautd
if(file_exists($fn) and is_file($fn) and is_readable($fn)) {
    // siis loeme sisu
    require_once $fn;
}
else {
    $fn = ACTS_DIR.'default'.'.php';
    require_once $fn;
}