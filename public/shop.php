<?php require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");
?>

<div class="container">

    <div class="row">

        <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>


        <div class="col-md-10">


            <div class="col-md-12">
                <hr>

                <h1>Products</h1>
                <hr>
            </div>

            <div class="row">
                <?php get_shop_products(); ?>
            </div><!-- ROw ends here-->

        </div>
    </div>
</div>


<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
