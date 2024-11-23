<?php

include("header.php");
include("navbar.php");

?>

<form action="profile-action.php" method="POST" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center text-success">Profil sozlamalari</h4>
    <strong>Ism</strong>
    <input class="form-control mb-2" type="text" name="name" value="<?php echo $name; ?>" placeholder="Ism" required>
    <strong>Familiya</strong>
    <input class="form-control mb-2" type="text" name="surname" value="<?php echo $surname; ?>" placeholder="Familiya" required>
    <strong>Email</strong>
    <input class="form-control mb-2" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
    <strong>Parol</strong>
    <input class="form-control mb-2" type="text" name="password" value="<?php echo $password; ?>" placeholder="Parol" required>
    <input class="btn btn-success" type="submit" name="update" value="Saqlash">
    <input class="btn btn-danger" type="submit" name="exit" value="Chiqish">
</form>

<?php

include("footer.php");

?>