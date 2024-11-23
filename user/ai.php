<?php 

include("header.php");
include("navbar.php");


?>
<style>
    th,td{
        border:1px solid black;
        border-collapse:collapse;
    }
</style>

<div class="container mt-3 p-3">
    <div class="open-close-lessons mb-3">
                <?php 
                    $data_arr = $db->retrieve("ai_files");
                    $data_arr = json_decode($data_arr, 1);
                    $counter = 1;
                    if($data_arr != null){
                        foreach($data_arr as $id => $arr){
                            echo "
                                <div class='bg-primary text-light mb-2 mt-2 p-3 rounded' style='display:grid;grid-template-columns: 15% 83%'>
                                    <span class='bg-light text-center text-success p-2 rounded' style='font-weight:bold;'><a href='open-ai.php?id={$id}' class='text-success' style='text-decoration:none;'>Kirish</a></span>
                                    <span class='fw-bold text-center shadow bg-light text-success rounded p-1' style='margin-left:2%;font-weight:bold;'>{$arr['ai_name']}</span>
                                </div>
                            ";
                            $counter ++;
                        }
                    }
                ?>
    </div>

    </div>



    <?php
    include("footer.php");
    
    
    ?>