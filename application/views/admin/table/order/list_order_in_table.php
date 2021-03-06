<table id="orders" class="table table-striped table-bordered bulk_action">
    <tr>
        <th>STT</th>
        <th>Tên món</th>
        <th>Số lượng</th>
        <th>Thời gian order</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <?php
    $i = 1;
    $arr = array('Đang chờ', 'Đã giao', 'Đang chờ hủy', 'Đã hủy');
    foreach ($orders as $row){ ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $this->product_model->get_info($row->product_id)->name?></td>
            <td><?php echo $row->quantity?></td>
            <td><?php echo date('h:i', $row->created)?></td>
            <td><?php echo $arr[$row->status - 1]?></td>
            <td>
                <?php if($row->status == 1){ ?>
                    <div onclick="cancel(<?php echo $row->id ?>)" class="btn btn-xs btn-danger">Hủy</div>
                <?php }
                else if($row->status == 3 || $row->status == 4){ ?>
                    <div onclick="undo(<?php echo $row->id ?>)" class="btn btn-xs btn-info">Gọi lại</div>
                <?php }?>
            </td>
        </tr>
        <?php $i++; }?>

</table>