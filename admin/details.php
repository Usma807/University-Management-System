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
        <input type="text" id="searchInput1" class="form-control" onkeyup="search()" placeholder="Element bo'yicha qidiring..">
    </div>

    <div class="col-md-4 text-center form-group">
        <input type="text" id="searchInput2" class="form-control" onkeyup="search()" placeholder="Fayl bo'yicha qidiring..">
    </div>

    <div class="col-md-2 pl-4">
        
    </div>

    <div class="col-md-2 text-center">
        <a href="add-detail.php"><button class="btn btn-success">Yangi qo'shish</button></a>
    </div>
</div>

<div class="table-responsive p-2">

<?php

    $startTime = microtime(true);
    $data = $db->retrieve("details");
    $data = json_decode($data, 1);
    $endTime = microtime(true);
    $executionTime = $endTime - $startTime;
    $formattedTime = formatExecutionTime($executionTime);
    echo "<span class='bg-success text-light p-1 rounded'>Ma'lumotlar " . $formattedTime . "da qabul qilindi</span>" . PHP_EOL;

?>


<table class="table table-bordered text-center mt-2" id="myTable">

    <thead class="sticky">
        <th>#</th>
        <th>Element detali</th>
        <th>Fayl</th>
        <th>Matn</th>
        <th colspan="2">Boshqaruv</th>
    </thead>

    <tbody>

        <?php
            $counter = 1;

            if($data != null){
                foreach($data as $id => $arr){
                    $lesson_name = "";
                    $lesson_id = $arr['element_id'];
                    $data1 = $db->retrieve("elements/{$lesson_id}");
                    $data1 = json_decode($data1, 1);
                    if($data1!= null){
                        $lesson_name = $data1['lesson_element']." - ".$data1['lesson_topic'];
                    }
                    echo "
                    
                        <tr>
                            <td class='td'>{$counter}</td>
                            <td class='td'>{$lesson_name}</td>
                            <td class='td'>{$arr['filename']}</td>
                            <td class='td'>*****</td>
                            <td class='td'>
                                <a href='update-detail.php?id={$id}' class='btn btn-warning text-light'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                        <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                    </svg>
                                </a>
                            </td>
                            <td class='td'>
                                <a href='delete-detail.php?id={$id}&file={$arr['filename']}' class='btn btn-danger'>
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
        a = li[i].getElementsByTagName("td")[1];
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
        a = li[i].getElementsByTagName("td")[2];
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