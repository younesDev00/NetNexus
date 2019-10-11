<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<!-- Page Content -->
<div class="container">

    <div class="row">


            <div class="col-md-10">

                <div class="row carousel-holder">

                    <div class="col-md-12">

                      <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>

                    </div>

                </div>





                <div class="row">
                    <?php get_products(); ?>
                </div><!-- ROw ends here-->

            </div>
        </div>
    </div>

    <!-- /.container -->
    <!--///.lk-->
    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
