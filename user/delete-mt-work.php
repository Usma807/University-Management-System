<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];
$file = $_GET['file'];

if($id != ""){
   $delete = $db->delete("mt_works", $id);
   unlink("../mt-works/".$file);
   header("Location: mt.php");
}
