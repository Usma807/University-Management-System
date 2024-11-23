<?php
session_start();
$got_user_fullname = "";
$got_user_rate = "";
$got_user_rating = "";
$gotON_rate = "";

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$data2 = $db->retrieve("elements");
$data2 = json_decode($data2, 1);

$data3 = $db->retrieve("results");
$data3 = json_decode($data3, 1);

$data4 = $db->retrieve("users");
$data4 = json_decode($data4, 1);

$data5 = $db->retrieve("rating_system");
$data5 = json_decode($data5, 1);

foreach ($data5 as $id5 => $arr5){
    $gotON_rate = $arr5['on'];
}




$_SESSION['check'] = false;

if(isset($_POST['get_user_results'])){
    $got_user_id = $_POST['user_id'];

    $completed_elements = 0;
    if($data3 != null){
        foreach($data3 as $id3 => $arr3){

            if($arr3['user_id'] == $got_user_id){
        
                $completed_elements += 1;
        
            }
        
        }
    }
    $sum_elements = 0;

    foreach($data2 as $id2 => $arr2){

        $sum_elements += 1;

    }
    $data4 = $db->retrieve("users/{$got_user_id}");
    $data4 = json_decode($data4, 1);

    $got_user_fullname = $data4['name']. " ". $data4['surname'];

    $user_rating_percent = floor(($completed_elements / $sum_elements) * 100);

    $got_user_rate = $user_rating_percent. "%";

    $got_user_rating = $user_rating_percent * $gotON_rate / 100;
    
    $_SESSION['got_user_id'] = $got_user_id;
    $_SESSION['got_user_fullname'] = $got_user_fullname;
    $_SESSION['got_user_rate'] = $got_user_rate;
    $_SESSION['got_user_rating'] = $got_user_rating;
    $_SESSION['check'] = true;
    header("Location: rating-users.php");
}

?>