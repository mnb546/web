<?php
/**
 * Created by PhpStorm.
 * User: rainer.lanemann
 * Date: 15.03.2017
 * Time: 15:24
 */

// Vajalike konstantide defineerimine
define('CLASSES_DIR', 'classes/'); // classes kausta nime konstant
define('TMP_DIR', 'tmp/'); // tmp kausta nime konstant

// võtame kasutusele vajalikud failid
require_once CLASSES_DIR.'template.php';
require_once CLASSES_DIR.'http.php';

// loome vajalikud objektid projekti tööks
$http = new http();
$http->init();
$http->initCont();
// test väljund
//echo '<pre>';
//print_r($http);
//echo '</pre>';
echo REMOTE_ADDR;
?>