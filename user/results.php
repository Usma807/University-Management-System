<?php 
session_start();
include("header.php");
include("navbar.php");

$data1 = $db->retrieve("ratings");
$data1 = json_decode($data1, 1);

$data = $db->retrieve("rating_system");
$data = json_decode($data, 1);

$data2 = $db->retrieve("rate_mt_users");
$data2 = json_decode($data2, 1);

$data3 = $db->retrieve("rate_ai_users");
$data3 = json_decode($data3, 1);

$data4 = $db->retrieve("yn_results");
$data4 = json_decode($data4, 1);

$mt_user_rate = 0;

if($data2 != null){
    foreach($data2 as $id2 => $arr2){
        if($arr2['user_id'] == $user_id){
            $mt_user_rate += $arr2['mt_user_rate'];
        }
    }
}

$ai_user_rate = 0;

if($data3 != null){
    foreach($data3 as $id3 => $arr3){
        if($arr3['user_id'] == $user_id){
            $ai_user_rate += $arr3['ai_user_rate'];
        }
    }
}

$gotON = "";
$gotMT = "";
$gotAI = "";
$gotYN = "";

foreach($data as $id => $arr){
    $gotON = $arr['on'];
    $gotMT = $arr['jmt'];
    $gotAI = $arr['jai'];
    $gotYN = $arr['yn'];
}

$user_yn_score = "";

if($data4 != null){
    foreach ($data4 as $id4 => $arr4){
        if($arr4['user_id'] == $user_id){
            $user_yn_score = $arr4['score'];
        }
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
<div class="container p-5" style="margin-top:-95px;">
    
    <div class="row p-3">
        <?php

            if($data1 != null){
                foreach ($data1 as $id => $arr){
                    if($arr['user_id'] == $user_id){
                        $SESSION['got_el_results'] = $arr['user_rating'];
                        echo "
                            <div class='col-md-5 p-3 m-2 shadow bg-primary text-light rounded'>
                                <h4 class='text-light mb-2'>{$name} {$surname}</h4>
                                <h5 class='text-light mb-2'>Elementlar bo'yicha ball - {$arr['user_rating']}</h5>
                                <h5 class='text-light mb-2'>Mustaqil ta'lim bo'yicha ball - {$mt_user_rate}</h5>
                                <h5 class='text-light mb-2'>Amaliy ishlar bo'yicha ball - {$ai_user_rate}</h5>
                                <h5 class='text-light mb-2'>Yakuniy nazorat bo'yicha ball - {$user_yn_score}</h5>
                            </div>
                            
                            <div class='col-md-5 p-3 m-2 shadow bg-primary text-light rounded'>
                                <h4 class='text-light mb-2'>Elementlar uchun max.ball - {$gotON}</h4>
                                <h5 class='text-light mb-2'>Mustaqil ta'lim uchun max.ball - {$gotMT}</h5>
                                <h5 class='text-light mb-2'>Amaliy ishlar uchun max.ball - {$gotAI}</h5>
                                <h5 class='text-light mb-2'>Yakuniy nazorat uchun max.ball - {$gotYN}</h5>
                            </div>
                            <div class='col-md-2'></div>
                        ";
                    }
                }
            }if($data1 == null){
                echo "<span class='bg-primary text-light p-2 rounded'>Natijalar topilmadi!</span>";
            }
            $check = false;

            if(isset($SESSION['got_el_results'])){
                $full_result = $mt_user_rate + $ai_user_rate + $SESSION['got_el_results'];
                if($full_result >= 30){
                    $check = true;
                }if($full_result < 30){
                    $check = false;
                }
            }
            if($check){
                echo "
                <div class='shadow rounded mt-3 p-3'>
                    <p style='font-weight:bold;'>Foydalanuvchi <strong>{$full_result}</strong> ball bilan yakuniy nazoratga qo'yildi.</p>
                    <a href='yn.php?id={$_SESSION['id']}' class='btn btn-primary'>Nazoratni boshlash</a>
                </div>
                ";
            }

        ?>
    </div>
</div>
<?php

include("footer.php");

?>