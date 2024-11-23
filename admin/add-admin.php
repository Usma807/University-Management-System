<?php

include("header.php");
include("navbar.php");

?>

<form action="add-admin-action.php" method="post" autocomplete="false" class="container shadow form-group p-3" style="width:80%;margin:0 auto;margin-top:0px;">
    <h4 class="text-center" style="color:#eb8153;">Admin qo'shish</h4>
    <strong>Ism</strong>
    <input class="form-control mb-2" type="text" name="name" placeholder="John" required>
    <strong>Familiya</strong>
    <input class="form-control mb-2" type="text" name="surname" placeholder="Doe" required>
    <strong>Email</strong>
    <input class="form-control mb-2" type="text" name="email" placeholder="info@example.com" required>
    <strong>Parol</strong>
    <input class="form-control mb-2" type="password" name="password" placeholder="john1234" required>
    <input class="btn btn-success" type="submit" name="add-admin" value="Qo'shish">
    <input class="btn btn-success" type="submit" name="add-admin-continue" value="Qo'shish va Davom etish">
</form>

<?php

include("footer.php");

?>