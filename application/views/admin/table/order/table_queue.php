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
    foreach ($orders as $row){ ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $this->product_model->get_info($row->product_id)->name?></td>
            <td><?php echo $row->quantity?></td>
            <td><?php echo $this->table_model->get_info($row->table_id)->name?></td>
            <td><?php echo date('h:i', $row->created)?></td>
            <td><?php echo $row->status == 1 ? 'Đang chờ' : ($row->status == 2 ? 'Đã giao' : 'Đang chờ hủy')?></td>
            <td>
                <?php if($row->status == 1){ ?>
                    <div onclick="cancel(<?php echo $row->id ?>)" class="btn btn-xs btn-warning">Hủy</div>
                <?php } else if($row->status == 3){ ?>
                    <div onclick="accept(<?php echo $row->id ?>)" class="btn btn-xs btn-success">Đồng ý</div>
                    <div onclick="deny(<?php echo $row->id ?>)" class="btn btn-xs btn-danger">Hủy</div>
                <?php }?>
            </td>
        </tr>
        <?php $i++; }?>

</table>