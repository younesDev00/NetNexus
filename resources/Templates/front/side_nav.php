<link href="css/styles.css" rel="stylesheet">

<div class="col-md-2">

    <h2 class="sidebarheading">Shop by:</h2>
    <h3>Category</h3>

    <form action="shop.php?" class="checkbox" method="get">
        <?php get_categories(); ?>
        <h3>Price</h3>
        <?php get_prices(); ?>
        <input type="submit" name="formSubmit" value="Submit" />
    </form>



</div>


