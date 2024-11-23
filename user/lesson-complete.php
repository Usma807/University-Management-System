<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$element_id = $_GET['id'];
$user_id = $_GET['user_id'];
$rate = $_GET['rate'];

$element_name = "";

$data = $db->retrieve("elements/{$element_id}");
$data = json_decode($data, 1);

$element_name = $data['lesson_element'];

$data1 = $db->retrieve("results");
$data1 = json_decode($data1, 1);
$check = true;
foreach ($data1 as $id1 => $arr1){
     if($arr1['element_id'] == $element_id && $arr1['user_id'] == $user_id){
          $check = false;
          break;
     }
}



if($check){
     $add = $db->insert("results", [
          "element_id" => $element_id,
          "user_id" => $user_id,
          "element_name" => $element_name, 
          "rate" => $rate  
     ]);
     
     $_SESSION['lesson_message'] = $element_name." - dars muvaffaqiyatli yakunlandi!";     
}
if(!$check){
     $_SESSION['lesson_message'] = $element_name." - darsni allaqachon yakunlagansiz!";
}

header("location: open-element.php?id=" . $element_id);
