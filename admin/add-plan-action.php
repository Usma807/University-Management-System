<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotID = $_POST['plan_name'];

$data = $db->retrieve("plans");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['plan_name'] == $gotID) {
        $check = false;
    }
}

if($check) {
    if(isset($_POST['add-plan'])){

        $add = $db->insert("plans", [
            "lesson_id" => $_POST["lesson_id"],
            "plan_name" => $_POST["plan_name"],
            "plan_topic" => $_POST["plan_topic"]
        ]);
        
        
        header("Location: plans.php");
    
    }
}else{
    $_SESSION['error_insert'] = "Ushbu nomda reja mavjud!";
    header("Location: add-plan.php");
}

?>