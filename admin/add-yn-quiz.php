<?php

include("header.php");
include("navbar.php");


?>


<?php


if(isset($_SESSION['success_insert'])){
    echo "
        <div style='width:40%;margin-left:60%;margin-top:-35px;margin-bottom:45px;padding-right:20px;'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='background-color:green;color:#fff;'>
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

<form action="add-yn-quiz-action.php" method="post" autocomplete="false" enctype="multipart/form-data" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Test qo'shish</h4>
    <strong>Savol</strong>
    <input class="form-control mb-2" type="text" name="question" placeholder="Savol.." required>
    <strong>A javob</strong>
    <input class="form-control mb-2" type="text" name="a" placeholder="A javob.." required>
    <strong>B javob</strong>
    <input class="form-control mb-2" type="text" name="b" placeholder="B javob.." required>
    <strong>C javob</strong>
    <input class="form-control mb-2" type="text" name="c" placeholder="C javob.." required>
    <strong>D javob</strong>
    <input class="form-control mb-2" type="text" name="d" placeholder="D javob.." required>
    <strong>To'g'ri javob</strong>
    <select name="answer" id="answer" class="form-control mb-2">
        <option value="a">A</option>
        <option value="b">B</option>
        <option value="c">C</option>
        <option value="d">D</option>
    </select>
    <input class="btn btn-success mt-2" type="submit" name="add-quiz" value="Qo'shish">
    <input class="btn btn-success mt-2" type="submit" name="add-quiz-continue" value="Qo'shish va Davom etish">
</form>

<?php

include("footer.php");

?>