<?php

session_start();

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$data_arr = $db->retrieve("users");
$data_arr = json_decode($data_arr, 1);

if($data_arr == null || count($data_arr) == 0){
    $_SESSION['error_signing'] = "Foydalanuvchi topilmadi!";
    header("Location: index.php");
    exit;
}

if($data_arr != null){
    foreach($data_arr as $id => $arr){
        if($_POST['email'] == $arr['email'] && $_POST['password'] == $arr['password']){
            $_SESSION['id'] = $id;
            header("Location: user/home.php");
            exit;
        }
    }
    $_SESSION['error_signing'] = "Email yoki/va Parol xato!";
    header("Location: index.php");
    exit;
}

?>