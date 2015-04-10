       <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <a class="btn btn-app" <?php if(isset($_SESSION["TYPE"]) && $_SESSION["TYPE"] == "movieview") { echo 'style="outline: 0 none; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset"';} else { echo 'href="?type=movieview"';} ?>>
                            <i class="glyphicon glyphicon-film" ></i> Movie
                        </a>
                        <a class="btn btn-app" <?php if(isset($_SESSION["TYPE"]) && $_SESSION["TYPE"] == "tvshowview") { echo 'style="outline: 0 none; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset"';} else { echo 'href="?type=tvshowview"';} ?>>
                            <i class="glyphicon glyphicon-blackboard" style="-webkit-transform:  rotate(180deg);-moz-transform:  rotate(180deg);-o-transform:  rotate(180deg);writing-mode: lr-tb;"></i> Tv Show
                        </a>
                    </div>
                    <!-- search form -->
                    <form action="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>" method="get" class="sidebar-form">
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
                            <a href="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>">
                                <i class="glyphicon glyphicon-list-alt"></i> <span>Liste All</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>?Dashboard">
                                <i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
<?php if (isset($_SESSION["TYPE"]) && $_SESSION["TYPE"] != "Dashboard") { ?>
                        <li>
                            <a href="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>?last">
                                <i class="glyphicon glyphicon-th"></i> <span>Dernier Ajout</span> <?php if ($new == 1) { echo '<small class="badge pull-right bg-green">new</small>';} ?>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-filter"></i> <span>Genre</span>
                                <i class="glyphicon glyphicon-menu-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
<?php echo $slct_genre ?>
                            </ul>
                        </li><?php } ?>
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
