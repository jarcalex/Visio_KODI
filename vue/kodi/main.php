       <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <a class="btn btn-app" <?php if(isset($_SESSION["TYPE"]) && $_SESSION["TYPE"] == "movie_view") { echo 'style="outline: 0 none; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset"';} else { echo 'href="?type=movie_view"';} ?>>
                            <i class="glyphicon glyphicon-film" ></i> Movie
                        </a>
                        <a class="btn btn-app" <?php if(isset($_SESSION["TYPE"]) && $_SESSION["TYPE"] == "tvshow_view") { echo 'style="outline: 0 none; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset"';} else { echo 'href="?type=tvshow_view"';} ?>>
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
                        <li>
                            <a href="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>?SerieStat">
                                <i class="glyphicon glyphicon-stats"></i> <span>Stats des Series</span>
                            </a>
                        </li>

<?php if (isset($_SESSION["TYPE"]) && $_SESSION["TYPE"] != "Dashboard") { ?>
                        <li>
                            <a href="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>?last">
                                <i class="glyphicon glyphicon-th"></i> <span>Dernier Ajout</span>
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
                        <li>
                            <a href="<?php echo $HOME; ?>index.php/<?php echo $URL[1];?>?random">
                                <i class="glyphicon glyphicon-th"></i> <span>Random</span>
                            </a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header"  style="height:36px">
                    <div class="pull-left image" style="margin-top:-10px">
                        <img src="<?php echo $HOME ?>img/thumbnail-light-300x300.png" class="img-circle" style="cursor:pointer" alt="Kodi Logo" onClick="sidebar()" />
                    </div>
                    <div class="pull-left" style="font-size: 20px; margin-top:-5px">
                        <?php if (isset($page_previous) && $page_previous > 0) { ?><a href="?<?php echo $Nav_url."&page=".$page_previous?>" > <i class="glyphicon glyphicon-chevron-left" ></i>previous</a><?php } ?>
                    </div>
                    
                    <div class="pull-right" style="font-size: 20px; margin-top:-5px">
                        <?php if (isset($page_next) && $page_next > 0) { ?><a href="?<?php echo $Nav_url."&page=".$page_next?>" >next <i class="glyphicon glyphicon-chevron-right" ></i></a> <?php } ?>
                    </div>
                </section>

                <!-- Main content -->
                <section class="content" style="padding-top: 15px; padding-bottom: 15px;">
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
