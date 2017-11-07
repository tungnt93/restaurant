<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Logo!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo admin_theme()?>production/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Xin chào,</span>
                <h2><?php echo $admin->fullname ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url('admin/report')?>"><i class="fa fa-home" aria-hidden="true"></i></i> Tổng quan</a></li>
                  <li><a><i class="fa fa-product-hunt" aria-hidden="true"></i> Món ăn <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('admin/product')?>"> Món ăn</a></li>
                      <li><a href="<?php echo base_url('admin/catalog')?>"> Thực đơn</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-text-o" aria-hidden="true"></i> Liên hệ, giới thiệu<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('admin/content/info')?>">Thông tin công ty</a></li>
                      <li><a href="<?php echo base_url('admin/content/social')?>">Liên kết mạng xã hội</a></li>
                      <li><a href="<?php echo base_url('admin/content/intro')?>"> Giới thiệu</a></li>
                      <li><a href="<?php echo base_url('admin/content/logo')?>">Logo</a></li>
                      <li><a href="<?php echo base_url('admin/content/slider')?>">Slide</a></li>
                    </ul>
                  </li>
                  <li><a href="<?php echo base_url('admin/admin')?>"><i class="fa fa-users" aria-hidden="true"></i></i> Quản trị viên <!-- <span class="fa fa-chevron-down"></span> --></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>