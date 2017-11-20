<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
	<div class="title_left"><h3>Thông tin kho</h3></div>
	<div class="title_right">
		<div class="col-md-9 col-sm-9 col-xs-12 pull-right">
			<a href="<?php echo admin_url('warehouse/add')?>" class="btn btn-primary btn-sm">Nhập kho</a>
			<a href="<?php echo admin_url('warehouse')?>" class="btn btn-info btn-sm">Danh sách</a>
			<a href="<?php echo admin_url('warehouse/history')?>" class="btn btn-success btn-sm">Lịch sử</a>
		</div>
	</div>
</div>
<!--<div class="row form-group form-horizontal form-label-left" style="margin: 10px 0px">-->
<!--    <label class="control-label col-md-1 col-sm-6 col-xs-12" for="first-name">Chọn loại</label>-->
<!--    <div class="col-md-2 col-sm-3 col-xs-12">-->
<!--        <select class="form-control" name="slType" id="slType">-->
<!--            <option value="1">Kho thực phẩm</option>-->
<!--            <option value="2">Dụng cụ nhà bếp</option>-->
<!--        </select>-->
<!--    </div>-->
<!--</div>-->