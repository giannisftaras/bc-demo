<?php

function root() {
    return $_SERVER["DOCUMENT_ROOT"];
}

function root_path() {
    return root() . '/..';
}

function config_folder() {
    return root_path() . '/config';
}

function src_folder() {
    return root_path() . '/src';
}

function resources_folder() {
    return root_path() . '/resources';
}

function current_page() {
    return basename($_SERVER['PHP_SELF']);
}

function auth_ini() {
    $auth = parse_ini_file(config_folder() . '/auth.ini');
    return $auth;
}

function config_ini() {
    $config = parse_ini_file(config_folder() . '/config.ini');
    return $config;
}

function process($file, $folder = '') {
    if (!empty($folder)) {
        $file = src_folder() . "/process/$folder/$file.php";
    } else {
        $file = src_folder() . "/process/$file.php";
    }
    return $file;
}

function logic($file) {
    $file = src_folder() . "/logic/$file.php";
    return $file;
}

function views($file) {
    $file = src_folder() . "/views/$file.php";
    return $file;
}

function helpers($file) {
    $file = src_folder() . "/helpers/$file.php";
    return $file;
}

?>