<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="page-title">

    <div class="title_left"><h3>Thông tin order</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="<?php echo admin_url('table/order') ?>" class="btn btn-info btn-sm">Danh sách</a>
            <?php if(isset($table)){ ?>
                <a href="<?php echo admin_url('table/payment/'.$table->id) ?>" class="btn btn-danger btn-sm">Thanh toán</a>
            <?php }?>
        </div>
    </div>

</div>