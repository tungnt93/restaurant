
<div class="x_panel">
	<div class="x_title">
		<h2>Danh sách sản phẩm</h2>
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
	            <th><input type="checkbox" id="check-all" class="flat"></th>
	            <th>Mã số</th>
	            <th>Tên sản phẩm</th>
	            <th>Ảnh sản phẩm</th>
	            <th>Danh mục</th>
	            <th>Giá</th>
	            <th>Ngày tạo</th>
	            <th>Hành động</th>
	          </tr>
	        </thead>

	        <tbody>
	        	<?php foreach ($list_product as $value): ?>
	        		<tr>
			            <td><input type="checkbox" id="check-all" class="flat"></td>
			            <td><?php echo $value->id?></td>
			            <td>
			            	<a href="#">
			            		<b style="color: #000"><?php echo $value->name ?></b><br>
			            		<p>
			            		Lượt xem: <?php echo $value->view ?><br>
			            		<?php if(in_array($value->id, $list_hot_id)){ ?>
			            			<span class="label label-danger">Nổi bật</span>
			            		<?php }?>
			            		<?php if ($value->is_hot == 1): ?>
			            			<span class="label label-warning">Hot</span>
			            		<?php endif ?>
			            		<?php if ($value->discount > 0): ?>
			            			<span class="label label-info">Giảm giá</span>
			            		<?php endif ?>
			            		</p>
			            	</a>
			            </td>
			            <td width="100px"><img src="<?php echo base_url('public/images/product/'.$value->img_link)?>" height="100px"></td>
			            <td><?php echo $this->catalog_model->get_info($value->catalog_id)->name ?></td>
			            <td>
			            	<?php if ($value->discount > 0): ?>
			            		<b style="color: red"><?php echo number_format($value->price - $value->discount) ?>đ</b>
			            		<p style="text-decoration:line-through"><?php echo number_format($value->price)?>đ</p>
			            	<?php else: ?>
			            		<b style="color:red"><?php echo number_format($value->price)?>đ</b>
			            	<?php endif ?>
			            </td>
			            <td><?php echo date('H:i d/m/Y',$value->create_time) ?></td>
			            <td style="text-align: center;" class="action">
			            	<a target="_blank" href="<?php echo base_url('san-pham/'.create_slug($value->name).'-'.$value->id.'.html')?>" data-toggle="tooltip" title="Xem chi tiết"><i class="fa fa-eye" aria-hidden="true"></i></a>
			            	<a href="<?php echo admin_url('product/edit/'.$value->id) ?>"  title="Sửa thông tin sản phẩm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			            	<a onclick="confirm_del_product(<?php echo $value->id?>)"  title="Xóa sản phẩm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
			            	<?php if (in_array($value->id, $list_hot_id)): ?>
			            		<a onclick="remove_hot(<?php echo $value->id ?>)"  title="Xóa khỏi danh sách sản phẩm nổi bật" style="color: #EC971F"><i class="fa fa-star" aria-hidden="true"></i></a>
			            	<?php else: ?>
			            		<a onclick="add_hot(<?php echo $value->id ?>)" title="Thêm vào danh sách sản phẩm nổi bật"><i class="fa fa-star-o" aria-hidden="true"></i></a>
			            	<?php endif ?>
			            	
			            </td>
		          	</tr>
	        	<?php endforeach ?>
	        </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
	</div>
</div>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$("#datatable-product").dataTable();
	});
	

	function confirm_del_product(id){
		var r = confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
	    if (r == true) {
	        window.location.href = "<?php echo admin_url('product/del/')?>" + id;
	    }
	}
</script>