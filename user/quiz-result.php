<?php 
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$got_score = $_GET['score'];
$user_id = $_SESSION['id'];

$data = $db->retrieve("yn_results");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['user_id'] == $user_id) {
        $check = false;
    }
}

$user_score = 0;

$data1 = $db->retrieve("yn_quizzes");
$data1 = json_decode($data1, 1);

$count = 0;

foreach ($data1 as $id1 => $arr1){
    $count++;
}

$user_score = ($got_score / $count) * 50;

if($check) {

    $file = $_FILES['file']['name']; 

    $add = $db->insert("yn_results", [
        "user_id" => $user_id,
        "score" => $user_score
    ]);                       
                       
    $_SESSION['success_insert'] = "Muvaffaqiyatli yakunlandi!";
    header("Location: results.php");
    
}else{
    $_SESSION['error_insert'] = "Qayta topshirish imkoni yo'q!";
    header("Location: results.php");
}

?>
