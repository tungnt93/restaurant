<table id="tb-request" class="table table-striped table-bordered bulk_action">
    <thead>
    <tr>
        <th>Người yêu cầu</th>
        <th>Tên</th>
        <th>Số lượng</th>
        <th>Mô tả</th>
        <th>Thời gian</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($requests as $key => $value) {?>
        <tr>
            <td><?php echo $value->employee_id == 0 ? 'admin' : $this->employee_model->get_info($value->employee_id)->name ?></td>
            <td><?php echo $value->item_name?></td>
            <td><?php echo $value->quantity.' chiếc'?></td>
            <td><?php echo $value->description ?></td>
            <td><?php echo date('d/m/Y', $value->created) ?></td>
            <td><?php echo $value->status == 1 ? 'Đang chờ duyệt' : ($value->status == 2 ? 'Đã duyệt' : 'Đã hủy') ?></td>
            <td>
                <?php if($value->status == 1){ ?>
                    <div class="btn btn-xs btn-primary" onclick="confirm(<?php echo $value->id ?>, 2)">Duyệt</div>
                    <div class="btn btn-xs btn-danger" onclick="confirm(<?php echo $value->id ?>, 3)">Hủy</div>
                <?php } else if($value->status == 2){ ?>
                    <div class="btn btn-xs btn-danger" onclick="confirm(<?php echo $value->id ?>, 3)">Hủy</div>
                <?php } else{ ?>
                    <div class="btn btn-xs btn-primary" onclick="confirm(<?php echo $value->id ?>, 2)">Duyệt</div>
                <?php }?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
