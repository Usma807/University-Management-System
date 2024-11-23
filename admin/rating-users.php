<?php

include("header.php");
include("navbar.php");

$data2 = $db->retrieve("elements");
$data2 = json_decode($data2, 1);

$data3 = $db->retrieve("results");
$data3 = json_decode($data3, 1);

$data4 = $db->retrieve("users");
$data4 = json_decode($data4, 1);


?>
<?php

if(isset($_SESSION['error_rating'])){
    echo "
        <div style='width:40%;margin-left:60%;margin-top:-35px;margin-bottom:45px;padding-right:20px;'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='background-color:red;color:#fff;'>
                <span class='text-light text-center'>{$_SESSION['error_rating']}</span>
                <button type='button' class='close' onclick='unset()' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>
    ";
    unset($_SESSION['error_rating']);
}
if(isset($_SESSION['success_rating'])){
    echo "
        <div style='width:40%;margin-left:60%;margin-top:-35px;margin-bottom:45px;padding-right:20px;'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='background-color:green;color:#fff;'>
                <span class='text-light text-center'>{$_SESSION['success_rating']}</span>
                <button type='button' class='close' onclick='unset()' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>
    ";
    unset($_SESSION['success_rating']);
}

?>

<div class="container pl-4 pr-4">
    <form action="rate-function.php" method="POST" class="container ml-2 mr-2 p-3 form-group shadow rounded">
    <h4 class="text-center">Elementlar bo'yicha baholash</h4>

<select name="user_id" id="user_id" class="form-control mb-2">
    <?php
    
        

        foreach($data4 as $id4 => $arr4){
            echo "
                <option value='{$id4}'>{$arr4['name']} {$arr4['surname']}</option>
            ";
        }
    
    ?>
</select>
<input type="submit" name="get_user_results" value="Natijalarni olish" class="btn btn-success">

</form>

<?php

if(isset($_SESSION['check'])){
    if($_SESSION['check']){
        echo "
            <div class='container p-3'>
                <span class='bg-primary text-light rounded p-2 mb-2'>Olingan natijalar</span>
                <div class='row p-2 mt-2'>
                    <div class='col-md-6 shadow bg-primary rounded p-3'>
                        <h5 class='text-light'>Foydalanuvchi F.I.SH - {$_SESSION['got_user_fullname']}</h5>
                        <h6 class='text-light'>Foydalanuvchi o'zlashtirishi - {$_SESSION['got_user_rate']}</h6>
                        <h6 class='text-light'>Foydalanuvchiga berilgan ball - {$_SESSION['got_user_rating']}</h6>
                    </div>
                    <div class='col-md-6'>
                        <form action='rate-user-action.php' method='POST' class='shadow rounded p-3'>
                            <input type='number' name='rate' class='form-control mb-2' placeholder='F.ga berilgan baho..' value='{$_SESSION['got_user_rating']}'>
                            <input type='hidden' name='user_id' value='{$_SESSION['got_user_id']}'>
                            <input type='hidden' name='user_rate' value='{$_SESSION['got_user_rate']}'>
                            <input type='hidden' name='user_rating' value='{$_SESSION['got_user_rating']}'>
                            <input type='submit' name='rate_user' class='btn btn-success' value='Baholash'>
                        </form>
                    </div>
                </div>
            </div>
        ";
    }
    $_SESSION['check'] = false;
}

?>


<?php

include("footer.php");


?>