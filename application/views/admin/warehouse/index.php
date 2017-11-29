
<?php $this->load->view('admin/warehouse/header')?>
<div class="row">
<div class="col-sm-4 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Kho thực phẩm</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-foods" class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <th>Tên</th>
                    <th>Số lượng</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($foods as $key => $value) {
//	        	    $food = $this->food_model->get_info($value->food_id);
                    ?>
                    <tr>
                        <td><?php echo $value->name?></td>
                        <td><?php echo $value->quantity.' '.$value->dram ?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <!-- <div class="btn btn-danger">Xóa danh mục đã chọn</div> -->
        </div>
    </div>
</div>
    <div class="col-sm-4 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Dụng cụ nhà bếp</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-foods" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($kitchen_utensils as $key => $value) {?>
                        <tr>
                            <td><?php echo $value->name?></td>
                            <td><?php echo $value->quantity.' chiếc'?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
                <!-- <div class="btn btn-danger">Xóa danh mục đã chọn</div> -->
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Dụng cụ quầy bar</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-foods" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($bar_utensils as $key => $value) {?>
                        <tr>
                            <td><?php echo $value->name?></td>
                            <td><?php echo $value->quantity.' chiếc'?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
                <!-- <div class="btn btn-danger">Xóa danh mục đã chọn</div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        }
    }
</script>
