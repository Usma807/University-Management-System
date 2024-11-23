<?php

include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

?>
<script>
    class Question {
    constructor(questionText, answers, correctAnswer) {
        this.questionText = questionText;
        this.answers = answers;
        this.correctAnswer = correctAnswer;
    }

    checkAnswer(answer) {
        return answer === this.correctAnswer;
    }
}

let questions = [
    <?php
    $data = $db->retrieve("yn_quizzes");
    $data = json_decode($data, 1);
        if($data != null) {
            foreach($data as $id => $arr) {
                echo "
                    new Question('{$arr['question']}', {
                        a: '{$arr['a']}',
                        b: '{$arr['b']}',
                        c: '{$arr['c']}',
                        d: '{$arr['d']}'
                    }, '{$arr['answer']}'),
                ";
    
            }
        }
        
    ?>

];
</script>