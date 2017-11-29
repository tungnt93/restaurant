<table id="datatable-product" class="table table-striped table-bordered bulk_action">
    <thead>
    <tr>
        <th>Mã số</th>
        <th>Tên món</th>
        <th>Menu</th>
        <th>Số lượng</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($daily_menus as $row){ ?>
            <tr>
                <td><?php echo $row->id?></td>
                <td><?php echo $row->name?></td>
                <td><?php echo $row->menu?></td>
                <td><?php echo $row->quantity?></td>
                <td>
                    <a onclick="del(<?php echo $row->id?>, '<?php echo $row->name?>', '<?php echo $row->date?>')" class="btn btn-xs btn-danger">Xóa</a>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<script>
    function del(id, name, date) {
        if(confirm('Bạn muốn xóa món ăn ' + name + ' khỏi thực đơn ngày ' + date + '?')){
            $.ajax({
                url : "<?php echo admin_url('kitchen/delDailyMenu'); ?>",
                type : "post",
                dataType:"text",
                data : {
                    id: id,
                    date: date
                },
                success : function (result){
                    if(result){
                        $('#tb_daily_menu').html(result);
                    }
                }
            });
        }
    }
</script>