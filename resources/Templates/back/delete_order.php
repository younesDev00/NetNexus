<?php
    require_once("../../configback.php");

if(isset($_GET['id']) && $_GET['pr_id'])
{
    $query = query("DELETE FROM reports WHERE order_id = " .escape_string($_GET['id']) . " &&  product_id= " .escape_string($_GET['pr_id']) . " ");
    confirm($query);
    set_message("Order Deleted");
    redirect("../../../public/admin/index.php?orders");
}else
{
    redirect("../../../public/admin/index.php?orders");
}

?>
