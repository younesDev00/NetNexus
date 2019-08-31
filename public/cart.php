<?php require_once("../resources/config.php");

  if(isset($_GET['add'])) {
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)) {
      if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
        $_SESSION['product_' . $_GET['add']]+=1;
        redirect("../public/checkout.php");
      } else {
          set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
        redirect("../public/checkout.php");
      }
    }
  }

if(isset($_GET['remove']))
{
    $_SESSION['product_' .$_GET['remove']] -=1;

    if($_SESSION['product_' .$_GET['remove']] < 1)
    {
        unset($_SESSION['total_quantity']);//fixes values not going back to zero when no items in cart
        unset($_SESSION['total_cost']);
        redirect("checkout.php");
    }else
    {
        redirect("checkout.php");
    }
}

if(isset($_GET['delete']))
{
    $_SESSION['product_' .$_GET['delete']] = '0';
    unset($_SESSION['total_quantity']);//fixes values not going back to zero when no items in cart
    unset($_SESSION['total_cost']);
    redirect("checkout.php");
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
                            <td><a href="item.php?id={$row['product_id']}"><img style="width:65px;;height:65px;" class="imgsize" src="{$row['product_image']}" alt=""></a></td>
                            <td>{$row['product_title']}</td>
                            <td>&#36;{$row['product_price']}</td>
                            <td>{$value}</td><!-- current value of session (quantity) -->
                            <td>&#36;{$sub}</td>
                            <!-- buttons -->
                            <td>
                                <a class='btn btn-warning' href="cart.php?remove={$row['product_id']}">
                                    <span class='glyphicon glyphicon-minus'></span>
                                </a>
                                <a class='btn btn-success' href="cart.php?add={$row['product_id']}">
                                    <span class='glyphicon glyphicon-plus'></span>
                                </a>
                                <a class='btn btn-danger' href="cart.php?delete={$row['product_id']}">
                                    <span class='glyphicon glyphicon-remove'></span>
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
