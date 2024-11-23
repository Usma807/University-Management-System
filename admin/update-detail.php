<?php

include("header.php");
include("navbar.php");

$got_detail_id = $_GET['id'];

if($user_id != ""){
    $data = $db->retrieve("details/{$got_detail_id}");
    $data = json_decode($data, 1);
    
    if($data != null){
        $element_id = $data['element_id'];
        $filename = $data['filename'];
        $lesson_text = $data['lesson_text'];
    }
}

?>


<?php

$data = $db->retrieve("elements/{$element_id}");
$data = json_decode($data, 1);

$lesson_name = $data['lesson_element']." ".$data['lesson_topic'];

?>
<style>
    table.mceLayout, textarea.tinyMCE {
    width: 100% !important;
    }

    @media only screen and (min-width: 600px) {
        table.mceLayout, textarea.richEditor {
        width: 600px !important;
        }
    }
</style>


<form action="update-detail-action.php" method="post" autocomplete="false" enctype="multipart/form-data" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Detalni tahrirlash</h4>
    <input type="hidden" name="detail_id" value="<?php echo $got_detail_id; ?>">
    <strong>Dars detali</strong>
    <select name="element_id" id="element_id" class="form-control mb-2">
        <option value="<?php echo $element_id; ?>"><?php echo $lesson_name ?></option>
    </select>
    <input class="form-control mb-2" type="hidden" name="filename" value="<?php echo $filename; ?>" required>
    <strong>Matn</strong>
    <textarea name="lesson_text" id="lesson_text" class="form-control mb-2"></textarea>
    <input class="btn btn-success mt-2" type="submit" name="update" value="Saqlash">
</form>
<script src="../tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#lesson_text',
        height: 300,
        plugins:[
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
        'forecolor backcolor emoticons',
        menu: {
            favs: {title: 'menu', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}',
    });
</script>
<?php

include("footer.php");

?>