<div class="row">

    <h1 class="page-header">
        All Products

    </h1>

    <h4><?php display_message(); ?></h4>
    <table class="table table-hover">


        <thead>

            <tr>
                <th>Product Id</th>
                <th>Seller Id</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delete Order</th>

            </tr>
        </thead>
        <tbody>
            <?php get_products_backend();?>

        </tbody>
    </table>

</div>
