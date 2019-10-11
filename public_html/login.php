<?php require_once("../resources/config.php");
      include(TEMPLATE_FRONT . DS . "header.php");
?>

<!-- Page Content -->
<div class="container">
    <header>
        <h1 class="text-center">Login</h1>
        <h2 class="text-center bg-warning"><?php display_message(); ?></h2>
        <div class="col-sm-4 col-sm-offset-5">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">

                      Username:<input type="text" name="username" class="form-control" placeholder="Username/Email"></label>

                </div>
                <div class="form-group"><label for="password">
                        Password:<input type="password" name="password" class="form-control"></label>
                </div>
                <div class="form-group">
                    <input type="submit" name="submitlogin" class="btn btn-primary">
                </div>
                <?php login_user();  ?>
            </form>
        </div>
    </header>



</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
