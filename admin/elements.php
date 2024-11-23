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
<?php

if(isset($_SESSION['error_delete'])){
    echo "
        <div style='width:40%;margin-left:60%;margin-top:-35px;margin-bottom:45px;padding-right:20px;'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='background-color:red;color:#fff;'>
                <span class='text-light text-center'>{$_SESSION['error_delete']}</span>
                <button type='button' class='close' onclick='unset()' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>
    ";
    unset($_SESSION['error_delete']);
}

?>
<div class="row p-2">

    <div class="col-md-4 text-center form-group">
        <input type="text" id="searchInput1" class="form-control" placeholder="Element bo'yicha qidiring..">
    </div>

    <div class="col-md-4 text-center form-group">
        <input type="text" id="searchInput2" class="form-control" placeholder="Mavzu bo'yicha qidiring..">
    </div>

    <div class="col-md-2 pl-4">
        
    </div>

    <div class="col-md-2 text-center">
        <a href="add-element.php"><button class="btn btn-success">Yangi qo'shish</button></a>
    </div>
</div>

<div class="table-responsive p-2">

<?php

    $startTime = microtime(true);
    $data = $db->retrieve("elements");
    $data = json_decode($data, 1);
    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    $formattedTime = formatExecutionTime($executionTime);
    echo "<span class='bg-success text-light p-1 rounded'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;

?>


<table class="table table-bordered text-center mt-2" id="myTable">

    <thead class="sticky">
        <th>#</th>
        <th>Reja</th>
        <th>Element</th>
        <th>Mavzu</th>
        <th>Boshqaruv</th>
    </thead>

    <tbody>

        <?php
            $counter = 1;

            if($data != null){
                foreach($data as $id => $arr){
                    $plan_name = "";
                    $plan_id = $arr['lesson_plan'];

                    $data2 = $db->retrieve("plans/{$plan_id}");
                    $data2 = json_decode($data2, 1);

                    if($data2!= null){
                        $plan_name = $data2['plan_name']." ".$data2['plan_topic'];
                    }

                    echo "
                    
                        <tr>
                            <td class='td'>{$counter}</td>
                            <td class='td'>{$plan_name}</td>
                            <td class='td'>{$arr['lesson_element']}</td>
                            <td class='td'>{$arr['lesson_topic']}</td>
                            <td class='td'>
                                <a href='delete-element.php?id={$id}' class='btn btn-danger'>
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

        ?>

    </tbody>

</table>

<script>

document.getElementById('searchInput1').addEventListener('keyup', () => {
    var input, filter, tbody, li, a, i, txtValue;
    input = document.getElementById('searchInput1');
    filter = input.value.toLowerCase();
    tbody = document.querySelector("table tbody");
    li = tbody.getElementsByTagName('tr');
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("td")[2];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
});

document.getElementById('searchInput2').addEventListener('keyup', () => {
    var input, filter, tbody, li, a, i, txtValue;
    input = document.getElementById('searchInput2');
    filter = input.value.toLowerCase();
    tbody = document.querySelector("table tbody");
    li = tbody.getElementsByTagName('tr');
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("td")[3];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
});
</script>


</div>

<?php

include("footer.php");

?>