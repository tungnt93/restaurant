<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
	<div class="title_left"><h3>Thực đơn</h3></div>

		<div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
				<?php if($type > 0){ ?>
					<a href="<?php echo $type == 1 ? admin_url('kitchen/add_catalog') : admin_url('bar/add_catalog')?>" class="btn btn-primary btn-sm">Thêm mới</a>
				<?php }?>
				<a href="<?php echo $type == 1 ? admin_url('kitchen/catalog') : ($type == 2 ? admin_url('bar/catalog') : admin_url('catalog'))?>" class="btn btn-info btn-sm">Danh sách</a>
			</div>
		</div>

</div>
