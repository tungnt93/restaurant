<?php $this->load->view('admin/table/order/header')?>
<div class="row">
<div class="col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $table->name?></h2>
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
        <div class="x_content" id="list-order-in-table-<?php echo $table->id?>">
            <?php if($table->status == 1){ ?>
                <div class="btn btn-primary" id="open-table">Tạo bàn</div>
            <?php } else{ $this->load->view('admin/table/order/list_order_in_table'); }?>
        </div>
    </div>
</div>
<div class="col-sm-4 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Order</h2>
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
            <div class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Món ăn</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="select2_multiple form-control" name="slProduct" id="slProduct">
                            <?php foreach ($products as $key => $value) { ?>
                                <optgroup label="<?php echo $this->catalog_model->get_info($key)->name?>">
                                    <?php foreach ($value as $product){ ?>
                                        <option value="<?php echo $product->id?>" ><?php echo $product->name?></option>
                                    <?php }?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Số lượng</label>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="txtQuantity" name="txtQuantity" value="" required="required" class="form-control col-xs-12">
                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px">
                    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" style="width: 70px">
                        <input type="submit" id="btnAddOrder" name="btnAddOrder" required="required" class="btn btn-success" value="Thêm món">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#open-table').click(function () {
//            socket.emit('CLIENT_SEND', 'hello');
            $.ajax({
                url : "<?php echo admin_url('table/open_table'); ?>",
                type : "post",
                dataType:"text",
                data : {
                    table_id: <?php echo $table->id?>
                },
                success : function (result){
                    if(result){
                        console.log((result));
                        socket.emit('OPEN_TABLE', result);
                        location.reload();
                    }
                }
            });
        });

        $('#btnAddOrder').click(function () {
            var product_id = $('#slProduct').val();
            var quantity = $('#txtQuantity').val();
            var table_id = <?php echo $table->id?>;
            if(product_id && quantity){
                $.ajax({
                    url : "<?php echo admin_url('table/addOrder'); ?>",
                    type : "post",
                    dataType:"text",
                    data : {
                        product_id: product_id,
                        quantity: quantity,
                        table_id: table_id
                    },
                    success : function (result){
                        if(result){
//                            result = JSON.parse(result);
                            socket.emit('ADD_ORDER', table_id);
                            $('#list-order-in-table-'+table_id).html(result);
//                            location.reload();
                            console.log((result));
                        }
                    }
                });
            }
            else{
                alert(1);
            }
        });
    });

    function cancel(order_id){
        if(confirm('Xác nhận hủy món này?')){
            var table_id = <?php echo $table->id?>;
            $.ajax({
                url : "<?php echo admin_url('table/change_order'); ?>",
                type : "post",
                dataType:"text",
                data : {
                    order_id: order_id,
                    table_id: table_id,
                    change_type: 3
                },
                success : function (result){
                    if(result){
                        socket.emit('CHANGE_ORDER', table_id);
                        $('#list-order-in-table-'+table_id).html(result);
//                        location.reload();
                    }
                }
            });
        }
    }

    function undo(order_id){
        var table_id = <?php echo $table->id?>;
        $.ajax({
            url : "<?php echo admin_url('table/change_order'); ?>",
            type : "post",
            dataType:"text",
            data : {
                order_id: order_id,
                table_id: table_id,
                change_type: 1
            },
            success : function (result){
                if(result){
                    socket.emit('CHANGE_ORDER', table_id);
                    $('#list-order-in-table-'+table_id).html(result);
//                    location.reload();
                }
            }
        });
    }
</script>