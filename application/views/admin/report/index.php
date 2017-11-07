<div class="row">
	<div class="row tile_count">
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-eye"></i> Tổng lượt xem trang</span>
			<div class="count"><?php echo explode('-', $view)[0] ?></div>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		    <a href="<?php echo admin_url('admin') ?>"><span class="count_top"><i class="fa fa-user"></i> Admin</span></a>
		    <a href="<?php echo admin_url('admin') ?>"><div class="count green"><?php echo $total_admin ?></div></a>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		    <a href="<?php echo admin_url('product') ?>"><span class="count_top"><i class="fa fa-product-hunt"></i> Sản phẩm</span></a>
		    <a href="<?php echo admin_url('product') ?>"><div class="count red"><?php echo ($total_product) ?></div></a>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		    <a href="<?php echo admin_url('catalog') ?>"><span class="count_top"><i class="fa fa-bars"></i> Danh mục</span></a>
		    <a href="<?php echo admin_url('catalog') ?>"><div class="count blue"><?php echo $total_catalog ?></div></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Top sản phẩm xem nhiều</h2>
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
				<select class="form-control" id="top_product" onchange="load_ajax()">
					<option value="10">Top 10</option>
					<option value="20">Top 20</option>
					<option value="30">Top 30</option>
				</select>
				<div id="result" style="margin-top: 20px">
					<?php $this->load->view('admin/report/top_product')?>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('admin/report/count')?>
	
</div>

<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	function load_ajax(){
		var valueSelect = $("#top_product").val();

        $.ajax({
            url : "<?php echo admin_url(); ?>" + "report/",
            type : "post",
            dataType:"text",
            data : {
                top: valueSelect
            },
            success : function (result){
                $('#result').html(result);
            }
        });
    }
</script>
