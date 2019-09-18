<<<<<<< HEAD
<link href="css/styles.css" rel="stylesheet">

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
            <img src="https://i.imgur.com/kaBX8fL.png" alt="" >
        </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="shop.php?lowPrice&highPrice&search">Shop</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="admin">Admin</a>
            </li>
            <li>
                <a href="checkout.php">Checkout</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
            <li>
                <a href="register.php">Register</a>
            </li>

        </ul>

        <form class="search"  action="shop.php?lowPrice&highPrice&search" method="get">
            <input type="hidden" placeholder="Product Search" name="lowPrice">
            <input type="hidden" placeholder="Product Search" name="highPrice">
            <input type="text" placeholder="Product Search" name="search">
            <button type="submit" >Search</button>
        </form>



=======
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
                    <a href="shop.php">Shop</a>
                </li>
>>>>>>> master

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

<<<<<<< HEAD
</div>

<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
=======
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
            <div style="padding-top:10px;float:left;">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
>>>>>>> master
