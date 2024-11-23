<?php

include("header.php");
include("navbar.php");

$data = $db->retrieve("elements");
$data = json_decode($data, 1);

?>

<style>
    #h1,#h2,#h3{
        cursor: pointer;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#ex2").hide();
        $("#ex3").hide();
        $("#h1").click(function(){
            $("#ex3").hide();
            $("#ex2").hide();
            $("#ex1").show(700);
        })
        $("#h2").click(function(){
            $("#ex1").hide();
            $("#ex3").hide();
            $("#ex2").show(700);
        })
        $("#h3").click(function(){
            $("#ex1").hide();
            $("#ex2").hide();
            $("#ex3").show(700);
        })
    })
</script>


<?php

if(isset($_SESSION['error_insert'])){
    echo "
        <div style='width:40%;margin-left:60%;margin-top:-35px;margin-bottom:45px;padding-right:20px;'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='background-color:red;color:#fff;'>
                <span class='text-light text-center'>{$_SESSION['error_insert']}</span>
                <button type='button' class='close' onclick='unset()' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>
    ";
    unset($_SESSION['error_insert']);
}

if(isset($_SESSION['success_insert'])){
    echo "
        <div style='width:40%;margin-left:60%;margin-top:-35px;margin-bottom:45px;padding-right:20px;'>
            <div class='alert alert-primary alert-dismissible fade show' role='alert' style='background-color:#eb8153;color:#fff;'>
                <span class='text-light text-center'>{$_SESSION['success_insert']}</span>
                <button type='button' class='close' onclick='unset()' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>
    ";
    unset($_SESSION['success_insert']);
}

?>

<div class="row pl-5 text-center" style="width:80%;margin:0 auto;margin-bottom:15px;">
    <div class="col-md-3 bg-success text-light rounded m-1" id="h1">
        <h4 class="text-center text-light pl-1 pr-1 pb-1 pt-3">Moslikni topish</h4>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3 bg-success text-light rounded m-1" id="h2">
        <h4 class="text-center text-light pt-2 pl-1 pr-1 pb-1">Bo'sh joyni to'ldirish</h4>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3 bg-success text-light rounded m-1" id="h3">
        <h4 class="text-center text-light pt-3 pl-1 pr-1 pb-1">Test</h4>
    </div>
    <div class="col-md-1"></div>
</div>


<form action="add-exercise-action.php" id="ex1" method="post" autocomplete="false" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Moslikni topish</h4>
    <strong>Element detali</strong>
    <select name="element_id" id="element_id" class="form-control mb-2">
        <?php
        
            if($data != null){
                foreach($data as $id => $arr){
                    echo "<option value='{$id}'>{$arr['lesson_element']} - {$arr['lesson_topic']}</option>";
                }
            }

        ?>
    </select>
    <strong>Savol 1</strong>
    <textarea name="q1" id="q1" placeholder="Savol 1" class="form-control mb-2" required></textarea>
    <strong>Javob 1</strong>
    <textarea name="a1" id="a1" placeholder="Javob 1" class="form-control mb-2" required></textarea>
    <strong>Savol 2</strong>
    <textarea name="q2" id="q2" placeholder="Savol 2" class="form-control mb-2" required></textarea>
    <strong>Javob 2</strong>
    <textarea name="a2" id="a2" placeholder="Javob 2" class="form-control mb-2" required></textarea>
    <strong>Savol 3</strong>
    <textarea name="q3" id="q3" placeholder="Savol 3" class="form-control mb-2" required></textarea>
    <strong>Javob 3</strong>
    <textarea name="a3" id="a3" placeholder="Javob 3" class="form-control mb-2" required></textarea>
    <strong>Savol 4</strong>
    <textarea name="q4" id="q4" placeholder="Savol 4" class="form-control mb-2" required></textarea>
    <strong>Javob 4</strong>
    <textarea name="a4" id="a4" placeholder="Javob 4" class="form-control mb-2" required></textarea>
    <input class="btn btn-success" type="submit" name="add-exercise" value="Qo'shish">
    <input class="btn btn-success" type="submit" name="add-exercise-continue" value="Qo'shish va Davom etish">
</form>

<form action="add-exercise-action.php" id="ex2" method="post" autocomplete="false" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Bo'sh joyni to'ldirish</h4>
    <strong>Element detali</strong>
    <select name="element_id" id="element_id" class="form-control mb-2">
        <?php
        
            if($data != null){
                foreach($data as $id => $arr){
                    echo "<option value='{$id}'>{$arr['lesson_element']} - {$arr['lesson_topic']}</option>";
                }
            }

        ?>
    </select>
    <strong>Savol</strong>
    <textarea name="question" id="question" placeholder="Savol.." class="form-control mb-2" required></textarea>
    <strong>Javob</strong>
    <input name="answer" id="answer" placeholder="Javob.." class="form-control mb-2" required>
    <input class="btn btn-success" type="submit" name="add-exercise-ex1" value="Qo'shish">
    <input class="btn btn-success" type="submit" name="add-exercise-ex1-continue" value="Qo'shish va Davom etish">
</form>

<form action="add-exercise-action.php" id="ex3" method="post" autocomplete="false" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Test</h4>
    <strong>Element detali</strong>
    <select name="element_id" id="element_id" class="form-control mb-2">
        <?php
        
            if($data != null){
                foreach($data as $id => $arr){
                    echo "<option value='{$id}'>{$arr['lesson_element']} - {$arr['lesson_topic']}</option>";
                }
            }

        ?>
    </select>
    <strong>Savollar</strong>
    <textarea name="question_test" id="question_test" focusable="true" placeholder="Savollar.." class="form-control mb-2"></textarea>
    <strong>Javoblar</strong>
    <input name="answer" id="answer" placeholder="a,b,c,d.." class="form-control mb-2" required>
    <input class="btn btn-success" type="submit" name="add-exercise-ex2" value="Qo'shish">
    <input class="btn btn-success" type="submit" name="add-exercise-ex2-continue" value="Qo'shish va Davom etish">
</form>

<script src="../tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#question_test',
        height: 300,
        plugins:[
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
        'forecolor backcolor emoticons',
        menu: {
            favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
    });
</script>
<?php

include("footer.php");

?>