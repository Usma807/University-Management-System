<?php

include("header.php");
include("navbar.php");

$got_user_id = $_GET['id'];

if($user_id != ""){
    $data = $db->retrieve("users/{$got_user_id}");
    $data = json_decode($data, 1);
    
    if($data != null){
        $name = $data['name'];
        $surname = $data['surname'];
        $email = $data['email'];
        $password = $data['password'];   
    }
}

?>

<form action="update-user-action.php" method="post" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Foydalanuvchini tahrirlash</h4>
    <input type="hidden" name="user_id" value="<?php echo $got_user_id; ?>">
    <strong>Ism</strong>
    <input class="form-control mb-2" type="text" name="name" value="<?php echo $name; ?>" placeholder="Ism" required>
    <strong>Familiya</strong>
    <input class="form-control mb-2" type="text" name="surname" value="<?php echo $surname; ?>" placeholder="Familiya" required>
    <strong>Email</strong>
    <input class="form-control mb-2" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
    <strong>Parol</strong>
    <input class="form-control mb-2" type="text" name="password" value="<?php echo $password; ?>" placeholder="Parol" required>
    <input class="btn btn-success" type="submit" name="update" value="Saqlash">
</form>

<?php

include("footer.php");

?>