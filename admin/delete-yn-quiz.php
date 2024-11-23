<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];

if($id != ""){
   $delete = $db->delete("yn_quizzes", $id);
   header('Location: yn-quizzes.php');
}
