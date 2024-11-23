<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotID = $_POST['user_id'];

$data = $db->retrieve("ratings");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['user_id'] == $gotID) {
        $check = false;
    }
}


if($check) {
    if(isset($_POST['rate_user'])){

        $add = $db->insert("ratings", [
            "user_id" => $_POST["user_id"],
            "user_rate" => $_POST["user_rate"],
            "user_rating" => $_POST["user_rating"],
            "rate" => $_POST["rate"]
        ]);
        
        $_SESSION['success_rating'] = "Foydalanuvchi muvaffaqiyatli baholandi!";
        header("Location: rating-users.php");
    
    }
}else{
    $_SESSION['error_rating'] = "Ushbu foydalanuvchi baholangan!";
    header("Location: rating-users.php");
}

?>