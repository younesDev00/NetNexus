<?php require_once("../../../../resources/configback.php");


if(isset($_GET['id'])) {


$query = query("DELETE FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("Sser Deleted");
redirect("/admin/index.php?users");


} else {

redirect("/admin/index.php?users");


}






 ?>
