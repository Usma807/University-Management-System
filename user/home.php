<?php

include("header.php");
include("navbar.php");

?>

<div class="container p-3">
    <span class="shadow bg-primary text-light p-2 rounded" style="font-weight:bold;font-size:16px;">E-Pedagog o'qitish tizimi darslari</span>
    <div class="row mt-2">
    <?php
    
    $lesson_name = "";
    $data = $db->retrieve("lessons");
    $data = json_decode($data, 1);
    $data1 = $db->retrieve("plans");
    $data1 = json_decode($data1, 1);
    $data2 = $db->retrieve("elements");
    $data2 = json_decode($data2, 1);
    foreach ($data as $id => $arr){
        if($arr['status'] == "published"){
        $lesson_name = $arr['name'] ." ". $arr['topic'];
        echo "
                <div class='card m-2'>
                    <h5 class='card-header'>{$lesson_name}</h5>
                    <div class='card-body'>
                        
        ";
        foreach($data1 as $id1 => $arr1){
            if($arr1['lesson_id'] == $id){
                echo "
                        <h5 class='card-title'>{$arr1['plan_name']} - {$arr1['plan_topic']}</h5>
                ";
                foreach($data2 as $id2 => $arr2){
                            if($arr2['lesson_plan'] == $id1){
                                echo "
                                        <a href='open-element.php?id={$id2}' class='btn btn-primary'>{$arr2['lesson_element']}</a>
                                    ";
                        }
                    }
                }
        }
        echo "</div></div>";
    }
    }
                                                
    ?>
    </div>
</div>
<?php

include("footer.php");

?>