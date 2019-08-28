<?php require_once("../resources/config.php");
      include(TEMPLATE_FRONT . DS . "header.php");
?>

<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header>
        <h1>Shopp</h1>
    </header>

    <hr>
    <!-- Page Features -->
    <div class="row text-center">


        <?php get_shop_products(); ?>

    </div>
    <!-- /.row -->



</div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

