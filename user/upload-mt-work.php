<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$got_id = $_POST['mt_id'];
$user_id = $_SESSION['id'];

$data = $db->retrieve("mt_works");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['mt_id'] == $got_id && $arr['user_id'] == $user_id) {
        $check = false;
    }
}


if($check) {

    $file = $_FILES['file']['name']; 

    $add = $db->insert("mt_works", [
        "user_id" => $user_id,
        "mt_id" => $_POST['mt_id'],
        "mt_name" => $_POST['mt_name'],
        "mt_file" => $file
    ]);                       
                       
    move_uploaded_file($_FILES['file']['tmp_name'], "../mt-works/$file");
    $_SESSION['success_insert'] = "Muvaffaqiyatli yuklandi!";
    header("Location: open-mt.php?id=".$got_id);
    
}else{
    $_SESSION['error_insert'] = "Fayl yuklagansiz!";
    header("Location: open-mt.php?id=".$got_id);
}

?>
