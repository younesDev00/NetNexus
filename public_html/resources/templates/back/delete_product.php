<?php
    require_once("../../../../resources/configback.php");

if(isset($_GET['id']))
{
    $query = query("DELETE FROM products WHERE product_id = " .escape_string($_GET['id']) . " ");
    confirm($query);
    set_message("Product Deleted");
    redirect("/admin/index.php?products");
}else
{
    redirect("/admin/index.php?products");
}

?>
