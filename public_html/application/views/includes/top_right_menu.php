
<div class="wrap">
            <header class="page-header">
            <div class="navbar">
                    
                <ul class="nav navbar-nav navbar-right pull-right"><?php echo $this->session->userdata('user_type'); ?>
                    <li class="divider"></li>

                    <li class="visible-xs">
                        <a href="#" class="btn-navbar" data-toggle="collapse" data-target=".sidebar" title="">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <li class="hidden-xs logout"><a href="<?php echo (site_url().'/login/logout') ?>"><i class="glyphicon glyphicon-off"></i></a></li>
                </ul>
            </div>
        </header>
        <div class="content container">
