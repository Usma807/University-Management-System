<?php 

session_start();
include("config.php");
include("firebaseRDB.php");
$db = new firebaseRDB($databaseURL);

$user_email = $_POST['email'];
$user_password = $_POST['password'];

$data_arr = $db->retrieve("admins");
$data_arr = json_decode($data_arr, 1);
if($data_arr != null){
    foreach($data_arr as $id => $arr){
        if($user_email == $arr['email'] && $user_password == $_POST['password']){
            $_SESSION['id'] = $id;
            header("Location: home.php");
        }else{
            header("Location: index.php");
        }
    }
  }

?>