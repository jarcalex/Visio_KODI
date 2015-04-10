       <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <a class="btn btn-app" <?php if($_SESSION["TYPE"] == "movie") { echo 'style="outline: 0 none; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset"';} else { echo 'href="?type=movie"';} ?>>
                            <i class="glyphicon glyphicon-film" ></i> Movie
                        </a>
                        <a class="btn btn-app" <?php if($_SESSION["TYPE"] == "anime") { echo 'style="outline: 0 none; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset"';} else { echo 'href="?type=anime"';} ?>>
                            <i class="glyphicon glyphicon-blackboard" style="-webkit-transform:  rotate(180deg);-moz-transform:  rotate(180deg);-o-transform:  rotate(180deg);writing-mode: lr-tb;"></i> Anime
                        </a>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="titre" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.html">
                                <i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages/widgets.html">
                                <i class="glyphicon glyphicon-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-edit"></i> <span>Genre</span>
                                <i class="glyphicon glyphicon-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<?php echo $slct_genre ?>
                            </ul>
                        </li>
                        <li>
                            <a href="pages/mailbox.html">
                                <i class="glyphicon glyphicon-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="pull-left image">
                        <img src="<?php echo $HOME ?>img/thumbnail-light-300x300.png" class="img-circle" style="cursor:pointer" alt="Kodi Logo" onClick="sidebar()" />
                    </div>
                    <h1>
                        <?php echo $URL[1] ?> <i class="glyphicon glyphicon-minus" style="font-size:15px"></i><i class="glyphicon glyphicon-chevron-right" style="font-size:15px"></i> <?php echo $_SESSION["TYPE"]; ?>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
<?php
include_once($View);
?>
		</section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
<style type="text/css">
.container-fluid {
    padding-left: 0px;
    padding-right: 0px;
}
</style>