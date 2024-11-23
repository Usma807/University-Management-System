<?php

include("config.php");
include("firebaseRDB.php");

$detail_id = $_POST['detail_id'];

$db = new firebaseRDB($databaseURL);

if(isset($_POST['update'])){
    $update = $db->update("details/",$detail_id, [
        "element_id" => $_POST["element_id"],
        "filename" => $_POST["filename"],
        "lesson_text" => $_POST["lesson_text"]
]);

header("Location: details.php");

}

?>