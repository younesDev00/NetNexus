<div class="col-md-12">
    <div class="row">
        <h1 class="page-header">
            All Orders

        </h1>
        <h4 class="bg-success"><?php display_message(); ?></h4>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>
<!--//purchaser name, product name, purchased price, purchased quantity, order amount, order currency, order status, order transaction-->

                <tr>
                    <th>Sold By</th>
<!--                    <th>Product Type</th>-->
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Purchased Price</th>
                    <th>Purchased Quantity</th>
                    <th>Order ID</th>
                    <th>Order Amount</th>
                    <th>Order Currency</th>
                    <th>Order Status</th>
                    <th>Order Transaction Number</th>
                    <th>Delete Order</th>

<!--                    comming soon-->
<!--                    <th>Order Date</th> -->
                </tr>
            </thead>
            <tbody>

            <?php display_orders();  ?>

            </tbody>
        </table>
    </div>
</div>
