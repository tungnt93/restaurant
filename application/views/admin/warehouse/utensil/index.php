<div>
<div class="page-title">
	<div class="title_left"><h3>Thông tin</h3></div>
</div>
<div class="row col-xs-12">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
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
                    <table id="datatable-foods" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Số lượng</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($utensils as $key => $value) {?>
                            <tr>
                                <td><?php echo $value->name?></td>
                                <td><?php echo $value->quantity.' chiếc'?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?php if ($message){$this->load->view('admin/message',$this->data); }?>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Yêu cầu mua sắm</h2>
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
                    <form class="form-horizontal form-label-left" method="post">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Chọn dụng cụ</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_multiple form-control" name="slItem" id="slItem">
                                    <option value="-1" ></option>
                                    <?php foreach ($utensils as $key => $value) { ?>
                                        <option value="<?php echo $value->name?>" ><?php echo $value->name?></option>
                                    <?php } ?>
                                    <option value="0" >Dụng cụ mới</option>
                                </select>
                            </div>
                        </div>
                        <div class="divUtensils"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Số lượng</label>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="txtQuantity" name="txtQuantity" placeholder="Số lượng" value="" required="required" class="form-control col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mô tả</label>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <textarea rows="3" name="txtDescription" style="width: 100%" placeholder="Nhập mô tả"></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px">
                            <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" style="width: 70px">
                                <input type="submit" id="btnAdd" name="btnAdd" required="required" class="btn btn-success" value="Gửi">
                            </div>
                        </div>
                    </form>
                    <table id="" class="table table-striped table-bordered bulk_action" style="margin-top: 30px">
                        <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($requests as $key => $value) {?>
                            <tr>
                                <td><?php echo $value->item_name?></td>
                                <td><?php echo $value->quantity.' chiếc'?></td>
                                <td><?php echo $value->status == 1 ? 'Đang chờ duyệt' : ($value->status == 2 ? 'Đã duyệt' : 'Đã hủy')  ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#slItem').change(function () {
        if($(this).val() === '0'){
            $('.divUtensils').append(
                '<div class="form-group">' +
                '<label class="control-label col-md-3 col-sm-3 col-xs-12">Nhập tên<span class="required">*</span></label>' +
                '<div class="col-md-9 col-sm-9 col-xs-12">' +
                '<input type="text" id="txtNewUtensils" name="txtNewUtensils" value="" required class="form-control col-md-7 col-xs-12">' +
                '</div>' +
                '</div>'
            );
        }
        else {
            $('.divUtensils').empty();
        }
    });


});
</script>
