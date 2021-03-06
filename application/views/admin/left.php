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
                <h2>
                    <?php echo $admin->employee_id == 0 ? $admin->username :
                        $this->employee_model->get_info($admin->employee_id)->name ?>
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <li><a href="<?php echo admin_url('report')?>"><i class="fa fa-home" aria-hidden="true"></i> Tổng quan</a></li>
                    <li><a><i class="fa fa-money" aria-hidden="true"></i> Quản lý tài chính <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('finance/cashier')?>">Thu ngân</a></li>
                            <li><a href="<?php echo admin_url('finance/report')?>">Các khoản thu chi</a></li>
                            <li><a href="<?php echo admin_url('finance/request')?>">Đề xuất mua sắm</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cutlery" aria-hidden="true"></i>Quản lý bàn <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('table/queue')?>">Hàng chờ</a></li>
                            <li><a href="<?php echo admin_url('table/order')?>">Gọi món</a></li>
                            <li><a href="<?php echo admin_url('table/book')?>">Đặt bàn</a></li>
                            <li><a href="<?php echo admin_url('table')?>">Danh sách bàn</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-users" aria-hidden="true"></i>Quản lý nhân sự <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('employee')?>">Danh sách nhân sự</a></li>
                            <li><a href="<?php echo admin_url('timesheets')?>">Bảng chấm công</a></li>
                            <li><a href="<?php echo admin_url('payroll')?>">Bảng lương</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-fire" aria-hidden="true"></i>Quản lý bếp <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('kitchen/order')?>">Danh sách order</a></li>
                            <li><a href="<?php echo admin_url('kitchen/product')?>">Sản phẩm</a></li>
                            <li><a href="<?php echo admin_url('kitchen/catalog')?>">Phân loại</a></li>
                            <li><a href="<?php echo admin_url('food')?>">Thực phẩm</a></li>
                            <li><a href="<?php echo admin_url('kitchen/daily_menu')?>">Thực đơn hàng ngày</a></li>
                            <li><a href="<?php echo admin_url('kitchen/utensil')?>">Dụng cụ nhà bếp</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-beer" aria-hidden="true"></i>Quản lý bar <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('bar/order')?>">Danh sách order</a></li>
                            <li><a href="<?php echo admin_url('bar/product')?>">Sản phẩm</a></li>
                            <li><a href="<?php echo admin_url('bar/catalog')?>">Phân loại</a></li>
                            <li><a href="<?php echo admin_url('bar/ingredients')?>">Nguyên liệu</a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo admin_url('bar/ingredients')?>">Danh sách</a></li>
                                  <li><a href="<?php echo admin_url('bar/add_ing')?>">Thêm mới</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo admin_url('bar/daily_menu')?>">Thực đơn hàng ngày</a></li>
                            <li><a href="<?php echo admin_url('bar/utensil')?>">Dụng cụ pha chế</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-shopping-basket" aria-hidden="true"></i> Quản lý kho, dụng cụ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('warehouse')?>">Thông tin kho</a></li>
                            <li><a href="<?php echo admin_url('warehouse/history')?>">Lịch sử</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-cart-plus" aria-hidden="true"></i>Mua - giao hàng<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('delivery/buy')?>">Mua hàng</a></li>
                            <li><a href="<?php echo admin_url('delivery')?>">Giao hàng</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-file-text-o" aria-hidden="true"></i> Quản lý website<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a>Sản phẩm <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo admin_url('product')?>"> Sản phẩm</a></li>
                                    <li><a href="<?php echo admin_url('catalog')?>"> Thể loại</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo admin_url('user')?>">Tài khoản</a></li>
                            <li><a>Thông tin, liên hệ <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo admin_url('content/info')?>">Thông tin công ty</a></li>
                                    <li><a href="<?php echo admin_url('content/social')?>">Liên kết mạng xã hội</a></li>
                                    <li><a href="<?php echo admin_url('content/intro')?>"> Giới thiệu</a></li>
                                    <li><a href="<?php echo admin_url('content/logo')?>">Logo</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo admin_url('content/slider')?>">Slide</a></li>
                        </ul>
                    </li>
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
