<?php

include("config.php");
include("firebaseRDB.php");

$lesson_id = $_POST['lesson_id'];

$db = new firebaseRDB($databaseURL);

if(isset($_POST['update'])){
    $update = $db->update("lessons/",$lesson_id, [
        "name" => $_POST["name"],
        "topic" => $_POST["topic"],
        "status" => $_POST["status"]
]);

header("Location: lessons.php");

}

?>