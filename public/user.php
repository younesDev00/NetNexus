<?php
    require_once("../resources/config.php");
    include(TEMPLATE_FRONT . DS . "header.php");
?>

<div class="container">
    <?php
        if(isset($_SESSION['username']) && $_SESSION['username'][1] == 'buyer'){
            echo $_SESSION['username'][0];
        }else
        {
            redirect('index.php');
        }
    ?>
</div>

    <?php include(TEMPLATE_FRONT . DS . "footer.php");  ?>
