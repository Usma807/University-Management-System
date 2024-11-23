<?php

include("header.php");
include("navbar.php");

include("time-floor.php");

?>

<style>

    th{
        background-color:#eb8153;
        color:#fff;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#ex2").hide();
        $("#ex3").hide();
        $("#h1").click(function(){
            $("#ex3").hide();
            $("#ex2").hide();
            $("#ex1").show(700);
        })
        $("#h2").click(function(){
            $("#ex1").hide();
            $("#ex3").hide();
            $("#ex2").show(700);
        })
        $("#h3").click(function(){
            $("#ex1").hide();
            $("#ex2").hide();
            $("#ex3").show(700);
        })
    })
</script>
<div class="row pl-5 text-center" style="width:80%;margin:0 auto;margin-bottom:15px;">
    <div class="col-md-3 bg-success text-light rounded m-1" id="h1">
        <h5 class="text-center text-light p-1">Bo'laklarni birlashtirish</h5>
    </div>
    <div class="col-md-3 bg-success text-light rounded m-1" id="h2">
        <h5 class="text-center text-light pt-3 pl-1 pr-1 pb-1">Bo'sh joyni to'ldirish</h5>
    </div>
    <div class="col-md-3 bg-success text-light rounded m-1" id="h3">
        <h5 class="text-center text-light pt-3 pl-1 pr-1 pb-1">Test</h5>
    </div>
    <div class="col-md-2 bg-success text-light rounded m-1 pt-3 pl-1 pr-1 pb-1">
        <a href="add-exercise.php" class="text-light" style="font-weight:bold;">Yangi qo'shish</a>
    </div>
</div>

<div class="table-responsive p-2" id="ex1">

    <?php

        $startTime = microtime(true);
        $data = $db->retrieve("exercises");
        $data = json_decode($data, 1);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $formattedTime = formatExecutionTime($executionTime);
        echo "<span class='bg-success text-light p-1 rounded'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;

    ?>


    <table class="table table-bordered text-center mt-2" id="myTable">

        <thead class="sticky">
            <th>#</th>
            <th>Element</th>
            <th>S1</th>
            <th>J1</th>
            <th>S2</th>
            <th>J2</th>
            <th>S3</th>
            <th>J3</th>
            <th>S4</th>
            <th>J4</th>
            <th>Boshqaruv</th>
        </thead>

        <tbody>

            <?php
                $counter = 1;

                if($data != null){
                    foreach($data as $id => $arr){
                        if($arr['status'] == "ex0"){
                            $el_name = "";
                        $el_id = $arr['element_id'];
                        $data1 = $db->retrieve("elements/{$el_id}");
                        $data1 = json_decode($data1, 1);
                        $el_name = $data1['lesson_element']." ".$data1['lesson_topic'];
                        echo "
                        
                            <tr>
                                <td class='td'>{$counter}</td>
                                <td class='td'>{$el_name}</td>
                                <td class='td'>{$arr['q1']}</td>
                                <td class='td'>{$arr['a1']}</td>
                                <td class='td'>{$arr['q2']}</td>
                                <td class='td'>{$arr['a2']}</td>
                                <td class='td'>{$arr['q3']}</td>
                                <td class='td'>{$arr['a3']}</td>
                                <td class='td'>{$arr['q4']}</td>
                                <td class='td'>{$arr['a4']}</td>
                                <td class='td'>
                                    <a href='delete-exercise.php?id={$id}' class='btn btn-danger'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
        
                        ";
        
                        $counter++;
                        }
        
                    }
                }

            ?>

        </tbody>

    </table>

</div>
<div class="table-responsive p-2" id="ex2">

    <?php

        $startTime = microtime(true);
        $data = $db->retrieve("exercises");
        $data = json_decode($data, 1);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $formattedTime = formatExecutionTime($executionTime);
        echo "<span class='bg-success text-light p-1 rounded'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;

    ?>


    <table class="table table-bordered text-center mt-2" id="myTable">

        <thead class="sticky">
            <th>#</th>
            <th>Element</th>
            <th>Savol</th>
            <th>Javob</th>
            <th>Boshqaruv</th>
        </thead>

        <tbody>

            <?php
                $counter = 1;

                if($data != null){
                    foreach($data as $id => $arr){
                        if($arr['status'] == "ex1"){
                            $el_name = "";
                        $el_id = $arr['element_id'];
                        $data1 = $db->retrieve("elements/{$el_id}");
                        $data1 = json_decode($data1, 1);
                        $el_name = $data1['lesson_element']." ".$data1['lesson_topic'];
                        echo "
                        
                            <tr>
                                <td class='td'>{$counter}</td>
                                <td class='td'>{$el_name}</td>
                                <td class='td'>{$arr['question']}</td>
                                <td class='td'>{$arr['answer']}</td>
                                <td class='td'>
                                    <a href='delete-exercise.php?id={$id}' class='btn btn-danger'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
        
                        ";
        
                        $counter++;
                        }
        
                    }
                }

            ?>

        </tbody>

    </table>

</div>

<div class="table-responsive p-2" id="ex3">

    <?php

        $startTime = microtime(true);
        $data = $db->retrieve("exercises");
        $data = json_decode($data, 1);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $formattedTime = formatExecutionTime($executionTime);
        echo "<span class='bg-success text-light p-1 rounded'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;

    ?>


    <table class="table table-bordered text-center mt-2" id="myTable">

        <thead class="sticky">
            <th>#</th>
            <th>Element</th>
            <th>Savollar</th>
            <th>Javoblar</th>
            <th>Boshqaruv</th>
        </thead>

        <tbody>

            <?php
                $counter = 1;

                if($data != null){
                    foreach($data as $id => $arr){
                        if($arr['status'] == "ex2"){
                            $el_name = "";
                        $el_id = $arr['element_id'];
                        $data1 = $db->retrieve("elements/{$el_id}");
                        $data1 = json_decode($data1, 1);
                        $el_name = $data1['lesson_element']." ".$data1['lesson_topic'];
                        echo "
                        
                            <tr>
                                <td class='td'>{$counter}</td>
                                <td class='td'>{$el_name}</td>
                                <td class='td'>*****</td>
                                <td class='td'>{$arr['answer']}</td>
                                <td class='td'>
                                    <a href='delete-exercise.php?id={$id}' class='btn btn-danger'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
        
                        ";
        
                        $counter++;
                        }
        
                    }
                }

            ?>

        </tbody>

    </table>

</div>
<?php

include("footer.php");

?>