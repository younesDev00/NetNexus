<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php?main">Welcome <strong class="text-primary"><?php echo $_SESSION['useraccount'][0]; ?></strong> To <?php echo $_SESSION['useraccount'][1]; ?> Portal</a>
    <a class="navbar-brand" href="../index.php">Home</a>
</div>

<ul class="nav navbar-left top-nav">

    <form style="padding:10px;float:left;" method="post">
        <li><a><input type="submit" class="btn btn-danger" name="logout" value="logout"></a></li>
        <?PHP signout(); ?>
    </form>

</ul>
