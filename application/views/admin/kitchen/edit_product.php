<script language="javascript" src="<?php echo base_url('public')?>/ckeditor/ckeditor.js" type="text/javascript"></script>
<?php $this->load->view('admin/kitchen/header')?>

<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="row">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên món <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtName" name="txtName" value="<?php echo $product->name ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menu <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_multiple form-control" name="slCatalog">
                    <?php foreach ($list_catalog as $r) { ?>
                        <option value="<?php echo $r->id ?>" <?php echo $product->catalog_id == $r->id ? 'selected' : '' ?> ><?php echo $r->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Giá <span class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="txtPrice" name="txtPrice" value="<?php echo $product->price?>" disabled required="required" class="form-control col-md-7 col-xs-12">
            </div>
            <label class="col-md-2 col-sm-2 col-xs-12" style="padding-top: 8px" id="format_price"><?php echo number_format($product->price)?>đ</label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ảnh sản phẩm <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <img src="<?php echo public_url('images/product/'.$product->img_link) ?>" height="150px"><br>
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
                <?php foreach ($nl as $row){ ?>
                    <div class="nl_<?php echo $row->id?>">
                        <div class="col-md-4 col-sm-4 col-xs-5"><?php echo $this->food_model->get_info($row->food_id)->name?></div>
                        <div class="col-md-4 col-sm-4 col-xs-5"><?php echo $row->weigh?><?php echo $this->food_model->get_info($row->food_id)->dram?></div>
                        <div class="col-md-4 col-sm-4 col-xs-2">
                            <div class="btn btn-danger btn-xs" onclick="del_nl(<?php echo $row->id?>)">Xóa</div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="width: 70px">
                <input type="submit" id="btnUpdateProduct" name="btnUpdateProduct" required="required" class="btn btn-success" value="Cập nhật">
            </div>
        </div>
    </form>
</div>

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
                    url : "<?php echo admin_url('product/addEditIngredient'); ?>",
                    type : "post",
                    dataType:"text",
                    data : {
                        quantity: quantity,
                        food_id: food_id,
                        product_id: <?php echo $product->id?>
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

    function del_nl(id) {
        $.ajax({
            url : "<?php echo admin_url('product/del_nl'); ?>",
            type : "post",
            dataType:"text",
            data : {
                nl_id: id
            },
            success : function (result){
                console.log(result);
                if(result > 0){
                    $('.nl_' + result).remove();
                }
                else{
                    alert('Có lỗi xảy ra, vui lòng thử lại');
                }
            }
        });
    }

</script>
