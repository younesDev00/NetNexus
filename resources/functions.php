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
                redirect_user($username, $password);
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
