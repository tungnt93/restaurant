<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="page-title">
	<div class="title_left"><h3>Nhân viên</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('employee/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('employee')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>

<div class="x_panel">
	<div class="x_title">
		<h2>Danh sách nhân viên</h2>
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
	            <th>Mã số</th>
	            <th>Họ tên</th>
	            <th>Số điện thoại</th>
	            <th>Địa chỉ</th>
	            <th>Vị trí</th>
	            <th>Mức lương</th>
	            <th>Ngày gia nhập</th>
	            <th>Hành động</th>
	          </tr>
	        </thead>

	        <tbody>
	        	<?php foreach ($employees as $value): ?>
	        		<tr>
			            <td><?php echo $value->id?></td>
			            <td><?php echo $value->name?></td>
			            <td><?php echo $value->phone?></td>
			            <td><?php echo $value->address?></td>
			            <td><?php echo $this->department_model->get_info($value->department_id)->name?></td>
                        <td><?php echo $value->wage?></td>
                        <td><?php echo $value->start_date ?></td>
                        <td style="text-align: center; width: 80px">
                            <a class="btn btn-xs btn-danger" onclick="del_admin(<?php echo $value->id?>)">Xóa</a>
                        </td>
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