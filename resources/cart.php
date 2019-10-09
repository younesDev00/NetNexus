<?php require_once("../resources/config.php");

if(isset($_GET['add']))
{
if(isset($_SESSION['useraccount']))
{

$query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
confirm($query);

while($row = fetch_array($query))
{
if($_SESSION['product_' . $_GET['add']] < $row['product_quantity'] )
{
$_SESSION['product_' . $_GET['add']]+=1;
redirect("../checkout.php");
}else
{
set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
redirect("../checkout.php");
}
}
}else
{
set_message("You Need to register or Login to add items to cart");
redirect("../register.php");
}
}

if(isset($_GET['remove']))
{
$_SESSION['product_' .$_GET['remove']] -=1;

if($_SESSION['product_' .$_GET['remove']] < 1)
{
unset($_SESSION['total_quantity']);//fixes values not going back to zero when no items in cart
unset($_SESSION['total_cost']);
redirect("../checkout.php");
}else
{
redirect("../checkout.php");
}
}

if(isset($_GET['delete']))
{
$_SESSION['product_' .$_GET['delete']] = '0';
unset($_SESSION['total_quantity']);//fixes values not going back to zero when no items in cart
unset($_SESSION['total_cost']);
redirect("../checkout.php");
}


function cart()
{
//calculating cart quantity and total cost
$total = 0;
$item_quantity = 0;

//paypal integration
$item_name = 1;
$item_number = 1;
$amount = 1;
$quan = 1;
foreach($_SESSION as $name => $value)
{
//ignoring products that are not added to cart
if($value > 0){
//       taking out session name as char and checking if letters ==product_ then show products
//        sub str starts at 0 but begins from 1
if(substr($name, 0, 8) == "product_")
{
//grabing the session name and extracting id
$length = strlen($name) - 8;// deleteing the first 8 chars product_12 leaves 2 //returns int 2
//echo $length;
$id = substr($name, 8, $length);

$query = query("SELECT * FROM products WHERE product_id = " . $id . " ");
confirm($query);

while($row = fetch_array($query))
{
$sub = $row['product_price'] * $value; //value is num of active sessions calculating subtotal
$item_quantity += $value;
$product = <<<DELIMETER
<tbody>
    <tr>
        <td><a href="item.php?id={$row['product_id']}"><img style="width:65px;;height:65px;" class="imgsize" src="../resources/uploads/{$row['product_image']}" alt=""></a></td>
        <td>{$row['product_title']}</td>
        <td>&#36;{$row['product_price']}</td>
        <td>{$value}</td><!-- current value of session (quantity) -->
        <td>&#36;{$sub}</td>
        <!-- buttons -->
        <td>
            <a class='btn btn-warning' href="resources/cart.php?remove={$row['product_id']}">
                <span class='glyphicon glyphicon-minus'>-</span>
            </a>
            <a class='btn btn-success' href="resources/cart.php?add={$row['product_id']}">
                <span class='glyphicon glyphicon-plus'>+</span>
            </a>
            <a class='btn btn-danger' href="resources/cart.php?delete={$row['product_id']}">
                <span class='glyphicon glyphicon-remove'>x</span>
            </a>
        </td>
    </tr>
    <!-- PayPal buttons -->
      <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
      <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
      <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
      <input type="hidden" name="quantity_{$quan}" value="{$value}">
</tbody>
DELIMETER;

echo $product;
$total += $sub;

//indicating that there is more than one item in the shopping cart
    $item_name++;
    $item_number++;
    $amount++;
    $quan++;
}
$_SESSION['total_cost'] = $total;

}
$_SESSION['total_quantity'] = $item_quantity;
}


}




//echo $_SESSION['item_total'];
}


function processTrans()
{

if(isset($_GET['tx']) && !empty($_GET['tx']))
{
$amt = $_GET['amt'];
$cc = $_GET['cc'];
$st= $_GET['st'];
$tx = $_GET['tx'];
$total = 0;
$item_quantity = 0;

$activesessnum = count_Sessions();


if($activesessnum > 1)
{
$checkTransactions = query("SELECT order_transaction FROM orders WHERE order_transaction = '" . escape_string($tx). "' ");
confirm($checkTransactions);
if(mysqli_num_rows($checkTransactions) == 0)
{
$send_order = query("INSERT INTO orders (order_amt, order_curency, order_status, order_transaction) values('$amt','$cc','$st','$tx')");
$order_id = last_id();
confirm($send_order);
//ccc
foreach($_SESSION as $name => $value)
{
//if session has something in it
if($value > 0)
{

//if session is a product session
if(substr($name, 0, 8) == "product_")
{

    //grabing the session name and extracting id
    $length = strlen($name) - 8;// deleteing the first 8 chars product_12 leaves 2 //returns int 2
    //echo $length;
    $id = substr($name, 8, $length);



    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
    confirm($query);

    while($row = fetch_array($query))
    {
        $product_price = $row['product_price'];
        $sub = $row['product_price'] * $value; //value is num of active sessions calculating subtotal
        $item_quantity += $value;

        $insert_report = query("INSERT INTO reports (product_id, order_id,purchaser_id, purchased_product_price, purchased_quantity) values('$id','$order_id','{$_SESSION["useraccount"][3]}','$product_price','$value')");
        confirm($insert_report);

        $update_quantity = query("UPDATE products  SET product_quantity = product_quantity - {$value} WHERE product_id= {$id}");
        confirm($update_quantity);
    }
    $total += $sub;
    $item_quantity;
}
}


}
//session_destroy(); we dont want to logout the user
deleteSession_ExceptUser();
}else
{
redirect('index.php');
}
}





} else
{
redirect('index.php');
}




//echo $_SESSION['item_total'];
}
