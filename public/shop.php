<?php require_once("../resources/config.php");
      include(TEMPLATE_FRONT . DS . "header.php");
?>


    <header>
        <h1>Shop</h1>
    </header>

    <hr>

<div class="col-md-2">
    <div class="list-group">

    	<?php

    		get_categories();
    	 ?>
    </div>
</div>


<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->

    <!-- Page Features -->
    <div class="row text-center">


        <?php get_shop_products(); ?>

    </div>
    <!-- /.row -->



</div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

