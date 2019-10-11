<?php
require("PHPMailer/PHPMailerAutoload.php");


//helper functions
function destroy_sess()
{
session_destroy();
}
function last_id()
{
global $conn;
return mysqli_insert_id($conn);
}
function deleteSession_ExceptUser()
{
foreach($_SESSION as $key => $val)
{
if ($key !== 'useraccount')
{
unset($_SESSION[$key]);
}
}
}
function count_Sessions()
{
$activesessnum = 0;
foreach($_SESSION as $key => $val)
{
if ($key !== 'useraccount')
{
$activesessnum++;
}
}
return $activesessnum;
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



function delimiter($query)
{
while($row = fetch_array($query))
{
if($row['product_quantity'] > 0)
{
$product = <<<DELIMETER
<div class="col-sm-12 col-md-6 col-lg-4  p-3 ">
<div class="card h-100">
<a href="item.php?id={$row['product_id']}"><img class="card-img-top" src="../resources/uploads/{$row['product_image']}" alt=""></a>
<div class="card-body">
<h4 class="card-title">
<a   href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
</h4>
<p class="card-text">{$row['product_short_description']}</p>
</div>
<div class="card-footer">
<small class="text-muted">
<a class="btn btn-primary pull-left" href="resources/cart.php?add={$row['product_id']}">Add To Cart</a>
<h5 style="float:right">&#36;{$row['product_price']}</h5>
</small>
</div>
</div>
</div>
DELIMETER;
echo $product;
}
}
}



function get_products()
{
$query = query(" SELECT * FROM products");
confirm($query);
delimiter($query);

}

function get_categories_products($i)
{
$a = $_GET['categories'];

$targetcat = $a[$i];

$query = query(" SELECT * FROM products WHERE product_category_id ='{$targetcat}' ORDER BY product_price ASC");
confirm($query);
delimiter($query);
}

function get_categories()
{
$query = query("SELECT * FROM categories");
confirm($query);
while($row = mysqli_fetch_array($query))
{
$categories = <<<DELIMETER
<input  type="checkbox" class="ml-1"name="categories[]" value="{$row['cat_id']}" > {$row['cat_title']}<br />
DELIMETER;
echo $categories;
}
}






function  get_shop_products()
{
if (isset($_GET['formSubmit'])) {


if (isset($_GET['categories']) && !isset($_GET['prices']) && !isset($_GET['brands']) && empty(escape_string($_GET['search']))) {
$aCategories=$_GET['categories'];
$N=count($aCategories);

for ($i=0; $i<$N; $i++) {
get_categories_products($i);
}
}
if(isset($_GET['prices']) && !isset($_GET['categories']) && !isset($_GET['brands']) && empty(escape_string($_GET['search']))) {
$aPrice = $_GET['prices'];

$N=count($aPrice);

for ($i=0; $i<$N; $i++) {
get_price_products($i);
}
}
if(isset($_GET['brands']) && !isset($_GET['prices']) && !isset($_GET['categories']) && empty(escape_string($_GET['search']))) {
$aBrands = $_GET['brands'];

$N=count($aBrands);

for ($i=0; $i<$N; $i++) {
get_brand_products($i);
}
}
if(isset($_GET['categories']) && isset($_GET['prices']) && !isset($_GET['brands']) && empty(escape_string($_GET['search']))) {
$catArray=$_GET['categories'];
$priceArray = $_GET['prices'];

get_price_category_products($catArray, $priceArray);
}
if(!isset($_GET['categories']) && isset($_GET['prices']) && isset($_GET['brands']) && empty(escape_string($_GET['search']))) {
$priceArray=$_GET['prices'];
$brandArray = $_GET['brands'];

get_price_brand_products($priceArray, $brandArray);
}

if(isset($_GET['categories']) && !isset($_GET['prices']) && isset($_GET['brands']) && empty(escape_string($_GET['search']))) {
$catArray=$_GET['categories'];
$brandArray = $_GET['brands'];

get_category_brand_products($catArray, $brandArray);
}

if(isset($_GET['categories']) && isset($_GET['prices']) && isset($_GET['brands']) && empty(escape_string($_GET['search']))) {
$catArray=$_GET['categories'];
$priceArray = $_GET['prices'];
$brandArray = $_GET['brands'];

get_price_category_brand_products($catArray, $priceArray, $brandArray);
}
if ((escape_string($_GET['search'])) && !isset($_GET['prices']) && !isset($_GET['categories']) && !isset($_GET['brands'])) {
$search = escape_string($_GET['search']);
get_search($search);
}
if ((escape_string($_GET['search'])) && isset($_GET['prices']) && !isset($_GET['categories']) && !isset($_GET['brands'])) {
$search = escape_string($_GET['search']);
$priceArray = $_GET['prices'];

get_search_price($search, $priceArray);
}
if ((escape_string($_GET['search'])) && !isset($_GET['prices']) && isset($_GET['categories']) && !isset($_GET['brands'])) {
$search = escape_string($_GET['search']);
$catArray = $_GET['categories'];

get_search_category($search, $catArray);
}
if ((escape_string($_GET['search'])) && !isset($_GET['prices']) && !isset($_GET['categories']) && isset($_GET['brands'])) {
$search = escape_string($_GET['search']);
$brandArray = $_GET['brands'];

get_search_brand($search, $brandArray);
}
if(isset($_GET['categories']) && isset($_GET['prices']) && !isset($_GET['brands']) && (escape_string($_GET['search']))) {
$catArray=$_GET['categories'];
$priceArray = $_GET['prices'];
$search = escape_string($_GET['search']);

get_price_category_search_products($catArray, $priceArray, $search);
}
if(!isset($_GET['categories']) && isset($_GET['prices']) && isset($_GET['brands']) && (escape_string($_GET['search']))) {
$brandArray=$_GET['brands'];
$priceArray = $_GET['prices'];
$search = escape_string($_GET['search']);

get_price_brand_search_products($brandArray, $priceArray, $search);
}
if(isset($_GET['categories']) && !isset($_GET['prices']) && isset($_GET['brands']) && (escape_string($_GET['search']))) {
$brandArray=$_GET['brands'];
$catArray = $_GET['categories'];
$search = escape_string($_GET['search']);

get_category_brand_search_products($brandArray, $catArray, $search);
}
if(isset($_GET['categories']) && isset($_GET['prices']) && isset($_GET['brands']) && (escape_string($_GET['search']))) {
$catArray=$_GET['categories'];
$priceArray = $_GET['prices'];
$brandArray = $_GET['brands'];
$search = escape_string($_GET['search']);

get_price_category_brand_search_products($catArray, $priceArray, $brandArray, $search);
}

} else {
get_products();
}
}

function redirect_user($username, $password)
{
$accounquery = query("SELECT * FROM users WHERE username = '{$username}' OR useremail = '{$username}' AND password = '{$password}'");
confirm($accounquery);
$accarr = fetch_array($accounquery);
$arr = array($accarr['firstname'], $accarr['accounttype'],$accarr['username'],$accarr['user_id']);
$_SESSION['useraccount'] = $arr;
if($accarr['accounttype'] == 'buyer')
{
redirect("index.php");
}
else if($accarr['accounttype'] == 'seller')
{
redirect("admin/index.php?main");// the ? after php for buyer no longer needed
}else if($accarr['accounttype'] == 'admin')
{
redirect("admin/index.php?main");// the ? after php for admin no longer needed
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
$userinput = escape_string($_POST['username']);
$password = escape_string($_POST['password']);
$query = query("SELECT * FROM users WHERE useremail = '{$userinput}' OR username = '{$userinput}'");
confirm($query);
$hashed = fetch_array($query);
if(mysqli_num_rows($query) == 0 || password_verify($password, $hashed['password']) == 0 )
{
set_message("incorrect password or username");
redirect("login.php");
}else if(password_verify($password, $hashed['password']))
{
redirect_user($userinput, $hashed['password']);
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

$hashedpwd = password_hash($password,PASSWORD_DEFAULT);
$confirmcode = rand();
$query = query("INSERT INTO users(firstname, lastname, username, useremail, password, accounttype, confirmed, confirmcode) VALUES('{$firstname}', '{$lastname}', '{$username}','{$email}','{$hashedpwd}','{$accounttype}', '0', '{$confirmcode}')");
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
function signout()
{
if(isset($_POST['logout']))
{
session_destroy();
redirect('https://netnexusweb.000webhostapp.com');
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
http://localhost:8080/shoppingtest/public/emailconfirmation.php?username=$username&code=$confirmcode
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
function get_search($search)
{
$query = query("SELECT * FROM products WHERE product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')");
confirm($query);

$queryResult = mysqli_num_rows($query);

if ($queryResult > 0)
{
delimiter($query);
}else {
echo "<b>There are no products matching your search!</b>";
}

}

function get_search_price($search, $priceArray) {


$querystring="";

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}


$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);

$queryResult = mysqli_num_rows($query);
$count=0;

if ($queryResult > 0)
{
delimiter($query);
}
else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_search_category($search, $catArray) {


$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {
$querystring .= "(product_category_id='{$catArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";

}
}


$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);

$queryResult = mysqli_num_rows($query);
$count=0;

if ($queryResult > 0)
{
delimiter($query);

}
else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_search_brand($search, $brandArray){


$querystring="";

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {
$querystring .= "(product_brand_id='{$brandArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";

}
}


$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);

$queryResult = mysqli_num_rows($query);
$count=0;

if ($queryResult > 0) {
delimiter($query);

}
else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_prices()
{
$query = query("SELECT * FROM pricerange");
confirm($query);
while($row = mysqli_fetch_array($query))
{
$pricerange = <<<DELIMETER
<input type="checkbox" class="ml-1" name="prices[]" value="{$row['price_id']}" > {$row['price_range']}<br />
DELIMETER;
echo $pricerange;
}
}

function get_price_products($i)
{
$a = $_GET['prices'];

$targetcat = $a[$i];

$query = query(" SELECT * FROM products WHERE product_pricerange_id ='{$targetcat}' ORDER BY product_price ASC ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}


function get_brands()
{
$query = query("SELECT * FROM brands order by brand_name ASC");
confirm($query);
while($row = mysqli_fetch_array($query))
{
$pricerange = <<<DELIMETER
<input type="checkbox" class="ml-1"name="brands[]" value="{$row['brand_id']}" > {$row['brand_name']}<br />
DELIMETER;
echo $pricerange;
}
}

function get_brand_products($i)
{
$a = $_GET['brands'];

$targetbrand = $a[$i];

$query = query(" SELECT * FROM products WHERE product_brand_id ='{$targetbrand}' ORDER BY product_price ASC ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {

delimiter($query);
}else {

echo "<b>There are no products matching your search!</b>";

}
}



function get_price_category_products($catArray, $priceArray) {
$catArray=$_GET['categories'];
$priceArray=$_GET['prices'];
$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {
$querystring .= "(product_category_id='{$catArray[$i]}') AND ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') AND ";
}elseif ($i==0) {
$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";

}
}

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}

$query = query(" SELECT * FROM products WHERE $querystring ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {

delimiter($query);
}else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_price_brand_products($priceArray, $brandArray){

$priceArray=$_GET['prices'];
$brandArray=$_GET['brands'];
$querystring="";

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {

$querystring .= "(product_brand_id='{$brandArray[$i]}') AND ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";

}
}

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}

$query = query(" SELECT * FROM products WHERE $querystring ");
confirm($query);

$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_category_brand_products($catArray, $brandArray){

$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {

$querystring .= "(product_category_id='{$catArray[$i]}') AND ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";
}
}

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {
$querystring .= "(product_brand_id='{$brandArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";

}
}

$query = query(" SELECT * FROM products WHERE $querystring ");
confirm($query);

$queryResult = mysqli_num_rows($query);

if ($queryResult > 0)
{
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_price_category_brand_products($catArray, $priceArray, $brandArray) {

$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {

$querystring .= "(product_category_id='{$catArray[$i]}') AND ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";
}
}

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {
$querystring .= "(product_brand_id='{$brandArray[$i]}') AND ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') AND ";
}elseif ($i==0) {
$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";

}
}

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}


$query = query(" SELECT * FROM products WHERE $querystring ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_price_category_search_products($catArray, $priceArray, $search) {

$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {

$querystring .= "(product_category_id='{$catArray[$i]}') AND ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";
}
}

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}


$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}

function get_price_brand_search_products($brandArray, $priceArray, $search) {
$querystring="";

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {

$querystring .= "(product_brand_id='{$brandArray[$i]}') AND ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";
}
}

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}


$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}
function get_category_brand_search_products($brandArray, $catArray, $search) {
$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {

$querystring .= "(product_category_id='{$catArray[$i]}') AND ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";
}
}

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {

$querystring .= "(product_brand_id='{$brandArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {

$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";
}
}

$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0)
{
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}
function get_price_category_brand_search_products($catArray, $priceArray, $brandArray, $search) {
$querystring="";

for ($i=0; $i<count($catArray); $i++) {
if ($i==0 && ($i+1)==count($catArray)) {

$querystring .= "(product_category_id='{$catArray[$i]}') AND ";
} elseif (($i+1)==count($catArray)) {
$querystring .= "product_category_id='{$catArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_category_id='{$catArray[$i]}' OR ";
}
else{
$querystring .= "product_category_id='{$catArray[$i]}' OR ";
}
}

for ($i=0; $i<count($brandArray); $i++) {
if ($i==0 && ($i+1)==count($brandArray)) {

$querystring .= "(product_brand_id='{$brandArray[$i]}') AND ";
} elseif (($i+1)==count($brandArray)) {
$querystring .= "product_brand_id='{$brandArray[$i]}') AND ";
}elseif ($i==0) {

$querystring .= "(product_brand_id='{$brandArray[$i]}' OR ";
}
else{
$querystring .= "product_brand_id='{$brandArray[$i]}' OR ";
}
}

for ($i=0; $i<count($priceArray); $i++) {
if ($i==0 && ($i+1)==count($priceArray)) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
} elseif (($i+1)==count($priceArray)) {
$querystring .= "product_pricerange_id='{$priceArray[$i]}') ORDER BY product_price ASC ";
}elseif ($i==0) {
$querystring .= "(product_pricerange_id='{$priceArray[$i]}' OR ";
}
else{
$querystring .= "product_pricerange_id='{$priceArray[$i]}' OR ";

}
}

$query= query("SELECT * FROM products WHERE (product_title LIKE '%$search%' OR product_category_id in(SELECT cat_id from categories where cat_title like '%$search%')) AND $querystring ");
confirm($query);
$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>There are no products matching your search!</b>";
}
}


//____________________________________ back end functions__________________//
function display_orders()
{
$up = "../../resources/uploads";
$del = "../../resources/templates/back/delete_order.php?";
if($_SESSION['useraccount'][1] == 'seller'  )
{
$query = query("SELECT *
FROM categories, reports INNER JOIN orders ON reports.order_id = orders.order_id
INNER JOIN products ON reports.product_id = products.product_id
INNER JOIN users ON reports.purchaser_id = users.user_id
WHERE        (categories.cat_id = products.product_category_id) &&
(products.seller_id = " . $_SESSION['useraccount'][3] ." )ORDER BY reports.order_id DESC");
confirm($query);

}else if( $_SESSION['useraccount'][1] == 'admin')
{
$query = query("SELECT *
FROM categories, reports INNER JOIN orders ON reports.order_id = orders.order_id
INNER JOIN products ON reports.product_id = products.product_id
INNER JOIN users ON reports.purchaser_id = users.user_id
WHERE categories.cat_id = products.product_category_id
ORDER BY  reports.order_id DESC");
confirm($query);
}else if($_SESSION['useraccount'][1] == 'buyer')
{
$query = query("SELECT *
FROM categories, reports INNER JOIN orders ON reports.order_id = orders.order_id
INNER JOIN products ON reports.product_id = products.product_id
INNER JOIN users ON reports.purchaser_id = users.user_id
WHERE        (categories.cat_id = products.product_category_id) &&
(reports.purchaser_id =  " .$_SESSION['useraccount'][3].") ORDER BY  reports.order_id DESC");
confirm($query);
$up = "../resources/uploads";
$del = "../resources/templates/back/delete_order.php?";
}
while($row = fetch_array($query))
{
$orders = <<<DELIMETER
<tr>
<td>{$row['seller_id']}</td>
<td>{$row['product_title']}</td>
<td><img style="width:64px; height:64px;" src="{$up}/{$row['product_image']}" alt=""></td>
<td>{$row['purchased_product_price']}</td>
<td>{$row['purchased_quantity']}</td>
<td>{$row['order_id']}</td>
<td>{$row['order_amt']}</td>
<td>{$row['order_curency']}</td>
<td>{$row['order_status']}</td>
<td>{$row['order_transaction']}</td>
<td><a class="btn btn-danger" href="{$del}id={$row['order_id']}&pr_id={$row['product_id']}"><span class="glyphicon ">X</span></a></td>
</tr>
DELIMETER;
echo $orders;
}
}

function show_recommended()
{
$query = query("SELECT * FROM products WHERE product_brand_id IN(SELECT brand_id FROM brands WHERE brand_id IN(SELECT product_brand_id FROM products WHERE product_id IN(SELECT product_id FROM reports WHERE purchaser_id IN(SELECT purchaser_id FROM reports WHERE purchaser_id IN(SELECT user_id FROM users WHERE user_id = " . $_SESSION['useraccount'][3] ."))))) limit 4");
confirm($query);

$queryResult = mysqli_num_rows($query);

if ($queryResult > 0) {
delimiter($query);
} else {
echo "<b>You Have Not Made Any Purchases!</b>";
}
}









function buyer_display_orders()
{
$up = "../../resources/uploads";
$del = "../../resources/templates/back/delete_order.php?";
if($_SESSION['useraccount'][1] == 'seller'  )
{
$query = query("SELECT *
FROM categories, reports INNER JOIN orders ON reports.order_id = orders.order_id
INNER JOIN products ON reports.product_id = products.product_id
INNER JOIN users ON reports.purchaser_id = users.user_id
WHERE        (categories.cat_id = products.product_category_id) &&
(products.seller_id = " . $_SESSION['useraccount'][3] ." )ORDER BY reports.order_id");
confirm($query);
echo "ff";
}else if( $_SESSION['useraccount'][1] == 'admin')
{
$query = query("SELECT *
FROM categories, reports INNER JOIN orders ON reports.order_id = orders.order_id
INNER JOIN products ON reports.product_id = products.product_id
INNER JOIN users ON reports.purchaser_id = users.user_id
WHERE categories.cat_id = products.product_category_id
ORDER BY  reports.order_id");
confirm($query);
}else if($_SESSION['useraccount'][1] == 'buyer')
{
$query = query("SELECT *
FROM categories, reports INNER JOIN orders ON reports.order_id = orders.order_id
INNER JOIN products ON reports.product_id = products.product_id
INNER JOIN users ON reports.purchaser_id = users.user_id
WHERE        (categories.cat_id = products.product_category_id) &&
(reports.purchaser_id =  " .$_SESSION['useraccount'][3].") ");
confirm($query);
$up = "../resources/uploads";
$del = "../resources/templates/back/delete_order.php?";
}
while($row = fetch_array($query))
{
$orders = <<<DELIMETER
<tr>
<td>{$row['cat_title']}</td>
<td>{$row['product_title']}</td>
<td><img style="width:64px; height:64px;" src="{$up}/{$row['product_image']}" alt=""></td>
<td>{$row['purchased_product_price']}</td>
<td>{$row['purchased_quantity']}</td>
<td>{$row['order_id']}</td>
<td>{$row['order_amt']}</td>
<td>{$row['order_curency']}</td>
<td>{$row['order_status']}</td>
<td>{$row['order_transaction']}</td>
<td><a class="btn btn-danger" href="{$del}id={$row['order_id']}&pr_id={$row['product_id']}"><span class="glyphicon ">X</span></a></td>
</tr>
DELIMETER;
echo $orders;
}
}
//sql query to select all will be needed
//SELECT users.user_id, products.seller_id, products.seller_id, product_image, product_title, purchased_product_price, purchased_quantity, order_amt, order_curency, order_status, order_transaction
//FROM reports r, products p, users u, orders o
//WHERE r.order_id = o.order_id && (r.product_id = p.product_id) &&(r.purchaser_id = u.user_id)
function get_products_backend()
{
if($_SESSION['useraccount'][1] == 'seller' )
{
$query = query(" SELECT * FROM users,products, categories  WHERE (users.user_id = products.seller_id) && (categories.cat_id = products.product_category_id ) && products.seller_id = " .$_SESSION['useraccount'][3]." ");
confirm($query);
$up = "../../resources" . DS . "uploads" . DS;
$del = "../../resources/templates/back/delete_product.php?";
}else if( $_SESSION['useraccount'][1] == 'admin')
{
$query = query(" SELECT * FROM products, categories  WHERE categories.cat_id = products.product_category_id");
confirm($query);
$up = "../../resources" . DS . "uploads" . DS;
$del = "../../resources/templates/back/delete_product.php?";
}
while($row = fetch_array($query))
{
$product = <<<DELIMETER
<tr>
<td>{$row['product_id']}</td>
<td>{$row['seller_id']}</td>
<td>{$row['product_title']}<br>
<a href="index.php?edit_product&id={$row['product_id']}"><img style="width:64px; height:64px;" src="{$up}{$row['product_image']}" alt=""></a>
</td>
<td>{$row['cat_title']}</td>
<td>{$row['product_price']}</td>
<td>{$row['product_quantity']}</td>
<td><a class="btn btn-danger" href="{$del}id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>
DELIMETER;
echo $product;
}
}
//add products
function add_product()
{
if(isset($_POST['publish']))
{
$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);
//if(move_uploaded_file($image_temp_location, UPLOADS_DIRECTORY . DS . $product_image))
//{
//    redirect("index.php");
//}else
//{
//        redirect("index.php?fucku");
//
//}
$query = query("INSERT INTO products(product_title,seller_id, product_category_id, product_price,product_quantity, product_description, product_short_description, product_image) VALUES('{$product_title}','{$_SESSION['useraccount'][3]}', '{$product_category_id}', '{$product_price}','{$product_quantity}', '{$product_description}', '{$short_desc}',  '{$product_image}')");
$last_id = last_id();
confirm($query);
set_message("New Product with id {$last_id} was Added");
//might need move_uploaded_file on live server
if(copy($image_temp_location, UPLOADS_DIRECTORY . DS . $product_image))
{
redirect("index.php?products");
}else
{
//redirect("index.php?fucku");
echo $_FILES["file"]['name']."<br>";
echo $_FILES["file"]['tmp_name']."<br>";
echo $_FILES["file"]['size']."<br>";
echo $_FILES['file']['error']."<br>";
echo UPLOADS_DIRECTORY . DS . $product_image;
}
}
}
function backend_addproductpage_categories()
{
$query = query("SELECT * FROM categories");
confirm($query);
while($row = mysqli_fetch_array($query))
{
$categoriesoptions = <<<DELIMETER
<option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMETER;
echo $categoriesoptions;
}
}
function backend_categories_title($id)
{
$query = query("SELECT * FROM categories WHERE cat_id=" .$id);
confirm($query);
while($row = mysqli_fetch_array($query))
{
return $row['cat_title'];
}
}
function update_product()
{
if(isset($_POST['update']))
{
$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);
if(empty($product_image)) {
$get_pic = query("SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");
confirm($get_pic);
while($pic = fetch_array($get_pic)) {
$product_image = $pic['product_image'];
}
}
copy($image_temp_location, UPLOADS_DIRECTORY . DS . $product_image);
$query = "UPDATE products SET ";
$query .= "product_title              = '{$product_title}'        , ";
$query .= "product_category_id        = '{$product_category_id}'  , ";
$query .= "product_price              = '{$product_price}'        , ";
$query .= "product_quantity           = '{$product_quantity}'     , ";
$query .= "product_description        = '{$product_description}'  , ";
$query .= "product_short_description  = '{$short_desc}'           , ";
$query .= "product_image              = '{$product_image}'          ";
$query .= "WHERE product_id           = " . escape_string($_GET['id']);
$query_update = query($query);
confirm($query_update);
set_message("Product updated");
//might need move_uploaded_file on live server
redirect("index.php?products");
}
}

function display_users()
{


$category_query = query("SELECT * FROM users");
confirm($category_query);


while ($row = fetch_array($category_query)) {

$user_id = $row['user_id'];
$username = $row['username'];
$email = $row['useremail'];
$userType = $row['accounttype'];

$user = <<<DELIMETER


<tr>
<td>{$user_id}</td>
<td>{$username}</td>
<td>{$email}</td>
<td>{$userType}</td>
<td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
<td><a class="btn btn-primary" href="../../resources/templates/back/upgrade_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-plus"></span></a></td>
</tr>



DELIMETER;

echo $user;


}


}



function add_user() {


if(isset($_POST['add_user'])) {


$username   = escape_string($_POST['username']);
$email      = escape_string($_POST['email']);
$password   = escape_string($_POST['password']);
// $user_photo = escape_string($_FILES['file']['name']);
// $photo_temp = escape_string($_FILES['file']['tmp_name']);


// move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);


$query = query("INSERT INTO users(username,useremail,password) VALUES('{$username}','{$email}','{$password}')");
confirm($query);

set_message("USER CREATED");

redirect("index.php?users");



}



}



function add_category() {

if(isset($_POST['add_category'])) {
$cat_title = escape_string($_POST['cat_title']);

if(empty($cat_title) || $cat_title == " ") {

echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";


} else {


$insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
confirm($insert_cat);
set_message("Category Created");



}


}




}



function show_categories_in_admin() {


$category_query = query("SELECT * FROM categories");
confirm($category_query);


while($row = fetch_array($category_query)) {

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];


$category = <<<DELIMETER


<tr>
<td>{$cat_id}</td>
<td>{$cat_title}</td>
<td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>



DELIMETER;

echo $category;



}



}
