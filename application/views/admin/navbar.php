<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">广告管理后台</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <?php echo $accemail;?><i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="<?php echo base_url()."index.php/dashboard/logout";?>"><i class="fa fa-sign-out fa-fw"></i> 注销</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo base_url();?>index.php/dashboard/navibar" <?php echo $navbar==1?"class='active'":" "?>>
                        <i class="fa fa-wrench fa-fw"></i> 导航栏
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/dashboard/slides" <?php echo $navbar==2?"class='active'":" "?>>
                        <i class="fa fa-picture-o fa-fw"></i> 幻灯片
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/dashboard/category" <?php echo $navbar==3?"class='active'":" "?>>
                        <i class="fa fa-tasks fa-fw"></i> 文章类别
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/dashboard/articles" <?php echo $navbar==4?"class='active'":" "?>>
                        <i class="fa fa-file-text fa-fw"></i> 文章管理
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/dashboard/settings" <?php echo $navbar==5?"class='active'":" "?>>
                        <i class="fa fa-user fa-fw"></i> 用户设置
                    </a>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

