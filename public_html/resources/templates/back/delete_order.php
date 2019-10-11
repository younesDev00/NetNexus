<?php
    require_once("../../../../resources/configback.php");

if(isset($_GET['id']) && $_GET['pr_id'])
{
    $query = query("DELETE FROM reports WHERE order_id = " .escape_string($_GET['id']) . " &&  product_id= " .escape_string($_GET['pr_id']) . " ");
    confirm($query);
    set_message("Order Deleted");
    redirect("/admin/index.php?orders");
}else
{
    redirect("/admin/index.php?orders");
}

?>
