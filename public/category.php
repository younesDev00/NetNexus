<?php require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");
?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>

        <hr>
        <h2>Products</h2>
        <hr>

        <div class="row">
            <?php get_categories_products(); ?>
        </div>

    </div>

</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

