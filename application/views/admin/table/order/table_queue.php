<table class="table table-striped table-bordered bulk_action">
    <tr>
        <th>STT</th>
        <th>Tên món</th>
        <th>Số lượng</th>
        <th>Tên bàn</th>
        <th>Thời gian order</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <?php
    $i = 1;
    $arr = array('Đang chờ', 'Đã giao', 'Đang chờ hủy', 'Đã hủy');
    $arrColor = array('#f9f9f9', 'lightcyan', 'lavender', 'antiquewhite');
    foreach ($orders as $row){ ?>
        <tr style="background-color: <?php echo $arrColor[$row->status - 1]?>">
            <td><?php echo $i?></td>
            <td><?php echo $this->product_model->get_info($row->product_id)->name?></td>
            <td><?php echo $row->quantity?></td>
            <td><?php echo $this->table_model->get_info($row->table_id)->name?></td>
            <td><?php echo date('h:i', $row->created)?></td>
            <td><?php echo $arr[$row->status - 1] ?></td>
            <td>
                <?php if($row->status == 1){ ?>
                    <div onclick="done(<?php echo $row->id ?>, <?php echo $row->table_id ?>)" class="btn btn-xs btn-success">Xong</div>
                    <div onclick="cancel(<?php echo $row->id ?>, <?php echo $row->table_id ?>)" class="btn btn-xs btn-warning">Hủy</div>
                <?php } else if($row->status == 3){ ?>
                    <div onclick="accept(<?php echo $row->id ?>, <?php echo $row->table_id ?>)" class="btn btn-xs btn-primary">Đồng ý</div>
                    <div onclick="deny(<?php echo $row->id ?>, <?php echo $row->table_id ?>)" class="btn btn-xs btn-danger">Hủy</div>
                <?php } else{ ?>
                    <div onclick="undo_action(<?php echo $row->id ?>, <?php echo $row->table_id ?>)" class="btn btn-xs btn-default">Hoàn tác</div>
                <?php }?>
            </td>
        </tr>
        <?php $i++; }?>

</table>

