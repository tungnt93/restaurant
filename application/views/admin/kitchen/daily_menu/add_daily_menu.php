<div class="x_panel" style="margin-top: 20px">
    <div class="x_title">
        <h2>Thêm món vào thực đơn</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <?php foreach ($products as $row) { ?>
                            <optgroup label="<?php echo $row->catalog?>">
                                <?php foreach ($row->product as $product){ ?>
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
                    <input type="submit" id="btnAddProduct" name="btnAddProduct" required="required" class="btn btn-success" value="Thêm món">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#btnAddProduct').click(function () {
            var product_id = $('#slProduct').val();
            var quantity = $('#txtQuantity').val();
            var date = $('#txtDate').val();
            if(!moment(date, "DD-MM-YYYY", true).isValid()){
                alert('Ngày không hợp lệ');
            }
            else if(quantity <= 0){
                alert('Số lượng không hợp lệ');
            }
            else{
                $.ajax({
                    url : "<?php echo admin_url('kitchen/addProductDailyMenu'); ?>",
                    type : "post",
                    dataType:"text",
                    data : {
                        quantity: quantity,
                        product_id: product_id,
                        date: date
                    },
                    success : function (result){
                        if(result){
                            $('#tb_daily_menu').html(result);
                        }
                    }
                });
            }

        });
    });
</script>