<?php
session_start();
include("config.php");
include("firebaseRDB.php");
$db = new firebaseRDB($databaseURL);
$user_id = $_SESSION['id'];
if(isset($_POST['update'])){
$update = $db->update("users/", $user_id , [
   "name" => $_POST["name"],
   "surname"     => $_POST['surname'],
   "email" => $_POST['email'],
   "password"      => $_POST['password']
]);
header("Location: profile.php");

}

if(isset($_POST['exit'])){
   unset($_SESSION['id']);
session_unset();
session_destroy();
header("location: ../index.php");
}