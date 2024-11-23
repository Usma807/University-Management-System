<?php

include("header.php");
include("navbar.php");

$data4 = $db->retrieve("users");
$data4 = json_decode($data4, 1);

$data3 = $db->retrieve("ai_files");
$data3 = json_decode($data3, 1);

if(isset($_POST['rate_user'])){
    $got_user_id = $_POST['user_id'];
    $mt_id = $_POST['ai_id'];
    $rate = $_POST['ai_user_rate'];

    $data2 = $db->retrieve("rate_ai_users");
    $data2 = json_decode($data2, 1);

    $check = true;

    foreach ($data2 as $id2 => $arr2) {
        if($arr2['ai_id'] == $mt_id && $arr2['user_id'] == $got_user_id) {
            $check = false;
        }
    }
    if($check) {
        $add = $db->insert("rate_ai_users", [
            "ai_user_rate" => $_POST['ai_user_rate'],
            "ai_id" => $_POST['ai_id'],
            "user_id" => $_POST['user_id']
        ]); 
    }if(!$check){
        $_SESSION['error_insert'] = "Foydalanuvchi baholangan!";
    }
}

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
<div class="container p-4" style="margin-top:-95px;">
    <form action="rate-ai.php" method="POST" class="container ml-2 mr-2 p-3 form-group shadow rounded">
        <h4 class="text-center">Amaliy ishlarni baholash</h4>

        <select name="user_id" id="user_id" class="form-control mb-2">
            <?php
            
                foreach($data4 as $id4 => $arr4){
                    echo "
                        <option value='{$id4}'>{$arr4['name']} {$arr4['surname']}</option>
                    ";
                }
            
            ?>
        </select>
        <select name="ai_id" id="ai_id" class="form-control mb-2">
            <?php
            
                foreach($data3 as $id3 => $arr3){
                    echo "
                        <option value='{$id3}'>{$arr3['ai_name']}</option>
                    ";
                }
            
            ?>
        </select>
        <input type="submit" name="get_user_works1" value="Natijalarni olish" class="btn btn-success">

    </form>
</div>


<?php

if(isset($_POST['get_user_works1'])){
    $data5 = $db->retrieve("ai_works");
    $data5 = json_decode($data5, 1);
    if($data5 != null){
        foreach($data5 as $id5 => $arr5){
            if($arr5['user_id'] == $_POST['user_id'] && $arr5['ai_id'] == $_POST['ai_id']){
                echo "
                    <div class='container pl-4'>
                        <div class='row p-2'>
                            <div class='col-md-5 m-2 p-2 bg-primary rounded'>
                                <span class='p-1 shadow'>
                                    <a href='../ai-works/{$arr5['ai_file']}' class='btn btn-success' download>Yuklab olish</a>
                                </span>
                            </div>
                            <div class='col-md-5 m-2 p-2 bg-primary rounded'>
                                <form action='rate-ai.php' method='POST' class='bg-light rounded shadow p-2'>
                                    <input type='number' name='ai_user_rate' placeholder='Ball' class='form-control'>
                                    <input type='hidden' name='ai_id' value='{$_POST['ai_id']}' class='form-control'>
                                    <input type='hidden' name='user_id' value='{$_POST['user_id']}' class='form-control'>
                                    <input type='submit' name='rate_user' value='baholash' class='btn btn-success mt-2'>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    }
}

?>



<?php

include("footer.php");

?>