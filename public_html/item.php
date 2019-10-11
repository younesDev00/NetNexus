<?php require_once("../resources/config.php");
  include(TEMPLATE_FRONT . DS . "header.php");
?>

<!-- Page Content -->
<div class="container">

    <!-- Side Navigation -->
    <?php
$query = query(" SELECT * FROM products WHERE product_id =" . escape_string($_GET['id']) ."");
confirm($query);

while($row = fetch_array($query)):
$id = escape_string($_GET['id']);
?>
    <div class="container">




        <div class="card mt-4 p-5">
            <img class="card-img-top img-fluid" src="<?php echo "../resources/uploads/" . $row['product_image']?>" alt="">
            <div class="card-body">
                <h3 class="card-title"><?php echo $row['product_title']?></h3>
                <h4>$<?php echo $row['product_price']?></h4>
                <p class="card-text"><?php echo $row['product_short_description']?></p>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                    <a class="btn btn-primary pull-left" href="../resources/cart.php?add=<?php echo $row['product_id']; ?>">Add To Cart</a>
                </small>
            </div>
        </div>

        <!--Row For Image and Short Description-->

        <hr>
        <!--Row for Tab Panel-->

        <div class="row">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <br>
                        <p><?php echo $row['product_description']?></p>
                    </div>
                </div>
            </div>


        </div>
        <!--Row for Tab Panel-->

    </div><!-- col-md9 ends here -->

    <?php endwhile; ?>

</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
