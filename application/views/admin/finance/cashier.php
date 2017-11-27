<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
    <div class="title_left"><h3>Thu ngân</h3></div>
</div>

<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách yêu cầu</h2>
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
    <div class="x_content" id="table-payment">
        <table id="tb-payment" class="table table-striped table-bordered bulk_action">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã hóa đơn</th>
                    <th>Thời gian</th>
                    <th>Tên bàn</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($bills as $row){ ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo date('h:i d/m/y', $row->created) ?></td>
                    <td><?php echo $this->table_model->get_info($row->table_id)->name ?></td>
                    <td><?php echo $row->status == 4 ? 'Đã thanh toán' : 'Chưa thanh toán' ?></td>
                    <td>
                        <?php if($row->status == 4){ ?>
                            <a href="<?php echo admin_url('finance/payment/'.$row->id) ?>" class="btn btn-xs btn-primary">Chi tiết</a>
                        <?php } else{ ?>
                            <a href="<?php echo admin_url('finance/payment/'.$row->id) ?>" class="btn btn-xs btn-danger">Thanh toán</a>
                        <?php }?>

                    </td>
                </tr>
            <?php $i++; }?>
            </tbody>
        </table>
    </div>
</div>