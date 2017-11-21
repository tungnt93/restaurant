<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Bộ phân mua hàng</h3></div>
    <div class="title_right">
        <div class="col-md-9 col-sm-9 col-xs-12 pull-right">
            <a href="<?php echo admin_url('delivery/buy') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('delivery/buy') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<div class="row form-group form-horizontal form-label-left" style="margin: 10px 0px">
    <label class="control-label col-md-1 col-sm-6 col-xs-12" for="first-name">Chọn ngày</label>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <input type="text" id="txtDate" name="txtDate" value="<?php echo isset($date) ? $date : null?>" required="required"
               class="form-control col-md-7 col-xs-12" onchange="changeDate()">
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="x_panel" style="margin-top: 20px">
            <div class="x_title">
                <h2>Thực phẩm cần mua</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
            <div class="x_content" id="tb_food">
                <?php $this->load->view('admin/delivery/tb_food')?>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <div class="x_panel" style="margin-top: 20px">
            <div class="x_title">
                <h2>Thực đơn</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
            <div class="x_content" id="tb_daily_menu">
                <?php $this->load->view('admin/kitchen/daily_menu/tb_daily_menu')?>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    function changeDate() {
        var date = $('#txtDate').val();
        if(moment(date, "DD-MM-YYYY", true).isValid()){
            $.ajax({
                url : "<?php echo admin_url('kitchen/getDailyMenu'); ?>",
                type : "post",
                dataType:"text",
                data : {
                    date: date
                },
                success : function (result){
                    if(result){
                        $('#tb_daily_menu').html(result);
                    }
                }
            });
        }
    }
</script>
