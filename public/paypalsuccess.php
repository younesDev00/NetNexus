<?php
    require_once("../resources/config.php");
    include(TEMPLATE_FRONT . DS . "header.php");


if(isset($_GET['tx']) && !empty($_GET['tx'])){
    $amt = $_GET['amt'];
    $cc = $_GET['cc'];
    $st= $_GET['st'];
    $tx = $_GET['tx'];
    $query = query("INSERT INTO orders (order_amt, order_curency, order_status, order_transaction) values('$amt','$cc','$st','$tx')");
    confirm($query);

    session_destroy();

}else
{
    redirect('index.php');
}



?>

<!-- Page Content -->
    <div class="container">

        <div class="row">

          <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>


            <div class="col-md-9">

                <div class="row">

                    success


                </div><!-- ROw ends here-->

            </div>

        </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
