<script language="javascript" src="<?php echo base_url('public')?>/ckeditor/ckeditor.js" type="text/javascript"></script>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ảnh minh họa <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="file" id="imageMenu" name="imageMenu" value="" required="required" style="padding: 5px;" accept="image/*">
                <img id="pre_img" style="width: 150px" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Danh mục sản phẩm <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control" name="slCatalog">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Thêm người vào dự án</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_multiple form-control">
                    <optgroup label="label 1">
                        <option value="1" >option 1</option>
                        <option value="1" >option 2</option>
                    </optgroup>
                    <optgroup label="label 2">
                        <option value="1" >option 3</option>
                        <option value="1" >option 4</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mô tả <span class="required">*</span></label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea id="txtIntro" required="required" class="form-control" name="txtIntro"></textarea>
                <script type="text/javascript">CKEDITOR.replace('txtIntro',{height: '300px'}); </script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                <input type="submit" id="btnAddCatalog" name="btnAddCatalog" required="required" class="btn btn-success" value="Thêm" style="width: 100px">
            </div>
        </div>
    </form>
</div>
