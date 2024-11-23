<?php

include("header.php");
include("navbar.php");

$data4 = $db->retrieve("users");
$data4 = json_decode($data4, 1);

$data3 = $db->retrieve("mt_files");
$data3 = json_decode($data3, 1);

if(isset($_POST['rate_user'])){
    $got_user_id = $_POST['user_id'];
    $mt_id = $_POST['mt_id'];
    $rate = $_POST['mt_user_rate'];

    $data2 = $db->retrieve("rate_mt_users");
    $data2 = json_decode($data2, 1);

    $check = true;

    if(is_array($data2)){
        foreach ($data2 as $id2 => $arr2) {
            if($arr2['mt_id'] == $mt_id && $arr2['user_id'] == $got_user_id) {
                $check = false;
            }
        }
    }
    if($check) {
        $add = $db->insert("rate_mt_users", [
            "mt_user_rate" => $_POST['mt_user_rate'],
            "mt_id" => $_POST['mt_id'],
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
    <form action="rate-mt.php" method="POST" class="container ml-2 mr-2 p-3 form-group shadow rounded">
        <h4 class="text-center">Mustaqil ta'limni baholash</h4>

        <select name="user_id" id="user_id" class="form-control mb-2">
            <?php
            
                foreach($data4 as $id4 => $arr4){
                    echo "
                        <option value='{$id4}'>{$arr4['name']} {$arr4['surname']}</option>
                    ";
                }
            
            ?>
        </select>
        <select name="mt_id" id="mt_id" class="form-control mb-2">
            <?php
            
                foreach($data3 as $id3 => $arr3){
                    echo "
                        <option value='{$id3}'>{$arr3['mt_name']}</option>
                    ";
                }
            
            ?>
        </select>
        <input type="submit" name="get_user_works" value="Natijalarni olish" class="btn btn-success">

    </form>
</div>


<?php

if(isset($_POST['get_user_works'])){
    $data5 = $db->retrieve("mt_works");
    $data5 = json_decode($data5, 1);
    if($data5 != null){
        foreach($data5 as $id5 => $arr5){
            if($arr5['user_id'] == $_POST['user_id'] && $arr5['mt_id'] == $_POST['mt_id']){
                echo "
                    <div class='container pl-4'>
                        <div class='row p-2'>
                            <div class='col-md-5 m-2 p-2 bg-primary rounded'>
                                <span class='p-1 shadow'>
                                    <a href='../mt-works/{$arr5['mt_file']}' class='btn btn-success' download>Yuklab olish</a>
                                </span>
                            </div>
                            <div class='col-md-5 m-2 p-2 bg-primary rounded'>
                                <form action='rate-mt.php' method='POST' class='bg-light rounded shadow p-2'>
                                    <input type='number' name='mt_user_rate' placeholder='Ball' class='form-control'>
                                    <input type='hidden' name='mt_id' value='{$_POST['mt_id']}' class='form-control'>
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