<?php

include("question.php");

if($_GET['id'] == ""){
    header("Location: results.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- Start Button -->
    <button class="btn-start btn btn-warning btn-lg text-white">Boshlash</button>

    <!-- Quiz Box -->
    <div class="quiz-box card">
        <header class="card-header">
            <span>Yakuniy nazorat</span>
            <div class="time">
                <div class="time-text">Qolgan vaqt</div>
                <div class="second">10</div>
            </div>
            <div class="time-line"></div>
        </header>

        <section class="card-body">
            <div class="question-text">
                <!-- <span> Question Text </span> -->
            </div>
            <div class="option-list">
                <!-- <div class="option">
                    <span> a : Variant A</span>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <div class="option correct">
                    <span> b : Variant B</span>
                    <div class="icon">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="option incorrect">
                    <span> c : Variant C</span>
                    <div class="icon">
                        <i class="fas fa-times"></i>
                    </div>
                </div> -->
            </div>
        </section>

        <footer class="card-footer">
            <div class="badge bg-secondary"></div>
            <button class="btn btn-primary next">Keyingi savol</button>
        </footer>
    </div>

    <!-- Score Box -->
    <div class="score-box card">
        <i class="fa-solid fa-flag-checkered icon"></i>
        <span class="score-text"></span>
        <div class="buttons">
            <div class="btn btn-lg btn-primary replay-btn" style="display:none;"></div>
            <div class="btn btn-lg btn-primary quit-btn"><a href="" style="text-decoration: none;color: snow;">Yakunlash</a></div>
        </div>

    </div>


    <!-- JavaScript Files -->
    <script src="quiz.js"></script>

<script>
    const quiz = new Quiz(questions);

    // Start Button event
    document.querySelector(".btn-start").addEventListener("click", () => {
        document.querySelector(".quiz-box").classList.add("active");
        showQuestion(quiz.callQuestion());
        showNumber(quiz.questionIndex + 1, quiz.questions.length);
        startTimer(10);
        startLine();
    });

    // Next Button event
    document.querySelector(".next").addEventListener("click", () => {
        if (quiz.questions.length > quiz.questionIndex + 1) {
            document.querySelector(".quiz-box").classList.add("active");
            clearInterval(counter);
            startTimer(10);
            clearInterval(counterLine);
            startLine();
            quiz.questionIndex++;
            showQuestion(quiz.callQuestion());
            showNumber(quiz.questionIndex + 1, quiz.questions.length);
        } else {
            console.log("The End");
            clearInterval(counter);
            clearInterval(counterLine);
            document.querySelector(".quiz-box").classList.remove("active");
            document.querySelector(".score-box").classList.add("active");
            showScore(quiz.correctAnswers, quiz.questions.length);
        }
    });

    // Replay Button event
    document.querySelector(".replay-btn").addEventListener("click", () => {
        quiz.questionIndex = 0;
        quiz.correctAnswers = 0;
        document.querySelector(".btn-start").click();
        document.querySelector(".score-box").classList.remove("active");
    });

    // Quit Button event
    document.querySelector(".quit-btn").addEventListener("click", () => {
        window.location.reload();
    });

    const option_list = document.querySelector(".option-list");
    const correctIcon = '<div class="icon"><i class="fas fa-check"></i></div>';
    const incorrectIcon = '<div class="icon"><i class="fas fa-times"></i></div>';

    //Function for Show Questions 
    function showQuestion(question) {
        let question_text = `<span> ${question.questionText} </span> `;
        let options = '';

        for (let answer in question.answers) {
            options +=
                `
                <div class="option">
                    <span><b>${answer}</b>: ${question.answers[answer]}</span>
                </div>
            `;
        }

        document.querySelector(".question-text").innerHTML = question_text;
        option_list.innerHTML = options;

        const option = option_list.querySelectorAll(".option");

        for (opt of option) {
            opt.setAttribute("onclick", "optionSelected(this)");
        }
    }

    // Function for Options
    function optionSelected(option) {
        clearInterval(counter);
        clearInterval(counterLine);
        let answer = option.querySelector("span b").textContent;
        let question = quiz.callQuestion();

        if (question.checkAnswer(answer)) {
            option.classList.add("correct");
            option.insertAdjacentHTML("beforeend", correctIcon);
            quiz.correctAnswers++;
        } else {
            option.classList.add("incorrect");
            option.insertAdjacentHTML("beforeend", incorrectIcon);
        }

        for (let i = 0; i < option_list.children.length; i++) {
            option_list.children[i].classList.add("disabled");
        }
    }

    // Function for Show Number of Questions
    function showNumber(questionNumber, allQuestions) {
        let tag = `<span>${questionNumber} / ${allQuestions}</span>`;
        document.querySelector(".badge").innerHTML = tag;
    }

    // Function for Show Score
    function showScore(correctAnswers, allQuestions) {
        let tag = `Siz [ ${correctAnswers} / ${allQuestions} ] ta topdingiz`;
        document.querySelector(".score-text").innerHTML = tag;
        document.querySelector(".quit-btn a").href = `quiz-result.php?score=${correctAnswers}`;
    }

    // Timer 
    let counter;

    function startTimer(time) {
        counter = setInterval(timer, 1000);

        function timer() {
            document.querySelector(".second").textContent = time;
            time--;

            if (time < 0) {
                clearInterval(counter);

                document.querySelector(".time-text").textContent = "Vaqt tugadi";

                let answer = quiz.callQuestion().correctAnswer;

                for (let option of option_list.children) {
                    if (option.querySelector("span b").textContent == answer) {
                        option.classList.add("correct");
                        option.insertAdjacentHTML("beforeend", correctIcon);
                    }
                    option.classList.add("disabled");
                }
            }
        }

    }


    // Time Line
    let counterLine;

    function startLine() {
        counterLine = setInterval(timer, 20);
        let lineWidth = 0;

        function timer() {
            document.querySelector(".time-line").style.width = lineWidth + "%";
            lineWidth += 0.181;

            if (lineWidth > 100.1) {
                clearInterval(counterLine);
            }
        }
    }
</script>
</body>

</html>

