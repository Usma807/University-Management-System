<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotName = $_POST['mt_name'];

$data = $db->retrieve("mt_files");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['mt_name'] == $gotName) {
        $check = false;
    }
}


if($check) {

    $file = $_FILES['file']['name']; 

    $add = $db->insert("mt_files", [
        "mt_name" => $_POST['mt_name'],
        "mt_file" => $file
    ]);                       
                       
    move_uploaded_file($_FILES['file']['tmp_name'], "../mt/$file");
    $_SESSION['success_insert'] = "Muvaffaqiyatli qo'shildi!";
    header("Location: mt.php");
    
}else{
    $_SESSION['error_insert'] = "Ushbu nomda detal mavjud!";
    header("Location: add-detail.php");
}

?>
