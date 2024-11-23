<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];
$file = $_GET['file'];

if($id != ""){
   $delete = $db->delete("details", $id);
   unlink("../static/".$file);
   header('Location: details.php');
}
