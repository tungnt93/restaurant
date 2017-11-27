<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách</h2>
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
        <table id="datatable-catalog" class="table table-striped table-bordered bulk_action">

            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Tên bàn</th>
                <th rowspan="2">Tên khách hàng</th>
                <th colspan="3">Danh sách món</th>
                <th rowspan="2">Hành động</th>
            </tr>
            <tr>
                <th>Tên món</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
            </tr>
            <?php
            $i = 1;
            foreach ($tables as $row){ ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row->name?></td>
                    <td><?php echo $row->customer?></td>
                    <td>Tên món</td>
                    <td>Tên món</td>
                    <td>Tên món</td>
                    <td>
                        <a href="<?php echo admin_url('table/edit/'.$row->id)?>" class="btn btn-xs btn-primary">Order thêm</a>
                        <a onclick="del(<?php echo $row->id?>)" class="btn btn-xs btn-danger">Thanh toán</a>
                    </td>
                </tr>
                <?php $i++;} ?>

        </table>
        <!-- <div class="btn btn-danger">Xóa danh mục đã chọn</div> -->
    </div>
</div>
<style>
    td, th{
        vertical-align: middle !important;
        text-align: center;
        border: 1px solid #dddddd;
        padding: 8px;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: #000;
    }

</style>