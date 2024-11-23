<?php

include("header.php");
include("navbar.php");

$data = $db->retrieve("lessons");
$data = json_decode($data, 1);

$data1 = $db->retrieve("plans");
$data1 = json_decode($data1, 1);

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

<form action="add-element-action.php" method="post" autocomplete="false" enctype="multipart/form-data" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Element qo'shish</h4>
    <strong>Reja</strong>
    <select name="lesson_plan" id="lesson_plan" class="form-control mb-2">
        <?php
        
            if($data != null){
                foreach($data1 as $id1 => $arr1){
                    echo "<option value='{$id1}'>{$arr1['plan_name']} - {$arr1['plan_topic']}</option>";
                }
            }

        ?>
    </select>
    <strong>Element</strong>
    <input name="lesson_element" id="lesson_element" class="form-control mb-2" placeholder="Element.." required>
    <strong>Mavzu</strong>
    <input name="lesson_topic" id="lesson_topic" class="form-control mb-2" placeholder="Mavzu.." required>
    <input class="btn btn-success mt-2" type="submit" name="add-element" value="Qo'shish">
</form>
<?php

include("footer.php");

?>