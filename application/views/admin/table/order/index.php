
<?php $this->load->view('admin/table/order/header')?>
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
    <div class="x_content" id="list-table">
        <?php $this->load->view('admin/table/order/list_table')?>
    </div>
</div>
<style>
    .table-order{
        border: 1px solid #ccc;
        border-radius: 50%;
        text-align: center;
        width: 120px;
        height: 120px;
        margin: 0px auto;
        cursor: pointer;
    }
    .table-order i{
        font-size: 28px;
        margin-top: 35px;
    }

</style>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    function del(id){
        if (confirm("Xóa bàn sẽ xóa toàn bộ thông tin order của bàn này, xác nhận xóa?")) {
            window.location.href = "<?php echo admin_url('table/del/')?>" + id;
        }
    }

    function closeTable(table_id){
        $.ajax({
            url : "<?php echo admin_url('table/close_table'); ?>",
            type : "post",
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
</script>
