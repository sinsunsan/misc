<?php

$db = 'users';
$login =  'login';
$pwd = 'XXXX';
$host = 'sql1-new.host.net';

//set the working directory
define('DRUPAL_ROOT', getcwd());

//Load Drupal
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
} else {
    $uid = 0;
}

if (isset($_GET['cookie_name'])) {
    $cookie_name = $_GET['cookie_name'];
} else {
    $cookie_name = "null";
}

if (isset($_GET['cookie_value'])) {
    $cookie_value = $_GET['cookie_value'];
} else {
    $cookie_value = "null";
}

if ($uid != 1) {
    drupal_session_initialize();

    drupal_session_start();

    mysql_connect($host, $login, $pwd);
    mysql_select_db($db);
    $cookie_name = session_name();
    $new_sid = $_COOKIE[$cookie_name];

    $query = "SELECT uid, sid FROM sessions WHERE sid = '$new_sid'";

    $result = mysql_query($query);
    $data = mysql_fetch_array($result);
    $sid = $data['sid'];

    if ($data['uid'] != "") {
      $query = "UPDATE sessions SET uid = $uid WHERE sid = '$sid'";
    }

  $result = mysql_query($query);
}
?>
