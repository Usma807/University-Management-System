<?php

include("config.php");
include("firebaseRDB.php");

$user_id = $_POST['user_id'];

$db = new firebaseRDB($databaseURL);

if(isset($_POST['update'])){
    $update = $db->update("users/",$user_id, [
        "name" => $_POST["name"],
        "surname" => $_POST["surname"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
]);

header("Location: users.php");

}

?>