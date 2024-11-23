<?php

include("header.php");
include("navbar.php");

$data = $db->retrieve("rating_system");
$data = json_decode($data, 1);

$got_id = "";
$gotON = "";
$gotMT = "";
$gotAI = "";
$gotYN = "";

foreach($data as $id => $arr){
    $got_id = $id;
    $gotON = $arr['on'];
    $gotMT = $arr['jmt'];
    $gotAI = $arr['jai'];
    $gotYN = $arr['yn'];
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

?>
<?php

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
<div class="container pl-3 pr-3">
    <form action="set-value-action.php" name="system_form" method="POST" class="shadow rounded m-2 p-4" style="margin-top:-95px;">
        <h4 class="text-center text-success">Baholash tizimi sozlamalari</h4>
        <input type="hidden" name="system_id" value="<?php echo $got_id; ?>">
        <div class="form-group">
            <h6>Oraliq nazorat</label>
            <input type="number" name="on" id="on" onchange="changingvalue()" class="form-control mb-2" placeholder="Oraliq nazorat" value="<?php echo $gotON; ?>" required>
        </div>
        <div class="form-group">
            <h6>Joriy nazorat</h6>
            <label>Mustaqil ta'lim</label>
            <input type="number" name="jmt" class="form-control mb-2" placeholder="Mustaqil ta'lim" required value="<?php echo $gotMT; ?>">
            <label>Amaliy ish</label>
            <input type="number" name="jai" class="form-control mb-2" placeholder="Amaliy ish" required  value="<?php echo $gotAI; ?>">
        </div>
        <div class="form-group">
            <h6>Yakuniy nazorat</h6>
            <input type="number" name="yn" class="form-control mb-2" placeholder="Yakuniy nazorat" required value="<?php echo $gotYN; ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Saqlash">
        </div>
    </form>
</div>


<script>
    function changingvalue(){
        if(document.system_form.on.value < 50){
            document.system_form.jmt.value = (50 - document.system_form.on.value)/2;
            document.system_form.jai.value = (50 - document.system_form.on.value)/2;
        }
    }
</script>

<?php

include("footer.php");

?>