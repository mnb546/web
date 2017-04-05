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

define('DEFAULT_ACT', 'default'); // vaikimis tegevuse faili konstant

// võtame kasutusele vajalikud abifailid
require_once LIB_DIR.'utils.php';

// võtame kasutusele vajalikud failid
require_once CLASSES_DIR.'template.php';
require_once CLASSES_DIR.'http.php';
require_once CLASSES_DIR.'linkobject.php';

// loome vajalikud objektid projekti tööks

$http = new linkobject();


// testime linkobjekti tööd
//echo $http->baseUrl;
//echo '<br>';
//$link = $http->getLink(array('kasutaja'=>'admin', 'pass'=>'qwerty'));
//echo $link;
// test väljund
//echo '<pre>';
//print_r($http);
?>