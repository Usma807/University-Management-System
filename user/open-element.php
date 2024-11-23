<?php 

    include("header.php");
    include("navbar.php");

    $got_id = $_GET['id'];

    $data = $db->retrieve("details");
    $data = json_decode($data, 1);
    $filename = "";
    if($data != null){
        foreach ($data as $key => $arr){
            if($data != null){
                if($arr['element_id'] == $got_id)    
                    $filename = $arr['filename'];
                    $lesson_text = $arr['lesson_text'];
                }
            }
    }

    if(isset($_SESSION['lesson_message'])){
        echo "
            <div class='container' style='margin-top:-35px;margin-bottom:45px;'>
                <div class='alert alert-success alert-dismissible fade show' role='alert' style='background-color:green;color:#fff;'>
                    <h5 class='text-light text-center'>{$_SESSION['lesson_message']}</h5>
                    <button type='button' class='close' onclick='unset()' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            </div>
        ";
        unset($_SESSION['lesson_message']);
    }

    if($filename != null){

            
        echo "

        <div class='container text-center' style='margin-top:-35px;'>
            <iframe src='../static/{$filename}' frameborder='0' width='100%' height='500px'></iframe>
        </div>
        <div class='container'><hr class='bg-primary'></div>
        <div class='container text-center rounded bg-light' style='margin-top: 15px;padding-top:20px;padding-bottom:20px;'>
            <div class='text-dark' style='color:black;'>{$lesson_text}</div>
        </div>
        <div class='container'><hr class='bg-primary'></div>

        ";


    }

?>
  
  <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        
        .container-box {
            max-width: 100%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 15px;
            display: grid;
            grid-template-columns: 50% 50%;
        }
        
        .container-box .list-container {
            border: 1px solid #ccc;
            padding: 10px;
        }
        
        .container-box .answer-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-left: 5px;
        }
        
        .container-box .list-container .list-item {
            width: 90%;
            margin: 0 auto;
            text-align: center;
            background-color: darkblue;
            color: snow;
            margin-bottom: 7px;
            margin-top: 7px;
            padding: 10px;
            border-radius: 7px;
        }
        
        .container-box .answer-container .answer-item {
            width: 90%;
            margin: 0 auto;
            text-align: center;
            background-color: green;
            color: snow;
            margin-bottom: 7px;
            margin-top: 7px;
            padding: 10px;
            border-radius: 7px;
        }
        
        .active {
            transition: .5s ease-in-out;
            animation: animate 500ms linear infinite;
            background-color: green;
        }
        
        @keyframes animate {
            0% {
                transform: scale(1);
            }
            25% {
                transform: scale(1.05);
            }
            50% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.05);
            }
        }
        
        #complete {
            width: 80%;
            margin-left: 10%;
            background-color: green;
            outline: 2px solid transparent;
            color: #fff;
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 7px;
        }
    </style>
<?php

    $data = $db->retrieve("exercises");
    $data = json_decode($data, 1);

    if($data != null){
        foreach ($data as $key => $arr){
            if($data != null){
                if($arr['element_id'] == $got_id){
                if($arr['status'] == "ex0"){
                        $n = range(1,4);
                        shuffle($n);
                            
                        echo "
                            <div class='container mb-2'>
                            <h5 style='text-align:center;margin-top:20px;width:100%;background-color:#eb8153;color:#fff;padding:10px;border-top-left-radius:10px;border-top-right-radius:10px;'>Mavzu yuzasidan topshiriq</h5>
                            <div class='container-box'>
                        ";
                        echo "<div class='list-container'>";
                        for($x=0;$x<4;$x++){     
                            $name = "q{$n[$x]}";
                            echo "
                                    <div class='list-item' id='{$n[$x]}'>{$arr[$name]}</div>
                            ";
                        }
                        echo "</div>";
                        echo "<div class='answer-container'>";
                        $m = range(1,4);
                        shuffle($m);
                        for($x=0;$x<4;$x++){
                            $name = "a{$m[$x]}";     
                            echo "
                                    <div class='answer-item' id='{$m[$x]}'>{$arr[$name]}</div>
                        ";
                        }
                        echo "
                        </div>
                            <a href='lesson-complete.php?id={$got_id}&user_id={$user_id}&rate=100' id='compBtn'><button id='complete'>Darsni yakunlash</button></a>
                        </div>
                        </div>
                            
                        ";
                }
                if($arr['status'] == "ex1"){
                    $q = $arr['question'];
                    $a = $arr['answer'];
                    echo "
                    
                            <div class='container mt-2'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='card'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>Tushirib qoldirilgan so'zni toping.</h5>
                                                <p class='card-text'>{$q}</p>
                                                <form name='my_form'>
                                                    <input type='text' name='word_input' class='form-control' id='word_input'>
                                                </form>
                                                <button class='btn btn-success' onclick='check()' id='submitBtn' style='bakcground-color:green;color:#fff;margin-top:15px;'>Yuborish</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            
                    ";
                }
                if($arr['status'] == "ex2"){
                    $question_test = $arr['question_test'];
                    $test_answer = $arr['answer'];
                    echo "
                        <div class='container mt-2'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>Mavzu yuzasidan testlar</h5>
                                            <div class='card-text'>{$question_test}</div>
                                            <form name='test_form'>
                                                <input type='text' name='answer_input' class='form-control' placeholder='a,b,c,.. kabi kiriting' id='word_input'>
                                            </form>
                                            <button class='btn btn-success' onclick='check_test()' id='submitTest' style='bakcground-color:green;color:#fff;margin-top:15px;'>Yakunlash</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
                }
            }
            }
    }

?>  

                        <script>
                            let listItem = document.getElementsByClassName('list-item');
                            let answerItem = document.getElementsByClassName('answer-item');
                            document.getElementById('compBtn').style.display = 'none';
                            let count = 0;
                            for (let item of listItem) {
                                item.addEventListener('click', e => {
                                    e.preventDefault();
                                    let selected = e.target;
                                    let selectedID = e.target.id;
                                    if (e.target.id === selectedID) {
                                        e.target.classList.toggle('active');
                                        for (let item of listItem) {
                                            if (item.id !== selectedID) {
                                                item.classList.remove('active');
                                            }
                                        }
                                    } else {
                                        e.target.classList.remove('active');
                                    }
    
                                    for (let aitem of answerItem) {
    
                                        aitem.addEventListener('click', e => {
                                            e.preventDefault();
                                            if (e.target.id === selectedID) {
                                                e.target.style.display = 'none';
                                                selected.style.display = 'none';
                                            }
    
                                            if (e.target.style.display === 'none') {
                                                if (selected.style.display === 'none') {
                                                    console.log(e.target);
                                                    count += 1;
                                                }
                                            }
                                            if (count == 4) {
                                                document.querySelector('.list-container').style.display = 'none';
                                                document.querySelector('.answer-container').style.display = 'none';
                                                document.querySelector('.container').style.display = 'block';
                                                document.getElementById('compBtn').style.display = 'block';
                                            }
                                        });
                                    }
    
                                })
                            };
                        </script>
                        <script>
                            const btn = document.getElementById('submitTest');
                            var my_v = "<?php echo $a; ?>";
                            var id = "<?php echo $got_id; ?>";
                            var user_id = "<?php echo $user_id; ?>";
                            function check(){
                                if(document.my_form.word_input.value === my_v){
                                    alert('Tabriklaymiz!!! Javobingiz to\'g\'ri. ');
                                    window.location.href = `lesson-complete.php?id=${id}&user_id=${user_id}&rate=100`;
                                }if(document.my_form.word_input.value != my_v){
                                    alert('Afsuski javobingiz noto\'g\'ri. ');
                                }
                            }
                        </script>   
                        <script>
                            function check_test(){
                                var id = "<?php echo $got_id; ?>";
                                var user_id = "<?php echo $user_id; ?>";
                                myarr = document.test_form.answer_input.value;
                                arr = "<?php echo $test_answer; ?>";
                                answ = arr.split(',');
                                mans = myarr.split(',');
                                let count = 0;
                                for(var i = 0; i < mans.length; i++){
                                    if(answ[i] == mans[i]){
                                        count++;
                                    }
                                }
                                rate = count/(mans.length);
                                if(rate*100 >= 60){
                                    alert("Tabriklaymiz!!! Siz ushbu dars testidan " + rate*100+" % natija oldingiz.");
                                    window.location.href = `lesson-complete.php?id=${id}&user_id=${user_id}&rate=${rate*100}`;
                                }if(rate*100 < 60){
                                    alert("Afsuski natijangiz darsni yakunlash uchun yetarli emas! Natija: " + rate*100);
                                }
                            }
                        </script> 

<?php 

include("footer.php");

?>