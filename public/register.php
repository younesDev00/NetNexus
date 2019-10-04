<?php require_once("../resources/config.php");
      include(TEMPLATE_FRONT . DS . "header.php");
?>

<!-- Page Content -->
<div class="container">

    <header>
        <h1 class="text-center">Register a NetNexus Account</h1>
        <h2 class="text-center bg-warning"><?php display_message(); ?></h2>
        <div class="col-sm-4 col-sm-offset-4">
            <form class="" action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" class="form-control" placeholder="Your First Name " id="firstname" required data-validation-required-message="Please enter your first name.">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Your Last Name " id="lastname" required data-validation-required-message="Please enter your last name.">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="form-group">
                    <label for="username">User Name:</label>
                    <input type="text" name="username" class="form-control" placeholder="Your Username " id="username" required data-validation-required-message="Please enter a user name.">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Your password" id="password" required data-validation-required-message="Please enter a password.">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="form-group">
                    <label for="password-repeat">Check password:</label>
                    <input type="password" name="password-repeat" class="form-control" placeholder="Check Password" id="password-repeat" required data-validation-required-message="password check required">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="form-group">
                    <label for="accounttype">Account Type</label>

                        <select name="accounttype">
                            <option value="buyer">Buyer</option>
<!--                            <option value="seller">Seller</option>-->
                        </select>
                </div>

                <div id="passwordsub">
                    <div class="form-group">
                        <input type="submit" name="submitsignup" class="btn btn-primary">
                    </div>
                </div>

                <?php  signup_user();  ?>
            </form>

        </div>


    </header>




</div>
<!-- /.container -->

<!--
<script>

var passwordone = document.getElementById('password').innerHTML;
var passwordtwo = document.getElementById('password-repeat').innerHTML;

console.log(passwordone);
console.log(passwordtwo);


</script>
-->

<?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>

