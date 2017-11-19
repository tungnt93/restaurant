
<?php $this->load->view('admin/payroll/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Bảng lương tháng <?php echo $month->month_name?></h2>
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
        <div class="table-timesheet" style="width: 100%; overflow-x: scroll;">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Họ và tên</th>
                <th rowspan="2">Vị trí</th>
                <th rowspan="2">Lương chính (đ)</th>
                <th rowspan="2" style="width: 120px">Số ngày công<br>/Tổng công trong tháng</th>
                <th colspan="3">Phụ cấp</th>
                <th rowspan="2">Tổng cộng (đ)</th>
            </tr>
            <tr>
                <td style="width: 100px">Tiền ăn (đ)</td>
                <td style="width: 100px">Điện thoại (đ)</td>
                <td style="width: 100px">Xăng xe (đ)</td>
            </tr>
            <?php
            $stt = 0;
            foreach ($payroll_by_department as $row){ ?>
                <tr>
                    <td colspan="9?>" class="text-left bg-td">
                        <?php echo $this->department_model->get_info($row->department_parent)->name?>
                    </td>
                </tr>
                <?php foreach ($row->payrolls as $payroll){
                    $stt++;
//                    $total_money =
                    ?>
                    <tr>
                        <td><?php echo $stt?></td>
                        <td><?php echo $this->employee_model->get_info($payroll->employee_id)->name?></td>
                        <td><?php echo $this->department_model->get_info($payroll->department_id)->name?></td>
                        <td><?php echo $payroll->wage?></td>
                        <td><?php echo $payroll->total_working.'/'.$month->total_day?></td>
                        <td onclick="editAllowance(<?php echo $payroll->id ?>, 'lunch_allowance')">
                            <div class="<?php echo 'div-allowance-'.$payroll->id.'-lunch_allowance' ?>" >
                                <?php echo $payroll->lunch_allowance?>
                            </div>
                            <input type="number" style="width: 80px; display: none"
                                   class="<?php echo 'allowance-'.$payroll->id.'-lunch_allowance' ?>"
                                   value="<?php echo $payroll->lunch_allowance?>">
                        </td>
                        <td onclick="editAllowance(<?php echo $payroll->id ?>, 'tel_allowance')">
                            <div class="<?php echo 'div-allowance-'.$payroll->id.'-tel_allowance' ?>" >
                                <?php echo $payroll->tel_allowance?>
                            </div>
                            <input type="number" style="width: 80px; display: none"
                                   class="<?php echo 'allowance-'.$payroll->id.'-tel_allowance' ?>"
                                   value="<?php echo $payroll->tel_allowance?>">
                        </td>
                        <td onclick="editAllowance(<?php echo $payroll->id ?>, 'travel_allowance')">
                            <div class="<?php echo 'div-allowance-'.$payroll->id.'-travel_allowance' ?>" >
                                <?php echo $payroll->travel_allowance?>
                            </div>
                            <input type="number" style="width: 80px; display: none"
                                   class="<?php echo 'allowance-'.$payroll->id.'-travel_allowance' ?>"
                                   value="<?php echo $payroll->travel_allowance?>">
                        </td>
                        <td class="<?php echo 'total-'.$payroll->id ?>">
                            <?php echo $payroll->total_money?>
                        </td>
                    </tr>
                <?php }?>
            <?php }?>
        </table>
        </div>
    </div>
</div>

<style>
    td, th{
        vertical-align: middle !important;
        text-align: center;
        border: 1px solid #dddddd;
        padding: 8px;
    }
    .text-left{
        text-align: left;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: #000;
    }
    .bg-td{
        background-color: #deeeee;
    }
</style>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        }
    }

    function editAllowance(payroll_id, type) {
        var input = $('.allowance-'+payroll_id + '-' + type);
        var div = $('.div-allowance-'+payroll_id + '-' + type);
        input.show();
        div.hide();
        var val = input.val();
        input.val('');
        input.val(val);
        input.focus();
        input.focusout(function () {
            var money = input.val();
            if(val !== money){
                $('#loading').show();
                update(payroll_id, money, type, input, div)
            }
            input.hide();
            div.show();
        });
        input.keypress(function(e) {
            if(e.which === 13) {
                input.focusout();
            }
        });
    }
    function update(payroll_id, money, type, input, div) {
        $.ajax({
            url : "<?php echo admin_url('payroll/update'); ?>",
            type : "post",
            dataType:"text",
            data : {
                payroll_id: payroll_id,
                money: money,
                type: type
            },
            success : function (result){
                console.log(result);
                if(result){
                    result = JSON.parse(result);
                    div.html(result.money);
                    input.val(result.money);
                    $('.total-' + payroll_id).html(result.total);
                }
                else{
                    console.log('Có lỗi xảy ra, vui lòng thử lại');
                }
                setTimeout(function () {
                    $('#loading').hide();
                }, 500);
            }
        });
    }

</script>
