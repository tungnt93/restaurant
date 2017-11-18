
<?php $this->load->view('admin/timesheets/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Bảng chấm công tháng <?php echo $month->month_name?></h2>
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
        <div style="width: 100%; overflow-x: scroll;">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <tr>
                <th rowspan="3">STT</th>
                <th rowspan="3">Họ và tên</th>
                <th rowspan="3">Vị trí</th>
                <th colspan="<?php echo $month->total_day?>">Ngày trong tháng</th>
                <th rowspan="3">Tổng cộng</th>
            </tr>
            <tr>
                <?php for($i = 1; $i <= $month->total_day; $i++){ ?>
                    <td><?php echo $i ?></td>
                <?php }?>
            </tr>
            <tr>
                <?php for($i = 1; $i <= $month->total_day; $i++){ ?>
                    <td><?php echo 'T'.$i ?></td>
                <?php }?>
            </tr>
            <?php foreach ($timesheet_by_department as $row){ ?>

            <?php }?>
            <tr>
                <td>1</td>
                <td>Nguyễn Thanh Tùng</td>
                <td>Nhân viên</td>
                <?php for($i = 1; $i <= $month->total_day; $i++){ ?>
                    <td><?php echo 'C'.$i ?></td>
                <?php }?>
                <td>24</td>
            </tr>
        </table>
        </div>
    </div>
</div>
<style>
    #datatable-product{
        width: 400px !important;
        overflow: hidden !important;
    }
</style>
<script type="text/javascript">
    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        }
    }
</script>
