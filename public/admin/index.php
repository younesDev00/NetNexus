<?php

    include("../../resources/configback.php");
    require_once(TEMPLATE_BACK . "/header.php");

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
                    echo $_SERVER['REQUEST_URI'];
                        if(($_SERVER['REQUEST_URI'] == "/shoppingWebsite/public/admin/index.php") ||
                           ($_SERVER['REQUEST_URI'] == "/shoppingWebsite/public/admin/") ||
                           ($_SERVER['REQUEST_URI'] == "/SHOPPINGWEBSITE/public/admin/index.php") ||
                           ($_SERVER['REQUEST_URI'] == "/SHOPPINGWEBSITE/public/admin/"))
                            {
                                require_once(TEMPLATE_BACK . "/admin_content.php");
                            }
                ?>
             </div>
        </div>
        <!-- /#page-wrapper -->

<?php
    require_once(TEMPLATE_BACK . "/footer.php");
?>
