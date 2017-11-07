<script language="javascript" src="<?php echo base_url('public')?>/ckeditor/ckeditor.js" type="text/javascript"></script>
<form method="post">
	<div class="form-group">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<textarea id="txtIntro" required="required" class="form-control" name="txtIntro"><?php echo $content->intro ?></textarea>
			<script type="text/javascript">CKEDITOR.replace('txtIntro',{height: '300px'}); </script>
		</div>
	</div>
	<div class="form-group" style="margin-top: 50px">
		<div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-5" style="width: 70px; margin-top: 20px">
		    <input type="submit" id="btnUpdateIntro" name="btnUpdateIntro" required="required" class="btn btn-primary" value="Cập nhật">
		</div>
	</div>
</form>

