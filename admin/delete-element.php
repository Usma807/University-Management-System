<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];

$data = $db->retrieve("details");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id1 => $arr){
    if($arr['element_id'] == $id){
        $check = false;
        break;
    }
}

if($check){
   if($id != ""){
      $delete = $db->delete("elements", $id);
      header('Location: elements.php');
   }   
}if(!$check){
   $_SESSION['error_delete'] = "Elementni o'chirish uchun element ichida detallar mavjud bo'lmasligi talab qilinadi.";
   header('Location: elements.php');
}