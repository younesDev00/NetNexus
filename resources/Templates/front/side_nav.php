<link href="css/styles.css" rel="stylesheet">

<div class="col-md-2">

    <h2 class="sidebarheading">Filter by:</h2>
    <h3>Category</h3>

    <form action="category.php?" method="get">
        <?php get_categories(); ?>
        <input type="submit" name="catSubmit" value="Submit" />
    </form>
    <h3>Price</h3>

    <form action="shop.php?" method="get">
        <input type="checkbox" name="priceRange[]" value="1"/>Less than $500<br />
        <input type="checkbox" name="priceRange[]" value="2"/>$500-$1000<br />
        <input type="checkbox" name="priceRange[]" value="3"/>$1000-$2000<br />
        <input type="checkbox" name="priceRange[]" value="4"/>$2000-$3000<br />
        <input type="checkbox" name="priceRange[]" value="5"/>$3000-$4000<br />
        <input type="checkbox" name="priceRange[]" value="6"/>$4000-$5000<br />
        <input type="checkbox" name="priceRange[]" value="7"/>$5000+<br />

        <input type="submit" name="formSubmit" value="Submit" />
    </form>



</div>


