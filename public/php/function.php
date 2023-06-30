<?php

require_once 'db_config.php';

function con() {
    global $con, $db_host, $db_user, $db_password, $db_name;
    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    if (!$con) {
        die("Pripojenie zlyhalo");
    }
}

function test_in($con, $data) {
    $data = trim($data);
    $data = mysqli_real_escape_string($con, $data);
    $data = strip_tags($data);
    return $data;
}

function words($text) {
    preg_match('/(\S+\s*){1,15}/', $text, $m);
    return $m[0];
}

function pass_validation($pass) {
    $number = preg_match('@[0-9]@', $pass);
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    if (strlen($pass) < 4 || !$number || !$uppercase || !$lowercase) {
        return false;
    } else {
        return true;
    }
}

function name_validation($meno) {
    if (strlen($meno) < 4) {
        return false;
    } else {
        return true;
    }
}
?>
