<?php

include("header.php");
include("navbar.php");

$data = $db->retrieve("elements");
$data = json_decode($data, 1);

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

<form action="add-detail-action.php" method="post" autocomplete="false" enctype="multipart/form-data" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Detal qo'shish</h4>
    <strong>Element detali</strong>
    <select name="element_id" id="element_id" class="form-control mb-2">
        <?php
        
            if($data != null){
                foreach($data as $id => $arr){
                    echo "<option value='{$id}'>{$arr['lesson_element']} - {$arr['lesson_topic']}</option>";
                }
            }

        ?>
    </select>
    <strong>Fayl</strong>
    <input class="form-control mb-2" type="file" name="file" placeholder="Dars fayli.." required>
    <strong>Matn</strong>
    <textarea name="lesson_text" id="lesson_text" class="form-control mb-2"></textarea>
    <input class="btn btn-success mt-2" type="submit" name="add-detail" value="Qo'shish">
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
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
    });
</script>
<?php

include("footer.php");

?>