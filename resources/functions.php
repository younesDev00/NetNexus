 <?php
require("PHPMailer/PHPMailerAutoload.php");

//helper functions

function destroy_sess()
{
    session_destroy();
}

function set_message($msg)
{
    if(!empty($msg))
    {
        $_SESSION['message'] = $msg;
    }else{
        $msg = "";
    }
}

function display_message()
{
    if(isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function redirect($location){

    header("Location: $location ");
}

function query($sql){

    global $conn;
    return mysqli_query($conn, $sql);
}

function confirm($result){
    if(!$result)
    {
        die("QUERY FAILED" . mysqli_error($conn));
    }
}

function escape_string($string){
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}


function get_products()
{

    $query = query(" SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query))
    {
        $product = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail" style="height:340px">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:165px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;height: 64px;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    </div>
                </div>
            </div>

        DELIMETER;

        echo $product;
    }
}


function get_categories_products()
{
    $query = query(" SELECT * FROM products WHERE product_category_id =" . escape_string($_GET['id']) ."");
    confirm($query);

    while($row = fetch_array($query))
    {
        $product = <<<DELIMETER
            <div class="col-md-4 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:200px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;height: 84px;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                    </div>
                </div>
            </div>

        DELIMETER;

        echo $product;
    }
}


function get_categories()
{
    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = mysqli_fetch_array($query))
    {
        $categories = <<<DELIMETER
            <a href="category.php?id={$row['cat_id']}" class='list-group-item'>{$row['cat_title']}</a>
        DELIMETER;

        echo $categories;
    }
}


function  get_shop_products()
{


    $lowPrice;
    $highPrice;


    //if search is entered but no price filter
    if (empty(escape_string($_GET['lowPrice'])) && empty(escape_string($_GET['highPrice'])) &&(escape_string($_GET['search']))) {
        get_search();

        // if search is entered, and price filter
    }else if (escape_string($_GET['lowPrice']) && escape_string($_GET['highPrice']) && escape_string($_GET['search'])) {
        get_search_price_products();

        // if no filter or search entered
    } else if (empty(escape_string($_GET['lowPrice'])) && empty(escape_string($_GET['highPrice'])) && empty(escape_string($_GET['search']))) {
        get_all_products();


        // if price filter is entered
    } else if (empty(escape_string($_GET['search']))) {
        get_price_products();
    }

}



function redirect_user($username, $password)
{
    $accounquery = query("SELECT accounttype, user_id FROM users WHERE username = '{$username}' AND password = '{$password}'");
    confirm($accounquery);

    $accounttype = fetch_array($accounquery);

    if($accounttype['accounttype'] == 'seller')
    {
        redirect("user.php?user_id={$accounttype['user_id']}&accounttype={$accounttype['accounttype']}");
    }
    else if($accounttype['accounttype'] == 'buyer')
    {
        redirect("user.php?user_id={$accounttype['user_id']}&accounttype={$accounttype['accounttype']}");
    }else if($accounttype['accounttype'] == 'admin')
    {
        redirect("admin/");
    }
}

function redirect_email()
{
   // $accounquery = query("SELECT accounttype, user_id FROM users WHERE username = '{$username}' AND password = '{$password}'");
  //  confirm($accounquery);

   // $accounttype = fetch_array($accounquery);
        redirect("emailconfirmation.php");
}

function login_user()
{
    if(isset($_POST['submitlogin']))
    {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
        confirm($query);

        if(mysqli_num_rows($query) == 0)
        {
            set_message("incorrect password or username");
            redirect("login.php");
        }else
        {
            redirect_user($username, $password);
        }
    }
}

function signup_user()
{
    if(isset($_POST['submitsignup']))
    {
        $firstname = escape_string($_POST['firstname']);
        $lastname = escape_string($_POST['lastname']);
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $passwordrepeat = escape_string($_POST['password-repeat']);
        $accounttype = escape_string($_POST['accounttype']);

        $checkusers = query("SELECT username FROM users WHERE username = '{$username}' ");
        confirm($checkusers);
        if(mysqli_num_rows($checkusers) == 0)
        {

            if($password == $passwordrepeat)
            {
                $confirmcode = rand();
                $query = query("INSERT INTO users(firstname, lastname, username, useremail, password, accounttype, confirmed, confirmcode) VALUES('{$firstname}', '{$lastname}', '{$username}','{$email}','{$password}','{$accounttype}', '0', '{$confirmcode}')");
                confirm($query);
                //$message =
                //"
               // Confirm Your Email!
               // Click the link below to verify your NetNexus account
               // http://192.168.64.2/shoppingtest/public/emailconfirmation.php?username=$username&code=$confirmcode
                //";

                send_mail($email, $username, $confirmcode);

		      //echo "Registration Complete! Please confirm your email address";

            }else
            {
                set_message("Passwords Do Not Match");
                redirect("register.php");
            }
        }else
        {
            set_message("Username Already Taken");
            redirect("register.php");
        }

    }
}




function send_message()
{
    if(isset($_POST['submit']))
    {
        $to        = "someEmail@gmail.com";
        $from_name = $_POST["name"];
        $subject   = $_POST["subject"];
        $email     = $_POST["email"];
        $message   = $_POST["message"];
        $headers = "From: {$from_name} {$email}";

        //should change very unreliable
        $res = mail($to,$subject,$message,$headers);

        if(!res)
        {
            set_message("error");
            redirect("contact.php");
        }else
        {
            set_message("success");
            redirect("contact.php");

        }
    }
}

function send_mail($email, $username, $confirmcode)
{
 $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'netnexusshop@gmail.com';                 // SMTP username
$mail->Password = 'netnexus123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('donotreply@netnexus.com', 'NetNexus');
$mail->addAddress($email);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'NetNexus Email Confirmation';
$mail->Body    = "
                Confirm Your Email!
                Click the link below to verify your NetNexus account
                http://192.168.64.2/shoppingtest/public/emailconfirmation.php?username=$username&code=$confirmcode
                ";
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Registration Complete! Check your emails for a confirmation!';
}

}

// function to get products based on search
function get_search()
{

    $search = $_GET["search"];


    $query= query("SELECT * FROM products WHERE product_brand LIKE '%$search%' OR product_category_id IN(Select cat_id from categories where cat_title like '%$search%')");
    confirm($query);


    $queryResult = mysqli_num_rows($query);

    if ($queryResult > 0) {

        $query = query("SELECT * FROM products WHERE product_brand LIKE '%". escape_string($_GET['search']) ."%' OR product_category_id IN(Select cat_id from categories where cat_title like'%". escape_string($_GET['search']) ."%')  ");
        confirm($query);

        while($row = fetch_array($query))
        {
            $product = <<<DELIMETER
           <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail" style="height:340px">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:165px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;height: 64px;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    </div>
                </div>
            </div>

        DELIMETER;

            echo $product;

        }
    }else {
        echo "There are no results matching your search!";
    }

}


// function to get products based on price range

function get_price_products()
{
    $query = query(" SELECT * FROM products WHERE product_price BETWEEN " . escape_string($_GET['lowPrice']) ." AND " . escape_string($_GET['highPrice']) ." ");
    confirm($query);

    while($row = fetch_array($query))
    {
        $product = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail" style="height:340px">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:165px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;height: 64px;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    </div>
                </div>
            </div>

        DELIMETER;

        echo $product;
    }
}
// function to display all products

function get_all_products() {
    $query = query(" SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query))
    {
        $product = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail" style="height:340px">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:165px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;height: 64px;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    </div>
                </div>
            </div>

        DELIMETER;

        echo $product;
    }
}

// function to filter product by search and also price
function get_search_price_products() {

    $query = query(" SELECT * FROM products WHERE product_price BETWEEN " . escape_string($_GET['lowPrice']) ." AND " . escape_string($_GET['highPrice']) ." AND product_brand LIKE '%". escape_string($_GET['search']) ."%' OR product_category_id IN(Select cat_id from categories where cat_title like'%". escape_string($_GET['search']) ."%')");
    confirm($query);
    while($row = fetch_array($query))
    {
        $product = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail" style="height:340px">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:165px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;height: 64px;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    </div>
                </div>
            </div>

        DELIMETER;

        echo $product;
    }
}

function check_search() {

}

//____________________________________ back end functions__________________//
