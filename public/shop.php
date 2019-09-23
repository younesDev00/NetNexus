<?php require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");
?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>

        <div>
            <hr>
            <h2>Products</h2>

            <form class = "sort-products" action="/sort.php" method="GET">
                <select name="sort">
                    <option value="all">All Products</option>
                    <option value="lowHigh">By price: Low to High</option>
                    <option value="highLow">By price: High to Low</option>
                </select>
                <button type="submit" >Sort</button>
                <input type="reset">
            </form>
            <hr>

        </div>


        <div class="row">
            <?php get_shop_products(); ?>
        </div>

    </div>

</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>


