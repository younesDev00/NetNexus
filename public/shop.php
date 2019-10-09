<?php
    require_once("../resources/config.php");
    include(TEMPLATE_FRONT . DS . "header.php")
?>


<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-sm-4 col-md-3 col-lg-2 p-3 my-2">
            <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
        </div>

            <div class="col-sm-8 col-md-9 col-lg-10 p-3 my-2">




                    <?php //include(TEMPLATE_FRONT . DS . "slider.php") ?>



                <div class="row">
                    <?php get_shop_products(); ?>
                </div><!-- ROw ends here-->

            </div>
        </div>
    </div>

    <!-- /.container -->
    <!--///.lk-->
    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
