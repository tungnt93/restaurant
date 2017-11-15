<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
	<div class="title_left"><h3>Kho thực phẩm</h3></div>
	<div class="title_right">
		<div class="col-md-9 col-sm-9 col-xs-12 pull-right">
			<a href="<?php echo admin_url('warehouse/add')?>" class="btn btn-primary btn-sm">Nhập kho</a>
			<a href="<?php echo admin_url('warehouse')?>" class="btn btn-info btn-sm">Danh sách</a>
			<a href="<?php echo admin_url('warehouse')?>" class="btn btn-success btn-sm">Thống kê</a>
		</div>
	</div>
</div>