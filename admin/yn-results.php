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

<div class="row p-2">

    <div class="col-md-4 text-center form-group">
        <input type="text" id="searchInput1" class="form-control" onkeyup="search()" placeholder="F.I.SH bo'yicha qidiring..">
    </div>

    <div class="col-md-4 text-center form-group">

    </div>

    <div class="col-md-2 pl-4">
        
    </div>

    <div class="col-md-2 text-center">

</div>
</div>

<div class="table-responsive p-2">

<?php

    $startTime = microtime(true);
    $data = $db->retrieve("yn_results");
    $data = json_decode($data, 1);
    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    $formattedTime = formatExecutionTime($executionTime);
    echo "<span class='bg-success text-light p-1 rounded'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;

?>

<table class="table table-bordered text-center mt-2" id="myTable">

    <thead class="sticky">
        <th>#</th>
        <th>F.I.SH</th>
        <th>Natija</th>
    </thead>

    <tbody>

        <?php
            $counter = 1;

            if($data != null){
                foreach($data as $id => $arr){
                    $data1 = $db->retrieve("users/{$arr['user_id']}");
                    $data1 = json_decode($data1, 1);
                    $full_name = $data1['name']." ".$data1['surname'];
                    echo "
                        <tr>
                            <td class='td'>{$counter}</td>
                            <td class='td'>{$full_name}</td>
                            <td class='td'>{$arr['score']}</td>
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
        a = li[i].getElementsByTagName("td")[1];
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