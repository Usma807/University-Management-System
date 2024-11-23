<?php 


include("header.php");
include("navbar.php");

$data = $db->retrieve("lessons");
$data = json_decode($data, 1);
$data1 = $db->retrieve("plans");
$data1 = json_decode($data1, 1);
$data2 = $db->retrieve("elements");
$data2 = json_decode($data2, 1);

$data3 = $db->retrieve("results");
$data3 = json_decode($data3, 1);

$completed_elements = 0;
if($data3 != null){
    foreach($data3 as $id3 => $arr3){

        if($arr3['user_id'] == $user_id){
    
            $completed_elements += 1;
    
        }
    
    }
}


$sum_elements = 0;

foreach($data2 as $id2 => $arr2){

    $sum_elements += 1;

}


$user_rating_percent = floor(($completed_elements / $sum_elements) * 100);

?>

<div class="container p-5">
    <div class="row">
        <div class="col-md-5 bg-primary text-light p-3 shadow rounded ml-2 mr-2 mb-2">
            <h4 class="text-light"><?php echo $name." ".$surname; ?></h4>
            <i><?php echo $email; ?></i>
            <h5 class="text-light mt-2">Elementlar bo'yicha o'zlashtirish - <?php echo $user_rating_percent ?>%</h5>
        </div>
    </div>
    <div class="row">
<?php
$lesson_name = "";
foreach ($data as $id => $arr){
    if($arr['status'] == "published"){
        $lesson_name = $arr['name'] ." ". $arr['topic'];
        echo "
            <div class='col-md-3 p-3 shadow rounded m-2'><h6>{$lesson_name}</h6>
        ";
        foreach ($data1 as $id1 => $arr1) {
            if ($arr1['lesson_id'] == $id) {
                echo "
                    <span style='display:block;margin-bottom:15px;margin-top:15px;'>{$arr1['plan_name']} - {$arr1['plan_topic']}</span>
                ";
        
                foreach ($data2 as $id2 => $arr2) {
                    if ($arr2['lesson_plan'] == $id1) {
                        $isCompleted = false;
                        if (!empty($data3)) {
                            foreach ($data3 as $id3 => $arr3) {
                                if ($arr3['user_id'] == $user_id && $arr3['element_id'] == $id2) {
                                    $isCompleted = true;
                                    break;
                                }
                            }
                        }
        
                        if ($isCompleted) {
                            echo "
                                <span class='bg-success text-center text-light' style='width:70px;height:70px;border-radius:50%;padding:10px;margin:7px;'>{$arr2['lesson_element']}</span>
                            ";
                        } else {
                            echo "
                                <span class='bg-red text-center text-light' style='width:70px;height:70px;border-radius:50%;padding:10px;margin:7px;'>{$arr2['lesson_element']}</span>
                            ";
                        }
                    }
                }
            }
        }
        echo "</div>";
    }
}
?>
</div>
</div>
<?php

include("footer.php");

?>