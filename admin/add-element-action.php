<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotID = $_POST['lesson_element'];

$data = $db->retrieve("elements");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['lesson_element'] == $gotID) {
        $check = false;
    }
}

if($check) {
    if(isset($_POST['add-element'])){

        $add = $db->insert("elements", [
            "lesson_plan" => $_POST["lesson_plan"],
            "lesson_element" => $_POST["lesson_element"],
            "lesson_topic" => $_POST["lesson_topic"]
        ]);
        
        
        header("Location: elements.php");
    
    }
}else{
    $_SESSION['error_insert'] = "Ushbu nomda element mavjud!";
    header("Location: add-element.php");
}

?>