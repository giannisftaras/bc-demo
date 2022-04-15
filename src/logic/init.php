<?php

error_reporting(0);
ini_set('display_errors', 0);

include $_SERVER["DOCUMENT_ROOT"] . '/../src/logic/dir_paths.php';
include helpers('csrf');

$logged_in = false;
session_start();

$csrf = new CSRF('csrf-lib-tokens', 'nonce', 0, 64);

$auth_ini = auth_ini();
$config_ini = config_ini();

include logic('db_access');
$local_query_handle = new localQueries;

include logic('functions');

?>