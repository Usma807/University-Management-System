<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotName = $_POST['ai_name'];

$data = $db->retrieve("ai_files");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['ai_name'] == $gotName) {
        $check = false;
    }
}


if($check) {

    $file = $_FILES['file']['name']; 

    $add = $db->insert("ai_files", [
        "ai_name" => $_POST['ai_name'],
        "ai_file" => $file
    ]);                       
                       
    move_uploaded_file($_FILES['file']['tmp_name'], "../ai/$file");
    $_SESSION['success_insert'] = "Muvaffaqiyatli qo'shildi!";
    header("Location: ai.php");
    
}else{
    $_SESSION['error_insert'] = "Ushbu nomda detal mavjud!";
    header("Location: ai.php");
}

?>
