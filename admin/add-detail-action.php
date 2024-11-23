<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotID = $_POST['element_id'];

$data = $db->retrieve("details");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['element_id'] == $gotID) {
        $check = false;
    }
}


if($check) {

    $file = $_FILES['file']['name']; 

    $add = $db->insert("details", [
        "element_id" => $_POST['element_id'],
        "lesson_text" => $_POST['lesson_text'],
        "filename" => $file
    ]);                       
                       
    move_uploaded_file($_FILES['file']['tmp_name'], "../static/$file");

    header("Location: details.php");
    
}else{
    $_SESSION['error_insert'] = "Bu elementga detallar allaqachon qo'shilgan!";
    header("Location: add-detail.php");
}

?>
