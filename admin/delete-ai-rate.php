<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'];

if($id != ""){
   $delete = $db->delete("rate_ai_users", $id);
   $_SESSION['success_delete'] = "Muvaffaqiyatli o'chirildi!";
   header('Location: ai-results.php');
}
