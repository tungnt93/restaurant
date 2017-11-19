<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
    <div class="title_left"><h3>Xây dựng thực đơn</h3></div>
    <div class="title_right">
        <div class="col-md-9 col-sm-9 col-xs-12 pull-right">
            <a href="<?php echo admin_url('kitchen/add_product')?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('kitchen/product')?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Nhập các thông tin</h2>
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
        <div class="row">
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên món ăn <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" id="txtName" name="txtName" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menu <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select class="select2_multiple form-control" name="slCatalog">
                            <?php foreach ($list_catalog as $r) { ?>
                                <option value="<?php echo $r->id ?>" <?php echo isset($catalog_id) && $catalog_id == $r->id ? 'selected' : '' ?> ><?php echo $r->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ước tính giá <span class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" id="txtPrice" name="txtPrice" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-4" for="first-name">Nguyên liệu<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-8">
                        <select class="select2_multiple form-control" name="slFood" id="slFood">
                            <?php foreach ($foods as $row) { ?>
                                <optgroup label="<?php echo $row->catalog?>">
                                    <?php foreach ($row->food as $food){ ?>
                                        <option value="<?php echo $food->id?>" ><?php echo $food->name?></option>
                                    <?php }?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-4" style="text-align: left;">Khối lượng</label>
                    <div class="col-md-1 col-sm-1 col-xs-8">
                        <input type="number" id="txtQuantity" name="txtQuantity" step="0.01" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                    <div class="btn btn-default" id="btnAddIngredient">Thêm</div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="list_nl" style="font-size: 18px">

                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                        <input type="submit" id="btnAddProduct" name="btnAddProduct" required="required" class="btn btn-success" value="Thêm món">
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>


<style type="text/css">
    td{
        vertical-align: middle !important;
    }
    .action a{
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btnAddIngredient').click(function () {
            var food_id = $('#slFood').val();
            var name = $('#slFood :selected').text();
            var quantity = $('#txtQuantity').val();
            if(quantity === '' ){
                alert('Bạn chưa nhập khối lượng');
            }
            else if(parseFloat(quantity) <= 0){
                alert('Khối lượng không hợp lệ');
            }
            else{
                quantity = parseFloat(quantity);
                $.ajax({
                    url : "<?php echo admin_url('product/addIngredient'); ?>",
                    type : "post",
                    dataType:"text",
                    data : {
                        quantity: quantity,
                        food_id: food_id
                    },
                    success : function (result){
                        console.log(result);
                        if(result > 0){
                            $('#list_nl').append(
                                '<div class="nl_'+ result +'">' +
                                '<div class="col-md-4 col-sm-4 col-xs-5">' + name + '</div>' +
                                '<div class="col-md-4 col-sm-4 col-xs-5">' + quantity + 'kg</div>' +
                                '<div class="col-md-4 col-sm-4 col-xs-2">' +
                                '<div class="btn btn-danger btn-xs" onclick="del_nl('+ result +')">Xóa</div>' +
                                '</div>' +
                                '<div>'
                            );
                            $('#txtQuantity').val('');
                        }
                        else{
                            alert('Có lỗi xảy ra, vui lòng thử lại');
                        }
                    }
                });
            }
        });
    });
</script>
