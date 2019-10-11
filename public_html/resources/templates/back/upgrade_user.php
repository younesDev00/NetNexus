<?php require_once("../../../../resources/configback.php");


if(isset($_GET['id'])) {


$query = query(" UPDATE `users` SET `accounttype`= 'seller' WHERE `user_id`= " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("User Updated");
redirect("/admin/index.php?users");


} else {

redirect("/admin/index.php?users");


}






 ?>




