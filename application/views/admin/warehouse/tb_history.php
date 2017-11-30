<table id="datatable-catalog" class="table table-striped table-bordered bulk_action">
    <thead>
    <tr>
        <th>Tên</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Ngày nhập</th>
        <th>Người nhập</th>
        <th>Hành động</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($imports as $key => $value){
        if($value->type == 1){
            $item = $this->food_model->get_info($value->item_id);
        }
        else if($value->type == 2 || $value->type == 3){
            $item = $this->utensils_model->get_info($value->item_id);
        }?>
        <tr>
            <td><?php echo $item->name?></td>
            <td><?php echo $value->quantity.' '?><?php echo $value->type == 1 ? $item->dram : 'Chiếc'?></td>
            <td><?php echo $value->price ?>đ</td>
            <td><?php echo date('H:i d/m/Y',$value->created)?></td>
            <td><?php echo $this->employee_model->get_info($value->create_by)->name?></td>
            <td>
                <a href="<?php echo admin_url('warehouse/edit/'.$value->id)?>" class="btn btn-xs btn-primary">Sửa</a>
                <a onclick="delCatalog(<?php echo $value->id?>)" class="btn btn-xs btn-danger">Xóa</a>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
