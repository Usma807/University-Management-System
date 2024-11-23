<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotID = $_POST['name'];

$data = $db->retrieve("lessons");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['name'] == $gotID) {
        $check = false;
    }
}


if($check) {
    if(isset($_POST['add-lesson'])){

        $add = $db->insert("lessons", [
            "name" => $_POST["name"],
            "topic" => $_POST["topic"],
            "status" => $_POST["status"]
        ]);
        
        
        header("Location: lessons.php");
    
    }
    
    if(isset($_POST['add-lesson-continue'])){
    
        $add = $db->insert("admins", [
            "name" => $_POST["name"],
            "topic" => $_POST["topic"],
            "status" => $_POST["status"]
        ]);
        
        
        header("Location: add-lesson.php");
    
    }
}else{
    $_SESSION['error_insert'] = "Ushbu nomda mavzu mavjud!";
    header("Location: add-lesson.php");
}

?>