<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="page-title">
	<div class="title_left"><h3>Nhân viên</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('user/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('user')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>

<div class="x_panel">
	<div class="x_title">
		<h2>Danh sách quản trị viên website</h2>
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
	<div class="x_content">
		<table id="datatable-product" class="table table-striped table-bordered bulk_action">
	        <thead>
	          <tr>
	            <th>Họ tên</th>
	            <th>Username</th>
	            <th>Ngày tạo</th>
	            <th>Người tạo</th>
	            <?php if ($admin->type == 1): ?>
	            	<th>Hành động</th>
	            <?php endif ?>
	          </tr>
	        </thead>

	        <tbody>
	        	<?php foreach ($list_admin as $value): ?>
	        		<tr>
			            <td><?php echo $value->fullname?></td>
			            <td><?php echo $value->username?></td>
			            <td><?php echo date('H:i d/m/Y',$value->create_time) ?></td>
			            <td><?php echo $this->user_model->get_info($value->create_by)->username?></td>
			            <?php if ($admin->type == 1): ?>
			            	<td style="text-align: center; width: 80px">
				            	<a class="btn btn-xs btn-danger" onclick="del_admin(<?php echo $value->id?>)">Xóa</a>
				            </td>
			            <?php endif ?>
		          	</tr>
	        	<?php endforeach ?>
	        </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
	</div>
</div>
<style type="text/css">
	td{
		vertical-align: middle !important;
	}
</style>
<script type="text/javascript">
	function del_admin(id){
		var r = confirm("Bạn có chắc chắn muốn xóa quản trị viên này?");
	    if (r == true) {
	        window.location.href = "<?php echo admin_url('admin/del/')?>" + id;
	    }
	}
</script>