<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$got_id = $_POST['ai_id'];
$user_id = $_SESSION['id'];

$data = $db->retrieve("ai_works");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['ai_id'] == $got_id && $arr['user_id'] == $user_id) {
        $check = false;
    }
}


if($check) {

    $file = $_FILES['file']['name']; 

    $add = $db->insert("ai_works", [
        "user_id" => $user_id,
        "ai_id" => $_POST['ai_id'],
        "ai_name" => $_POST['ai_name'],
        "ai_file" => $file
    ]);                       
                       
    move_uploaded_file($_FILES['file']['tmp_name'], "../ai-works/$file");
    $_SESSION['success_insert'] = "Muvaffaqiyatli yuklandi!";
    header("Location: open-ai.php?id=".$got_id);
    
}else{
    $_SESSION['error_insert'] = "Fayl yuklagansiz!";
    header("Location: open-ai.php?id=".$got_id);
}

?>
