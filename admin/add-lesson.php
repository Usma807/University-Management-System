<?php

include("header.php");
include("navbar.php");

?>
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

?>
<form action="add-lesson-action.php" method="post" autocomplete="false" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Dars qo'shish</h4>
    <strong>Dars nomi</strong>
    <input class="form-control mb-2" type="text" name="name" placeholder="Dars nomi.." required>
    <strong>Dars mavzusi</strong>
    <input class="form-control mb-2" type="text" name="topic" placeholder="Dars mavzusi.." required>
    <strong>Status</strong>
    <select name="status" class="form-control mb-2">
        <option value="draft">draft</option>
        <option value="published">published</option>
    </select>
    <input class="btn btn-success" type="submit" name="add-lesson" value="Qo'shish">
    <input class="btn btn-success" type="submit" name="add-lesson-continue" value="Qo'shish va Davom etish">
</form>

<?php

include("footer.php");

?>