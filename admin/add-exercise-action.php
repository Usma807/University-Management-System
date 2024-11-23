<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$gotID = $_POST['element_id'];

$data = $db->retrieve("exercises");
$data = json_decode($data, 1);

$check = true;

foreach ($data as $id => $arr) {
    if($arr['element_id'] == $gotID) {
        $check = false;
    }
}

if($check) {

    if(isset($_POST['add-exercise'])){

        $add = $db->insert("exercises", [
            "element_id" => $_POST['element_id'],
            "q1" => $_POST["q1"],
            "a1" => $_POST["a1"],
            "q2" => $_POST["q2"],
            "a2" => $_POST["a2"],
            "q3" => $_POST["q3"],
            "a3" => $_POST["a3"],
            "q4" => $_POST["q4"],
            "a4" => $_POST["a4"],
            "status" => "ex0"
        ]);
        
        
        header("Location: exercises.php");
    
    }
    
    if(isset($_POST['add-exercise-continue'])){
    
        $add = $db->insert("exercises", [
            "element_id" => $_POST['element_id'],
            "q1" => $_POST["q1"],
            "a1" => $_POST["a1"],
            "q2" => $_POST["q2"],
            "a2" => $_POST["a2"],
            "q3" => $_POST["q3"],
            "a3" => $_POST["a3"],
            "q4" => $_POST["q4"],
            "a4" => $_POST["a4"],
            "status" => "ex0"
        ]);
        
        $_SESSION['success_insert'] = "Topshiriq muvaffaqiyatli qo'shildi!";
        header("Location: add-exercise.php");
    
    }
    
    if(isset($_POST['add-exercise-ex1'])){
    
        $add = $db->insert("exercises", [
            "element_id" => $_POST['element_id'],
            "question" => $_POST['question'],
            "answer" => $_POST['answer'],
            "status" => "ex1"
        ]);
        
        
        header("Location: exercises.php");
    
    }
    
    if(isset($_POST['add-exercise-ex1-continue'])){
    
        $add = $db->insert("exercises", [
            "element_id" => $_POST['element_id'],
            "question" => $_POST['question'],
            "answer" => $_POST['answer'],
            "status" => "ex1"
        ]);
        
        $_SESSION['success_insert'] = "Topshiriq muvaffaqiyatli qo'shildi!";
        header("Location: add-exercise.php");
    
    }
    
    if(isset($_POST['add-exercise-ex2'])){
    
        $add = $db->insert("exercises", [
            "element_id" => $_POST['element_id'],
            "question_test" => $_POST['question_test'],
            "answer" => $_POST['answer'],
            "status" => "ex2"
        ]);
        
        
        header("Location: exercises.php");
    
    }
    
    if(isset($_POST['add-exercise-ex2-continue'])){
    
        $add = $db->insert("exercises", [
            "element_id" => $_POST['element_id'],
            "question_test" => $_POST['question_test'],
            "answer" => $_POST['answer'],
            "status" => "ex2"
        ]);
        
        $_SESSION['success_insert'] = "Topshiriq muvaffaqiyatli qo'shildi!";
        header("Location: add-exercise.php");
    
    }

}else{
    $_SESSION['error_insert'] = "Bu elementga topshiriq allaqachon qo'shilgan!";
    header("Location: add-exercise.php");
}

?>