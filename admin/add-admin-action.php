<?php

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

if(isset($_POST['add-admin'])){

    $add = $db->insert("admins", [
        "name" => $_POST["name"],
        "surname" => $_POST["surname"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);
    
    
    header("Location: admins.php");

}

if(isset($_POST['add-admin-continue'])){

    $add = $db->insert("admins", [
        "name" => $_POST["name"],
        "surname" => $_POST["surname"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ]);
    
    
    header("Location: add-admin.php");

}

?>