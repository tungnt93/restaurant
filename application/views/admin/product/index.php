<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
	<div class="title_left"><h3>Món ăn</h3></div>
	<div class="title_right">
		<div class="col-md-9 col-sm-9 col-xs-12 pull-right">
			<a href="<?php echo admin_url('product/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('product')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>
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
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th><input type="checkbox" id="check-all" class="flat"></th>
                <th>Mã số</th>
                <th>Tên món</th>
                <th>Ảnh minh họa</th>
                <th>Menu</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($list_product as $value): ?>
                <tr>
                    <td><input type="checkbox" id="check-all" class="flat"></td>
                    <td><?php echo $value->id?></td>
                    <td><?php echo $value->name?></td>
                    <td><img src="<?php echo public_url('images/product/'.$value->img_link)?>" style="max-width: 150px"></td>
                    <td><?php echo $this->catalog_model->get_info($value->catalog_id)->name?></td>
                    <td><?php echo number_format($value->price)?>đ</td>
                    <td>
                        <a href="<?php echo admin_url('product/edit/'.$value->id)?>" class="btn btn-xs btn-primary">Sửa</a>
                        <a onclick="delCatalog(<?php echo $value->id?>)" class="btn btn-xs btn-danger">Xóa</a>
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
	.action a{
		font-size: 22px;
		display: block;
		cursor: pointer;
	}
</style>
