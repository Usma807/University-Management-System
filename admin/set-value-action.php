<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$got_id = $_POST['system_id'];
$gotON = $_POST['on'];
$gotMT = $_POST['jmt'];
$gotAI = $_POST['jai'];
$gotYN = $_POST['yn'];

$check = true;

if($gotON == 50){
    $check = false;
}if(($gotMT+$gotAI) != ($gotYN - $gotON)){
    $check = false;
}if($gotYN != 50){
    $check = false;
}


if($check) {
    $update = $db->update("rating_system/",$got_id, [
        "on" => $_POST['on'],
        "jmt" => $_POST['jmt'],
        "jai" => $_POST['jai'],
        "yn" => $_POST['yn'],
    ]);                    
    $_SESSION['success_insert'] = "Muvaffaqiyatli saqlandi!";
    header("Location: set-values.php");
    
}else{
    $_SESSION['error_insert'] = "Hisoblashlar to'g'ri kelmadi. Iltimos e'tiborli bo'ling!";
    header("Location: set-values.php");
}

?>
