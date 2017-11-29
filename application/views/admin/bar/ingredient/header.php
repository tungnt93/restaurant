<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
	<div class="title_left"><h3>Nguyên liệu</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('bar/add_ing')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('bar/ingredients')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>
