<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];
$file = $_GET['file'];

if($id != ""){
   $delete = $db->delete("ai_works", $id);
   unlink("../ai-works/".$file);
   header('Location: ai.php');
}
