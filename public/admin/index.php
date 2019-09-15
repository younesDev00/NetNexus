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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard <small>Statistics Overview</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
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

        if(isset($_GET['main']))
        {
            include(TEMPLATE_BACK . "/admin_content.php");

        }

        if(isset($_GET['orders']))
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


        if(isset($_GET['edit_products']))
        {
            include(TEMPLATE_BACK . "/edit_products.php");
        }


        if(isset($_GET['products']))
        {
            include(TEMPLATE_BACK . "/products.php");
        }

//        if(isset($_GET['users']))
//        {
//            include("/users.php");
//        }


?>
    </div>
</div>
<!-- /#page-wrapper -->

<?php
    require_once(TEMPLATE_BACK . "/footer.php");
?>
