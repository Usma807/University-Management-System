<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];

$data = $db->retrieve("elements");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id1 => $arr){
    if($arr['lesson_plan'] == $id){
        $check = false;
        break;
    }
}

if($check){
   if($id != ""){
      $delete = $db->delete("plans", $id);
      header('Location: plans.php');
   }
}if(!$check){
   $_SESSION['error_delete'] = "Rejani o'chirish uchun reja ichida elementlar mavjud bo'lmasligi talab qilinadi.";
   header('Location: plans.php');
}
