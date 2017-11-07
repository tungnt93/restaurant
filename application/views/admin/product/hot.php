<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="page-title">
	<div class="title_left"><h3>Sản phẩm</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('product/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('product')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>

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
			            		
			            		<a class="btn btn-xs btn-warning">Hot</a> 
			            		Lượt xem: <?php echo $value->view ?>
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
			            	<a href="#" data-toggle="tooltip" title="Xem chi tiết"><i class="fa fa-eye" aria-hidden="true"></i></a>
			            	<a href="<?php echo admin_url('product/edit/'.$value->id) ?>" data-toggle="tooltip" title="Sửa thông tin sản phẩm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			            	<a onclick="confirm_del_product(<?php echo $value->id?>)" data-toggle="tooltip" title="Xóa sản phẩm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
			            	<a href="" data-toggle="tooltip" title="Xóa khỏi danh sách sản phẩm hot" style="color: #EC971F"><i class="fa fa-star" aria-hidden="true"></i></a>
			            </td>
		          	</tr>
	        	<?php endforeach ?>
	        </tbody>
        </table>
        <a href="#" class="btn btn-danger">Xóa đã chọn </a>
	</div>
</div>
<style type="text/css">
	td{
		vertical-align: middle !important;
	}
	.action a{
		font-size: 22px;
		display: block;
		cursor: pointer;
	}
</style>
<script type="text/javascript">
	function confirm_del_product(id){
		var r = confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
	    if (r == true) {
	        window.location.href = "<?php echo admin_url('product/del/')?>" + id;
	    }
	}
</script>