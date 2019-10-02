
<!--<div class="col-sm-4 col-md-6 col-lg-2" style="width:200px;overflow: hidden;">-->
    <h4 class="sidebarheading">Shop by:</h4>
    <form action="shop.php?" class="filter" method="get">
        <input type="text" placeholder="Search Products" name="search" >
        <h4>Category</h4>
        <?php get_categories(); ?>

        <h4>Price</h4>
        <?php get_prices(); ?>

        <h4>Brand</h4>
        <?php get_brands(); ?>

        <input type="submit" name="formSubmit" value="Submit" />
    </form>

<!--</div>-->

