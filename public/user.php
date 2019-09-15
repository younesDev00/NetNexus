<?php
    require_once("../resources/config.php");
    include(TEMPLATE_FRONT . DS . "header.php");
?>

<div class="container">
    <?php
        if(isset($_SESSION['useraccount']) && $_SESSION['useraccount'][1] == 'buyer'){
            echo $_SESSION['useraccount'][0];
        }else
        {
            redirect('index.php');
        }
    ?>
</div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
