<?php 

include("header.php");
include("navbar.php");

include("time-floor.php");

?>

<?php
    $startTime = microtime(true);
    $data = $db->retrieve("admins");
    $data = json_decode($data, 1);
    $admins = 0;
    foreach($data as $id => $arr){
        $admins ++;
    }

?>


<?php

    $data = $db->retrieve("users");
    $data = json_decode($data, 1);
    $users = 0;
    if($data != null){
        foreach($data as $id => $arr){
            $users ++;
        }
    }

?>

<?php

    $data = $db->retrieve("lessons");
    $data = json_decode($data, 1);
    $lessons = 0;
    if($data != null){
        foreach($data as $id => $arr){
            $lessons ++;
        }
    }

?>

<?php

    $data = $db->retrieve("plans");
    $data = json_decode($data, 1);
    $plans = 0;
    if($data != null){
        foreach($data as $id => $arr){
            $plans ++;
        }
    }

?>

<?php

    $data = $db->retrieve("elements");
    $data = json_decode($data, 1);
    $elements = 0;
    if($data != null){
        foreach($data as $id => $arr){
            $elements ++;
        }
    }

?>


<?php

    $data = $db->retrieve("details");
    $data = json_decode($data, 1);
    $details = 0;
    if($data != null){
        foreach($data as $id => $arr){
            $details ++;
        }
    }
    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    $formattedTime = formatExecutionTime($executionTime);
    echo "<span class='bg-success text-light p-1 rounded' style='margin-left:4%;'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;
?>

<style>
    body{
    margin-top:20px;
    background:#FAFAFA;
    }
    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 25px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="mb-5 text-light">Adminlar</h6>
                    <h2 class="text-right"><i class="fa fa-users f-left text-light"></i><span class="text-light"><?php echo $admins; ?></span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="mb-5 text-light">Foydalanuvchilar</h6>
                    <h2 class="text-right"><i class="fa fa-users f-left text-light"></i><span class="text-light"><?php echo $users; ?></span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="mb-5 text-light">Darslar</h6>
                    <h2 class="text-right"><i class="fa fa-play f-left text-light"></i><span class="text-light"><?php echo $lessons; ?></span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="mb-5 text-light">Rejalar</h6>
                    <h2 class="text-right"><i class="fa fa-play f-left text-light"></i><span class="text-light"><?php echo $plans; ?></span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="mb-5 text-light">Elementlar</h6>
                    <h2 class="text-right"><i class="fa fa-play f-left text-light"></i><span class="text-light"><?php echo $elements; ?></span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="mb-5 text-light">Dars detallari</h6>
                    <h2 class="text-right"><i class="fa fa-puzzle-piece f-left text-light"></i><span class="text-light"><?php echo $details; ?></span></h2>
                </div>
            </div>
        </div>
	</div>
</div>


<?php

include("footer.php");

?>