<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];
$file = $_GET['file'];

if($id != ""){
   $delete = $db->delete("mt_files", $id);
   unlink("../mt/".$file);
   $_SESSION['success_delete'] = "Muvaffaqiyatli o'chirildi!";
   header('Location: mt.php');
}
