<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];

$data = $db->retrieve("plans");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id1 => $arr){
    if($arr['lesson_id'] == $id){
        $check = false;
        break;
    }
}

if($check){
   if($id != ""){
      $delete = $db->delete("lessons", $id);
      header('Location: lessons.php');
   }   
}if(!$check){
   $_SESSION['error_delete'] = "Darsni o'chirish uchun dars ichida rejalar mavjud bo'lmasligi talab qilinadi.";
   header('Location: lessons.php');
}