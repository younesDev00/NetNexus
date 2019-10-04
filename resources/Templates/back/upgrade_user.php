<?php require_once("../../configback.php");


if(isset($_GET['id'])) {


$query = query(" UPDATE `users` SET `accounttype`= 'seller' WHERE `user_id`= " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("User Updated");
redirect("../../../public/admin/index.php?users");


} else {

redirect("../../../public/admin/index.php?users");


}






 ?>




