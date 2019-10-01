<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<!-- Page Content -->
<div class="container">


    <!-- /.row -->

    <div class="row">
       <div class="col-lg-12">
        <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
        <h1>Checkout</h1>

        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1"> <!-- this is the line u FORGOT 7 -->
            <input type="hidden" name="business" value="shoppingbus@test.com">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <!--                       Cart header -->
                        <th>image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th >Sub-total</th>

                    </tr>
                </thead>
                <!--                add cart items-->
                <?php cart(); ?>
            </table>
            <?php
            if($_SESSION['useraccount'][1] == "buyer")
            {
                if(isset($_SESSION['total_quantity']) && $_SESSION['total_quantity']> 0 )
                    echo '<input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal">';
            }
            ?>


<!--<input type="submit" value="PayPal">-->

        </form>


        <!--  ***********CART TOTALS*************-->

        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">
                <tbody>
                    <tr class="cart-subtotal">
                        <th>Items:</th>
                        <td><span class="amount">
                                <?php
                        //checking to see if session exists Str ? true : false
                        echo isset($_SESSION['total_quantity']) ? $_SESSION['total_quantity'] : $_SESSION['total_quantity'] = "0";
                    ?>
                            </span></td>
                    </tr>
                    <tr class="shipping">
                        <th>Shipping and Handling</th>
                        <td>Free Shipping</td>
                    </tr>

                    <tr class="order-total">
                        <th>Order Total</th>
                        <td>
                            <strong>
                                <span class="amount">$
                                    <?php
                                    //checking to see if session exists Str ? true : false
                                    echo isset($_SESSION['total_cost']) ? $_SESSION['total_cost'] : $_SESSION['total_cost'] = "0.00";
                                ?>
                                </span>
                            </strong>
                        </td>
                    </tr>


                </tbody>

            </table>


        </div><!-- CART TOTALS-->


    </div>
    </div>
    <!--Main Content-->



    <?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
