<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
    <div class="title_left"><h3>Nhập kho</h3></div>
    <div class="title_right">
        <div class="col-md-9 col-sm-9 col-xs-12 pull-right">
            <a href="<?php echo admin_url('warehouse/add')?>" class="btn btn-primary btn-sm">Nhập kho</a>
            <a href="<?php echo admin_url('warehouse')?>" class="btn btn-info btn-sm">Danh sách</a>
            <a href="<?php echo admin_url('warehouse/history')?>" class="btn btn-success btn-sm">Lịch sử</a>
        </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Nhập thông tin</h2>
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
    <div class="x_content" id="tb-history">
        <div class="row">
            <form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Chọn loại <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select class="form-control" name="slType" id="slType">
                            <option value="1">Thực phẩm</option>
                            <option value="2">Dụng cụ nhà bếp</option>
                            <option value="3">Dụng cụ quầy bar</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Chọn tên <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select class="form-control" name="slItem" id="slItem">
                            <?php foreach ($items as $row) { ?>
                                <optgroup label="<?php echo $row->optgroup?>">
                                    <?php foreach ($row->item as $item){ ?>
                                        <option value="<?php echo $item->id?>" ><?php echo $item->name?></option>
                                    <?php }?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="divUtensils"></div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số lượng<span class="required">*</span></label>
                    <div class="col-md-1 col-sm-1 col-xs-6">
                        <input type="number" id="txtQuantity" name="txtQuantity" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Đơn giá<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <input type="text" id="txtPrice" name="txtPrice" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align: left;">đ</label>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                        <input type="submit" id="btnAdd" name="btnAdd" required="required" class="btn btn-success" value="Thêm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#slItem').change(function () {
            var type = $('#slType').val();
            if($(this).val() === '0' && (type === '2' || type === '3')){
                $('.divUtensils').append(
                    '<div class="form-group">' +
                    '<label class="control-label col-md-2 col-sm-2 col-xs-12">Nhập tên<span class="required">*</span></label>' +
                    '<div class="col-md-4 col-sm-4 col-xs-12">' +
                    '<input type="text" id="txtNewUtensils" name="txtNewUtensils" value="" required class="form-control col-md-7 col-xs-12">' +
                    '</div>' +
                    '</div>'
                );
            }
        });

        $('#slType').change(function () {
            var type = $(this).val();
            if(type === '1'){
                $('.divUtensils').empty();
            }
            $.ajax({
                url : "<?php echo admin_url('warehouse/getItemsImportByType'); ?>",
                type : "post",
                dataType:"text",
                data : {
                    type: type
                },
                success : function (result){
                    if(result){
                        $('#slItem').html(result);
                    }
                }
            });
        });
    });

    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        }
    }

</script>
