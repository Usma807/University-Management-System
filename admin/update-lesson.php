<?php

include("header.php");
include("navbar.php");

$got_lesson_id = $_GET['id'];

if($user_id != ""){
    $data = $db->retrieve("lessons/{$got_lesson_id}");
    $data = json_decode($data, 1);
    
    if($data != null){
        $name = $data['name'];
        $topic = $data['topic'];     
        $status = $data['status'];      
    }
}

?>

<form action="update-lesson-action.php" method="post" autocomplete="false" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Foydalanuvchi qo'shish</h4>
    <input type="hidden" name="lesson_id" value="<?php echo $got_lesson_id; ?>">
    <strong>Dars nomi</strong>
    <input class="form-control mb-2" type="text" name="name" value="<?php echo $name; ?>" placeholder="Dars nomi.." required>
    <strong>Dars mavzusi</strong>
    <input class="form-control mb-2" type="text" name="topic" value="<?php echo $topic; ?>" placeholder="Dars mavzusi.." required>
    <strong>Status</strong>
    <select name="status" class="form-control mb-2" value="<?php echo $status; ?>">
        <option value="draft">draft</option>
        <option value="published">published</option>
    </select>
    <input class="btn btn-success" type="submit" name="update" value="Saqlash">
</form>

<?php

include("footer.php");

?>