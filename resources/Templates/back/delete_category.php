<?php require_once("../../configback.php");


if(isset($_GET['id'])) {


$query = query("DELETE FROM categories WHERE cat_id = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("Category Deleted");
redirect("/admin/index.php?categories");


} else {

redirect("/public/admin/index.php?categories");


}






 ?>
