<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">

    <div class="title_left"><h3>Thông tin order</h3></div>
    <div class="title_right">
        <div class="<?php echo (isset($table) && $table->status == 2) ? 'col-md-7 col-sm-7' : 'col-md-4 col-sm-4' ?>  col-xs-12 pull-right">
            <a href="<?php echo admin_url('table/order') ?>" class="btn btn-info btn-sm">Danh sách</a>
            <?php if(isset($table) && $table->status == 2){ ?>
                <a href="<?php echo admin_url('table/payment/'.$table->id) ?>" class="btn btn-primary btn-sm">Thanh toán</a>
                <a onclick="closeTable(<?php echo $table->id?>)" class="btn btn-danger btn-sm">Hủy bàn</a>
            <?php }?>
        </div>
    </div>

</div>

<!-- <script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    function closeTable(table_id){
        $.ajax({
            url : "<?php echo admin_url('table/close_table'); ?>",
            type : "POST",
            dataType:"text",
            data : {
                table_id: table_id
            },
            success : function (result){
                if(result){
                    socket.emit('CHANGE_TABLE', table_id);
                    location.reload();
                }
                else{
                    alert('Không thể hủy bàn khi có order!');
                }
            }
        });
    }
</script> -->
