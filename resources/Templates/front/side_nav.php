
<!--<div class="col-sm-4 col-md-6 col-lg-2" style="width:200px;overflow: hidden;">-->
    <h2 class="sidebarheading">Shop by:</h2>
    <form action="shop.php?" class="filter" method="get">
        <input type="text" placeholder="Search Products" name="search" >
        <h3>Category</h3>
        <?php get_categories(); ?>

        <h3>Price</h3>
        <?php get_prices(); ?>

        <h3>Brand</h3>
        <?php get_brands(); ?>

        <input type="submit" name="formSubmit" value="Submit" />
    </form>

<!--</div>-->

