<?php

include("header.php");
include("navbar.php");

$data = $db->retrieve("lessons");
$data = json_decode($data, 1);

?>

<style>
    table.mceLayout, textarea.tinyMCE {
    width: 100% !important;
    }

    @media only screen and (min-width: 600px) {
        table.mceLayout, textarea.richEditor {
        width: 600px !important;
        }
    }
</style>
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

<form action="add-plan-action.php" method="post" autocomplete="false" enctype="multipart/form-data" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Reja qo'shish</h4>
    <strong>Dars detali</strong>
    <select name="lesson_id" id="lesson_id" class="form-control mb-2">
        <?php
        
            if($data != null){
                foreach($data as $id => $arr){
                    echo "<option value='{$id}'>{$arr['name']} - {$arr['topic']}</option>";
                }
            }

        ?>
    </select>
    <strong>Reja</strong>
    <input class="form-control mb-2" type="text" name="plan_name" placeholder="Reja.." required>
    <strong>Mavzu</strong>
    <input name="plan_topic" id="plan_topic" class="form-control mb-2" placeholder="Mavzu.." required>
    <input class="btn btn-success mt-2" type="submit" name="add-plan" value="Qo'shish">
</form>
<?php

include("footer.php");

?>