
<?php $this->load->view('admin/warehouse/header')?>
<div class="x_panel">
	<div class="x_title">
		<h2>Danh sách</h2>
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
		<table id="datatable-catalog" class="table table-striped table-bordered bulk_action">
	        <thead>
	          <tr>
	            <th>Tên</th>
	            <th>Số lượng</th>
	            <th>Đơn giá</th>
	            <th>Ngày nhập</th>
	            <th>Người nhập</th>
	            <th>Hành động</th>
	          </tr>
	        </thead>

	        <tbody>
	        	<?php foreach ($warehouses as $key => $value) {
	        	    $food = $this->food_model->get_info($value->food_id);
	        	    ?>
	        		<tr>
			            <td><?php echo $food->name?></td>
			            <td><?php echo $value->quantity.' '.$food->dram ?></td>
			            <td><?php echo $value->price ?>đ</td>
			            <td><?php echo date('H:i d/m/Y',$value->created)?></td>
			            <td><?php echo $this->admin_model->get_info($value->create_by)->fullname?></td>
			            <td>
			            	<a href="<?php echo admin_url('warehouse/edit/'.$value->id)?>" class="btn btn-xs btn-primary">Sửa</a>
			            	<a onclick="delCatalog(<?php echo $value->id?>)" class="btn btn-xs btn-danger">Xóa</a>
			            </td>
		          	</tr>
	        	<?php }?>
	        </tbody>
        </table>
        <!-- <div class="btn btn-danger">Xóa danh mục đã chọn</div> -->
	</div>
</div>
<script type="text/javascript">
    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        } 
    }
</script>
