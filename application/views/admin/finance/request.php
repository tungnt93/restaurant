
<div class="page-title">
	<div class="title_left"><h3>Yêu cầu mua sắm</h3></div>
</div>
<div class="row col-xs-12">
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
            <?php $this->load->view('admin/finance/table_request')?>
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

    function confirm(request_id, status){
        $.ajax({
            url : "<?php echo admin_url('finance/confirm_request'); ?>",
            type : "post",
            dataType:"text",
            data : {
                request_id: request_id,
                status: status
            },
            success : function (result){
                if(result){
                    $('#tb-request').html(result);
                }
            }
        });
    }

    function reject(request_id){

    }
</script>
