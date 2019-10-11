<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php")
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <?php    include(TEMPLATE_FRONT . DS . "side_nav.php")?>


        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <div class="row">
                <h1>Shop Featured Products</h1>
            </div>
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img style="display: block; margin-left: auto; margin-right: auto; width: 30%;" class="d-block img-fluid" src="resources/uploads/dell2.png" alt="First slide">
                            <h3>Dell Inspiron 3000</h3>
                        </div>
                        <div class="carousel-item">
                            <img style="display: block; margin-left: auto; margin-right: auto; width: 30%;" class="d-block img-fluid" src="resources/uploads/mac2.png" alt="Second slide">
                            <h3>Apple Macbook Air</h3>
                        </div>
                        <div class="carousel-item">
                            <img style="display: block; margin-left: auto; margin-right: auto; width: 30%;" class="d-block img-fluid" src="resources/uploads/surface.png" alt="Third slide">
                            <h3>Surface Pro</h3>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


                <div class="row">
                    <?php
    if(isset($_SESSION['useraccount']) && $_SESSION['useraccount'][1] == 'buyer'){
        include(TEMPLATE_BACK . "/recommended.php");
    }else
    {?>
                    <div class="row">
                        <h1>Shop Our Products</h1>
                        <div class="row">
                            <?php get_products();?>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php    include(TEMPLATE_FRONT . DS . "footer.php")?>
