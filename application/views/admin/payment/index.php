<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">

    <div class="title_left"><h3>Thông tin thanh toán</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="<?php echo admin_url('table/order') ?>" class="btn btn-info btn-sm">Danh sách bàn</a>
        </div>
    </div>
</div>

<div class="x_panel">
    <div class="x_title">
        <h2><?php echo $table->name?></h2>
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
    <div class="x_content" id="list-order-in-table-<?php echo $table->id?>">
        <table id="orders" class="table table-striped table-bordered bulk_action">
            <tr>
                <th>STT</th>
                <th>Tên món</th>
                <th>Thời gian order</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            <?php
            $i = 1;
            $arr = array('Đang chờ', 'Đã giao', 'Đang chờ hủy', 'Đã hủy');
            $total = 0;
            foreach ($orders as $row){
                $product = $this->product_model->get_info($row->product_id);
                $total += $product->price*$row->quantity;
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $product->name?></td>
                    <td><?php echo date('h:i', $row->created)?></td>
                    <td><?php echo $row->quantity?></td>
                    <td><?php echo $product->price?> đ</td>
                    <td><?php echo $product->price*$row->quantity?> đ</td>
                </tr>
                <?php $i++; }?>
            <tr>
                <td colspan="5">Tổng</td>
                <td style="color: red"><?php echo $total?> đ</td>
            </tr>
        </table>
        <div class="btn btn-primary" style="margin-left: 40%">Gửi yêu cầu</div>
    </div>
</div>