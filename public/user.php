<?php
    require_once("../resources/config.php");
    include(TEMPLATE_FRONT . DS . "header.php");
?>

<div class="container">
    <?php
        if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
            $id = $_GET['user_id'];
            $accounttype = $_GET['accounttype'];
            echo $id;
            echo $accounttype;
        }else
        {
            redirect('index.php');
        }
    ?>
</div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
