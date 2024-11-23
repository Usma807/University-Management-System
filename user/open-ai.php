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
<?php

$got_id = $_GET['id'];

$data = $db->retrieve("ai_files/{$got_id}");
$data = json_decode($data, 1);

if($data != null){
    echo "
        <div class='container p-4'>
            <div class='form-group container shadow rounded bg-primary p-3'>
                <div class='row p-2'>
                    <div class='col-md-4 p-3 bg-light rounded'>
                        <h4 class=''>{$data['ai_name']}</h4>
                        <a href='../ai/{$data['ai_file']}' download class='btn btn-success'>Yuklab olish</a>
                    </div>
                    <div class='col-md-4'>
                        <form action='upload-ai-work.php' method='POST' enctype='multipart/form-data' class='shadow rounded bg-light p-2'>
                            <input type='hidden' name='ai_id' value='{$got_id}'>
                            <input type='file' name='file' placeholder='M.t topshirish fayli' class='form-control mb-2'>
                            <input type='submit' name='upload' value='Yuborish' class='btn btn-primary'>
                        </form>
                    </div>
    ";
}

$data1 = $db->retrieve("ai_works");
$data1 = json_decode($data1, 1);
$filename = "";
$found_id = "";
if($data1 != null){
    foreach ($data1 as $id1 => $arr1){
        if($arr1['ai_id'] = $got_id && $arr1['user_id'] = $_SESSION['id']){
            $found_id = $id1;
            $filename = $arr1['ai_file'];
        }
    }
}

if($found_id != "" && $filename != ""){

    echo "
        <div class='col-md-4 p-3 bg-light rounded'>
            <span class='text-dark mb-2'>{$filename}</span><br><a href='delete-ai-work.php?id={$found_id}&file={$filename}' class='btn btn-danger mt-2'>O'chirish</a>
        </div>
    ";

}


echo "</div>
</div>
</div>";

?>




<?php

include("footer.php");

?>