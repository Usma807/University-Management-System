
<?php

include("header.php");
include("navbar.php");

$data4 = $db->retrieve("users");
$data4 = json_decode($data4, 1);

?>
<div class="container pl-4 pr-4">
    <form action="results.php" method="POST" class="container ml-2 mr-2 p-3 form-group shadow rounded">
    <h4 class="text-center">Foydalanuvchi o'zlashtirishi</h4>

<select name="user_id" id="user_id" class="form-control mb-2">
    <?php
    
        

        foreach($data4 as $id4 => $arr4){
            echo "
                <option value='{$id4}'>{$arr4['name']} {$arr4['surname']}</option>
            ";
        }
    
    ?>
</select>
<input type="submit" name="get_user_results" value="Chiqarish" class="btn btn-success">

</form>

</div>



<?php 

if(isset($_POST['get_user_results'])){
    
$got_id = $_POST['user_id'];

$data = $db->retrieve("lessons");
$data = json_decode($data, 1);
$data1 = $db->retrieve("plans");
$data1 = json_decode($data1, 1);
$data2 = $db->retrieve("elements");
$data2 = json_decode($data2, 1);

$data3 = $db->retrieve("results");
$data3 = json_decode($data3, 1);

$data4 = $db->retrieve("users/{$got_id}");
$data4 = json_decode($data4, 1);


$completed_elements = 0;
if($data3 != null){
    foreach($data3 as $id3 => $arr3){

        if($arr3['user_id'] == $got_id){
    
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

<div class="container pl-5 pr-5">
    <span class="bg-primary text-light rounded p-2 mb-2"><?php echo $data4['name']." ".$data4['surname']; ?></span>
    <div class="row mt-2">
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
                                if ($arr3['user_id'] == $got_id && $arr3['element_id'] == $id2) {
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
}

?>
</div>
</div>
<?php

include("footer.php");

?>