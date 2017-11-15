<?php $this->load->view('admin/food/header')?>
<div class="row">
	<form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
		<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên<span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="text" id="txtName" name="txtName" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Loại <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control" name="slCatalog">
                    <?php foreach ($catalogs as $row){ ?>
                        <option value="<?php echo $row->id ?>"><?php echo $row->name?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Đơn vị đo<span class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" id="txtDram" name="txtDram" value="" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

      	<div class="form-group">
        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
          		<input type="submit" id="btnAdd" name="btnAdd" required="required" class="btn btn-success" value="Thêm">
        	</div>
      	</div>
	</form>

</div>