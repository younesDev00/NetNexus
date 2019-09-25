<link href="css/styles.css" rel="stylesheet">

<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img src="https://i.imgur.com/kaBX8fL.png" alt="">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="shop.php?">Shop</a>
                </li>

                <?php if(isset($_SESSION['useraccount'])) { echo '<li><a href="checkout.php">Checkout</a></li>'; } ?>

                <li>
                    <a href="contact.php">Contact</a>
                </li>

                <?PHP

                if(isset($_SESSION['useraccount']))
                {
                    if($_SESSION['useraccount'][1] == 'buyer')
                    {
                        echo '<li><a href="user.php">Welcome <strong class="text-primary">' .$_SESSION['useraccount'][0] .'</strong> </a></li>';
                        echo '<form style="padding:10px;float:left;" method="post"><li><a><input type="submit"  class="btn btn-danger" name="logout" value="logout"></a></li></form>' .signout() .' ';
        //                echo $_SESSION['useraccount'][1];

                    }else
                    {
                        echo '<li><a href="/shoppingtest/public/admin/index.php?main">Welcome ' .$_SESSION['useraccount'][0] .' </a></li>';

                    }
                } else
                {
                    echo '<li><a href="login.php">Login</a></li>';
                    echo '<li><a href="register.php">Register</a></li>';
                }
                ?>


            </ul>
            <div style="padding-top:10px;float:right;">
                <form action="shop.php?" method="GET" class="submit-search">
                    <input type="text" placeholder="Search" name="search" aria-label="search">
                    <input type="submit" name="searchSubmit" >
                </form>
            </div>

        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- /.navbar-collapse -->
<!-- /.container -->

