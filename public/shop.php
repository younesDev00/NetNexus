<?php require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");
include(TEMPLATE_FRONT . DS . "side_nav.php");
?>






<div class="container">


    <hr>

    <!-- Title -->

    <h1>Products</h1>
    <hr>

    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">


        <?php get_shop_products(); ?>

    </div>
    <!-- /.row -->



</div>


<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

