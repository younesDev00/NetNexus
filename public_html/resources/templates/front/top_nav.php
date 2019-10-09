  <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
      <div class="container">
          <a class="navbar-brand mr-auto" href="index.php">
             <img class= "logo" src="https://i.imgur.com/ZSOkliB.png" alt="">
          </a>


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>


          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">


                  <li>
                      <a class="nav-link" href="shop.php?">Shop</a>
                  </li>

                <?php if(isset($_SESSION['useraccount']))
                {
                    echo '<li><a class="nav-link" href="checkout.php">Checkout</a></li>';
                }
                ?>

                <li>
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

            <?PHP

                if(isset($_SESSION['useraccount']))
                {
                    if($_SESSION['useraccount'][1] == 'buyer')
                    {
                        echo '<li><a class="nav-link" href="user.php">Welcome <strong class="text-primary">' .$_SESSION['useraccount'][0] .'</strong> </a></li>';
                        echo '<form style="padding:10px;float:left;" method="post"><li><a><input type="submit"  class="btn btn-danger" name="logout" value="logout"></a></li></form>' .signout() .' ';
        //                echo $_SESSION['useraccount'][1];

                    }else
                    {
                        echo '<li><a class="nav-link" href="/admin/index.php?main">Welcome ' .$_SESSION['useraccount'][0] .' </a></li>';

                    }
                } else
                {
                    echo '<li><a class="nav-link" href="login.php">Login</a></li>';
                    echo '<li><a class="nav-link" href="register.php">Register</a></li>';
                }
                ?>




              </ul>
          </div>

      </div>



</nav>
