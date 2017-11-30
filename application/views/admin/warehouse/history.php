
<?php $this->load->view('admin/warehouse/header')?>
<div class="row form-group form-horizontal form-label-left" style="margin: 10px 0px">
    <label class="control-label col-md-1 col-sm-6 col-xs-12" for="first-name">Chọn loại</label>
    <div class="col-md-2 col-sm-3 col-xs-12">
        <select class="form-control" name="slType" id="slType">
            <option value="1">Kho thực phẩm</option>
            <option value="2">Dụng cụ nhà bếp</option>
            <option value="3">Dụng cụ quầy bar</option>
        </select>
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
    <div class="x_content" id="tb-history">
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
            <?php foreach ($imports as $key => $value){
                if($value->type == 1){
                    $item = $this->food_model->get_info($value->item_id);
                }
                else if($value->type == 2 || $value->type == 3){
                    $item = $this->utensils_model->get_info($value->item_id);
                }?>
                <tr>
                    <td><?php echo $item->name?></td>
                    <td><?php echo $value->quantity.' '?><?php echo $value->type == 1 ? $item->dram : 'Chiếc'?></td>
                    <td><?php echo $value->price ?>đ</td>
                    <td><?php echo date('H:i d/m/Y',$value->created)?></td>
                    <td><?php echo $this->employee_model->get_info($value->create_by)->name?></td>
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

<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#slType').change(function () {
           var type = $(this).val();
            $.ajax({
                url : "<?php echo admin_url('warehouse/getHistoryByType'); ?>",
                type : "post",
                dataType:"text",
                data : {
                    type: type
                },
                success : function (result){
                    if(result){
                        $('#tb-history').html(result);
                    }
                }
            });
        });
    });

    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        }
    }

</script>
