<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
	<div class="title_left"><h3>Đặt bàn</h3></div>
</div>

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
    <div class="x_content" id="tb-history">
        <table id="datatable-catalog" class="table table-striped table-bordered bulk_action">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Số người</th>
                    <th>Thời gian</th>
                    <th>Thời gian đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($books as $key => $value) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->c_name ?></td>
                        <td><?php echo $value->c_phone ?></td>
                        <td><?php echo $value->number ?></td>
                        <td><?php echo $value->time ?></td>
                        <td><?php echo date('H:i d/m/Y', $value->created) ?></td>
                        <td>
                            <div class="btn btn-xs btn-primary">Xong</div>
                        </td>
                    </tr>
                <?php $i++; }?>
            </tbody>
        </table>
    </div>
</div>

<div class="x_panel">
    <div class="x_title">
        <h2>Lịch sử</h2>
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
    <div class="x_content" id="tb-history">
        <table id="datatable-catalog" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Số người</th>
                <th>Thời gian</th>
                <th>Thời gian đặt</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($books as $key => $value) { ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->c_name ?></td>
                    <td><?php echo $value->c_phone ?></td>
                    <td><?php echo $value->number ?></td>
                    <td><?php echo $value->time ?></td>
                    <td><?php echo date('H:i d/m/Y', $value->created) ?></td>
                    <td>
                        <div class="btn btn-xs btn-primary">Xong</div>
                    </td>
                </tr>
                <?php $i++; }?>
            </tbody>
        </table>
    </div>
</div>
