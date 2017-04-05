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
define('LIB_DIR', 'lib/'); // lib kataloogi nime konstant
define('ACTS_DIR', 'acts/'); // acts kataloogi nime konstant

define('DEFAULT_ACT', 'default'); // vaikimis tegevuse faili nime konstant

// võtame kasutusele vajalikud abifailid
require_once LIB_DIR.'utils.php';
require_once 'db_conf.php'; // loeme andmebaasi konfi sisse

// võtame kasutusele vajalikud failid
require_once CLASSES_DIR.'template.php';
require_once CLASSES_DIR.'http.php';
require_once CLASSES_DIR.'linkobject.php';
require_once CLASSES_DIR.'mysql.php';

// loome vajalikud objektid projekti tööks

$http = new linkobject();
$db = new mysql(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$res = $db->query('SELECT NOW()');
echo '<pre>';
print_r($res);
echo '</pre>';

// testime linkobjekti tööd
//echo $http->baseUrl;
//echo '<br>';
//$link = $http->getLink(array('kasutaja'=>'admin', 'pass'=>'qwerty'));
//echo $link;
// test väljund
//echo '<pre>';
//print_r($http);
?>