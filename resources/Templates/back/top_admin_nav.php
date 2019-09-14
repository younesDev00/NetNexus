<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php?main">SB Admin</a>
</div>

<ul class="nav navbar-right top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
        <ul class="dropdown-menu">

            <li class="divider"></li>
            <form  method="post">
                <li><a><input style="width:100%;" type="submit" class="btn btn-primary" name="logout" value="logout"></a></li>
            </form>
            <?php signout() ?>
        </ul>
    </li>
</ul>
