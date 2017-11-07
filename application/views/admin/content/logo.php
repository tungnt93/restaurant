<div class="row" style="margin-top: 40px; margin-left: 20px">
	<form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<th width="100px"></th>
				<th></th>
			</tr>
			<tr>
				<td style="width: 130px">Logo hiện tại</td>
				<td><img src="<?php echo public_url('images/'.$content->logo) ?>" width="200px"></td>
			</tr>
			<tr>
				<td>Upload logo mới</td>
				<td>
					<input type="file" id="logoUpload" name="logoUpload" required="required" style="padding: 5px;">
					<img id="pre_img" style="width: 150px" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" id="btnUpdateLogo" name="btnUpdateLogo" required="required" class="btn btn-primary" value="Cập nhật"  style="margin-top: 20px">

				</td>
			</tr>
		</table>

	</form>
</div>