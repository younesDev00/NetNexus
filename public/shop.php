<?php require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");
include(TEMPLATE_FRONT . DS . "side_nav.php");
?>




<!-- Page Content -->
<div class="container">
 <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1">Filter by Price</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <ul class="list-group">
        <a href="price.php?price=500" class="list-group-item">Less than $500</a>
                    <a href="price.php?price=1000" class="list-group-item">$500-$1000</a>
                    <a href="price.php?price=2000" class="list-group-item">$1000-$2000</a>
                    <a href="price.php?price=3000" class="list-group-item">$2000-$3000</a>
                    <a href="price.php?price=4000" class="list-group-item">$3000-$4000</a>
      </ul>
    </div>
  </div>
</div>
    <!-- Jumbotron Header -->




    <!-- Page Features -->
    <div class="row text-center">


        <?php get_shop_products(); ?>

    </div>
    <!-- /.row -->



</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

