<link href="css/styles.css" rel="stylesheet">

<div class="col-md-2">
    <h2 class="sidebarheading">Shop</h2>
    <div class="list-group">

        <?php get_categories(); ?>
    </div>


    <div class="list-group"  >
        <h3 >Shop by Price</h3>
        <div   >
                <a href="shop.php?lowPrice=0&highPrice=500&search=" class="list-group-item">Less than $500</a>
                <a href="shop.php?lowPrice=500&highPrice=1000&search=" class="list-group-item">$500-$1000</a>
                <a href="shop.php?lowPrice=1000&highPrice=2000&search=" class="list-group-item">$1000-$2000</a>
                <a href="shop.php?lowPrice=2000&highPrice=3000&search=" class="list-group-item">$2000-$3000</a>
                <a href="shop.php?lowPrice=3000&highPrice=4000&search=" class="list-group-item">$3000-$4000</a>
                <a href="shop.php?lowPrice=4000&highPrice=10000&search=" class="list-group-item">$4000+</a>
        </div>
    </div>
</div>
