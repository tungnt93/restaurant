
<?php $this->load->view('admin/table/order/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách hàng chờ</h2>
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
    <div class="x_content" id="table-queue">
        <?php $this->load->view('admin/table/order/table_queue')?>
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
<script>
    $(document).ready(function() {

    });

    function accept(order_id){
        $.ajax({
            url : "<?php echo admin_url('table/accept_cancel_order'); ?>",
            type : "post",
            dataType:"text",
            data : {
                order_id: order_id,
                table_id: <?php echo $table->id?>
            },
            success : function (result){
                if(result){
                    socket.emit('CHANGE_ORDER', result);
                    $('#list-order-in-table').html(result);
//                        location.reload();
                }
            }
        });
    }

    function deny(order_id){
        $.ajax({
            url : "<?php echo admin_url('table/change_order'); ?>",
            type : "post",
            dataType:"text",
            data : {
                order_id: order_id,
                table_id: <?php echo $table->id?>,
                change_type: 1
            },
            success : function (result){
                if(result){
                    socket.emit('CHANGE_ORDER', result);
                    $('#list-order-in-table').html(result);
//                    location.reload();
                }
            }
        });
    }
</script>
