<?php
    require_once("../../resources/configback.php");
    include(TEMPLATE_BACK . "/header.php");


    if(!isset($_SESSION['useraccount']) || $_SESSION['useraccount'][1] == 'buyer' )
    {
        redirect("../../public");
    }else if(isset($_SESSION['useraccount']))
    {
        $arr = $_SESSION["useraccount"];
        //$_SESSION["username"][0]; username
        //echo $arr[0]; Username
//       echo $arr[1]; //account type
    }
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->

        <?php

//        old implementation uses ?
//        echo $_SERVER['REQUEST_URI'];
//        if(isset($_GET['user_id']))
//        {
//            $id = $_GET['user_id'];
//            $accounttype = $_GET['accounttype'];
//        }

//        if($arr[1] == 'admin')
//        {
//            include(TEMPLATE_BACK . "/admin_content.php");
//        }

//        if(isset($_GET['main']))
//        {
//            include(TEMPLATE_BACK . "/admin_content.php");
//
//        } //yeah nah maybe later

        if(isset($_GET['orders']) || isset($_GET['main']))
        {
            include(TEMPLATE_BACK . "/orders.php");
        }


        if(isset($_GET['add_product']))
        {
            include(TEMPLATE_BACK . "/add_product.php");
        }


        if(isset($_GET['categories']))
        {
            include(TEMPLATE_BACK . "/categories.php");
        }


        if(isset($_GET['products']))
        {
            include(TEMPLATE_BACK . "/products.php");
        }


        if(isset($_GET['edit_product']) && $_SESSION['useraccount'][1] ==  'seller')
        {
            include(TEMPLATE_BACK . "/edit_product.php");
        }else if(isset($_GET['edit_product']) && $_SESSION['useraccount'][1] !=  'seller')
        {
            redirect("../item.php?id={$_GET['id']}");
        }

        if(isset($_GET['users']))
        {
            include(TEMPLATE_BACK . "/users.php");
        }


        if(isset($_GET['add_user']))
        {
            include(TEMPLATE_BACK . "/add_user.php");
        }


         if(isset($_GET['edit_user']))
         {
            include(TEMPLATE_BACK . "/edit_user.php");
         }


?>
    </div>
</div>
<!-- /#page-wrapper -->

<?php
    require_once(TEMPLATE_BACK . "/footer.php");
?>
