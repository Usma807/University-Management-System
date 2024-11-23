<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$data_arr = $db->retrieve("users");
$data_arr = json_decode($data_arr, 1);


$check = true;
foreach ($data_arr as $id => $arr) {
    if ($arr['email'] == $_POST['email']) {
        $check = false;
        break;
    }
}

if ($check) {
    if (isset($_POST['register'])) {
        $add = $db->insert("users", [
            "name" => $_POST["name"],
            "surname" => $_POST['surname'],
            "email" => $_POST['email'],
            "password" => $_POST['password']
        ]);
        if ($add) {
            $_SESSION['success_registration'] = "Muvaffaqiyatli ro'yxatdan o'tkazildi!";
        } else {
            $_SESSION['error_registration'] = "Foydalanuvchini qo'shishda xatolik yuz berdi.";
        }
    }
} else {
    $_SESSION['error_registration'] = "Bunday email tizimda mavjud. Iltimos boshqa email orqali ro'yxatdan o'ting!";
}

header('Location: index.php');