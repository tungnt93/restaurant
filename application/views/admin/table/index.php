
<?php $this->load->view('admin/table/header')?>
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
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên bàn</th>
                <th>Số ghế</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    foreach ($tables as $row){ ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row->name?></td>
                        <td><?php echo $row->seat?></td>
                        <td>
                            <?php echo $row->status == 1 ? 'Đang trống' : ($row->status == 2 ? 'Đang dùng' : 'Đã đặt')?>
                            <?php if($row->status == 3){
                                echo '<br>Khách hàng: '.$row->customer;
                                echo '<br>Thời gian: '.date('h:i d/m/Y',$row->time);
                            }?>
                        </td>
                        <td>
                            <a href="<?php echo admin_url('table/edit/'.$row->id)?>" class="btn btn-xs btn-primary">Sửa</a>
                            <a onclick="del(<?php echo $row->id?>)" class="btn btn-xs btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php $i++;} ?>
            </tbody>
        </table>
        <!-- <div class="btn btn-danger">Xóa danh mục đã chọn</div> -->
    </div>
</div>
<script type="text/javascript">
    function del(id){
        if (confirm("Xóa bàn sẽ xóa toàn bộ thông tin order của bàn này, xác nhận xóa?")) {
            window.location.href = "<?php echo admin_url('table/del/')?>" + id;
        }
    }
</script>
