<?php require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

?>

<h1>Search Results</h1>
<?php
 $search = mysqli_real_escape_string($conn, $_POST["search"]);



    $sql= "SELECT * FROM products WHERE product_brand LIKE '%$search%' OR product_category_id IN(Select cat_id from categories where cat_title like '%$search%')";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);


    if ($queryResult > 0) {

        get_search_products();

    }else {
        echo "There are no results matching your search!";
    }

?>
