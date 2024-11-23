<?php

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

if(isset($_POST['add-user'])){

    $add = $db->insert("users", [
        "name" => $_POST["name"],
        "surname" => $_POST["surname"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);
    
    
    header("Location: users.php");

}

if(isset($_POST['add-user-continue'])){

    $add = $db->insert("users", [
        "name" => $_POST["name"],
        "surname" => $_POST["surname"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);
    
    
    header("Location: add-user.php");

}

?>