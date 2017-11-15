<?php $this->load->view('admin/warehouse/header')?>
<div class="row">
	<form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Chọn thực phẩm <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control" name="slFood">
                    <?php foreach ($foods as $row){ ?>
                        <option value="<?php echo $row->id ?>"><?php echo $row->name?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số lượng<span class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-6">
                <input type="text" id="txtQuantity" name="txtQuantity" value="" required="required" class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align: left;"><?php echo $row->dram?></label>
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