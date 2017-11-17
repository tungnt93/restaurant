<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">
    <div class="title_left"><h3>Bảng chấm công</h3></div>
    <div class="title_right">
        <div class="col-md-7 col-sm-7 col-xs-12 pull-right">
            <a href="<?php echo admin_url('timesheets/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('timesheets')?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>