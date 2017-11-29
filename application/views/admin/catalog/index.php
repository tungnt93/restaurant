
<?php $this->load->view('admin/catalog/header')?>
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
	            <th><input type="checkbox" id="check-all" class="flat"></th>
	            <th>Mã số</th>
	            <th>Ảnh minh họa</th>
	            <th>Tên</th>
				<th>Trạng thái</th>
	            <th>Thứ tự hiển thị</th>
	            <th>Hành động</th>
	          </tr>
	        </thead>

	        <tbody>
	        	<?php foreach ($list_catalog as $key => $value) { ?>
	        		<tr>
			            <td><input type="checkbox" id="check-all" class="flat"></td>
			            <td><?php echo $value->id?></td>
			            <td><img src="<?php echo public_url('images/menu/'.$value->img)?>" style="max-width: 150px"></td>
			            <td><?php echo $value->name?></td>
						<td><?php echo $value->status == 1 ? 'Hiển thị' : 'Ẩn'?></td>
			            <td><?php echo $value->position?></td>
			            <td>
			            	<a href="<?php echo admin_url('catalog/edit/'.$value->id)?>" class="btn btn-xs btn-primary">Sửa</a>
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
        if (r == true) {
            window.location.href = "<?php echo admin_url('catalog/del/')?>" + id;
        }
    }
</script>
