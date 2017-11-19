<div class="x_panel" style="margin-top: 20px">
    <div class="x_title">
        <h2>Sao chép thực đơn</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
        <div class="form-horizontal form-label-left">
            <div class="form-inline">
                <div class="form-group">
                    <label>Chọn ngày:</label>
                    <input type="text" class="form-control" id="txtDateCopy">
                </div>
                <input type="submit" class="btn btn-success" id="btnCopyMenu" value="Sao chép" style="margin-top: 6px"/>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#btnCopyMenu').click(function () {
            var date = $('#txtDate').val();
            var dateCopy = $('#txtDateCopy').val();
            if(!moment(date, "DD-MM-YYYY", true).isValid()){
                alert('Ngày không hợp lệ');
            }
            else if(!moment(dateCopy, "DD-MM-YYYY", true).isValid()){
                alert('Ngày sao chép không hợp lệ');
            }
            else if(date === dateCopy){
                alert('Không thể sao chép. Ngày sao chép trùng ngày đang chọn');
            }
            else{
                $.ajax({
                    url : "<?php echo admin_url('kitchen/copyMenu'); ?>",
                    type : "post",
                    dataType:"text",
                    data : {
                        date: date,
                        dateCopy: dateCopy
                    },
                    success : function (result){
                        if(result){
                            $('#tb_daily_menu').html(result);
                        }
                    }
                });
            }

        });
    });
</script>