<?php
session_start();
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

if(isset($_POST['add-quiz'])){

    $add = $db->insert("yn_quizzes", [
        "question" => $_POST["question"],
        "a" => $_POST["a"],
        "b" => $_POST["b"],
        "c" => $_POST["c"],
        "d" => $_POST["d"],
        "answer" => $_POST["answer"]
    ]);
    
    
    header("Location: yn-quizzes.php");

}

if(isset($_POST['add-quiz-continue'])){

    $add = $db->insert("yn_quizzes", [
        "question" => $_POST["question"],
        "a" => $_POST["a"],
        "b" => $_POST["b"],
        "c" => $_POST["c"],
        "d" => $_POST["d"],
        "answer" => $_POST["answer"]
    ]);
    
    $_SESSION['success_insert'] = "Muvaffaqiyatli qo'shildi!";
    header("Location: add-yn-quiz.php");

}

?>