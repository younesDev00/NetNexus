<?php

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
                <div class="thumbnail" style="height:340px;">
                    <a href="item.php?id={$row['product_id']}"><img style="width: auto;height:165px;" class="imgsize" src="{$row['product_image']}" alt=""></a>
                    <div class="caption">
                        <h4 style="overflow: hidden;text-overflow: ellipsis;" >
                            <a style="text-overflow: ellipsis;" href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p style="overflow: hidden;text-overflow: ellipsis;">{$row['product_short_description']}</p>
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
                        <p style="overflow: hidden;text-overflow: ellipsis;">{$row['product_short_description']}</p>
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
   $query = query(" SELECT * FROM products");
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
                        <p style="overflow: hidden;text-overflow: ellipsis;">{$row['product_short_description']}</p>
                    </div>
                    <div class="ratings">
                        <p>
                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                        </p>
                    </div>
                </div>
            </div>

        DELIMETER;

        echo $product;
    }
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
            $accounquery = query("SELECT accounttype FROM users WHERE username = '{$username}' AND password = '{$password}'");
            confirm($accounquery);
            $accounttype = fetch_array($accounquery);

            if($accounttype[0] == 'seller')
                redirect("seller.php");
            else if($accounttype[0] == 'buyer')
            {
                redirect("buyer.php");
            }else if($accounttype[0] == 'admin')
            {
                redirect("admin/");
            }
        }
    }
}

function signup_user()
{
    if(isset($_POST['submitsignup']))
    {
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
                $query = query("INSERT INTO users(username,useremail,password,accounttype) VALUES('{$username}','{$email}','{$password}','{$accounttype}')");
                confirm($query);
                set_message("welcome {$username}");
                if($accounttype == 'seller')
                    redirect("seller.php");
                else if($accounttype == 'buyer')
                {
                    redirect("buyer.php");
                }else
                {
                    redirect("index.php");
                }
            }else
            {
                set_message("Passwords dont match");
                redirect("signup.php");
            }
        }else
        {
            set_message("Username already taken");
            redirect("signup.php");
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





//____________________________________ back end functions__________________//
