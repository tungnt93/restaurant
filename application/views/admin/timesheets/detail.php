
<?php $this->load->view('admin/timesheets/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Bảng chấm công tháng <?php echo $month->month_name?></h2>
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
        <div class="table-timesheet dragscroll" style="width: 100%; overflow-x: scroll;">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <tr>
                <th rowspan="3">STT</th>
                <th rowspan="3" style="min-width: 150px;">Họ và tên</th>
                <th rowspan="3" style="min-width: 150px">Vị trí</th>
                <th colspan="<?php echo $month->total_day?>">Ngày trong tháng</th>
                <th rowspan="3">Tổng cộng</th>
            </tr>
            <tr>
                <?php for($i = 1; $i <= $month->total_day; $i++){ ?>
                    <td><?php echo $i ?></td>
                <?php }?>
            </tr>
            <tr>
                <?php
                    $arrDay = ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'];
                    for($i = 0; $i < $month->total_day; $i++){ ?>
                        <td><?php echo $arrDay[($month->start_day - 1 + $i)%7] ?></td>
                <?php }?>
            </tr>
            <?php
            $stt = 0;
            foreach ($timesheet_by_department as $row){ ?>
                <tr>
                    <td colspan="<?php echo $month->total_day + 4?>" class="text-left bg-td" onclick="console.log()">
                        <?php echo $this->department_model->get_info($row->department_parent)->name?>
                    </td>
                </tr>
                <?php
                foreach ($row->timesheets as $timesheet){
                    $stt++;
                    $total = 0;
                    ?>
                    <tr>
                        <td><?php echo $stt?></td>
                        <td><?php echo $this->employee_model->get_info($timesheet->employee_id)->name?></td>
                        <td><?php echo $this->department_model->get_info($timesheet->department_id)->name?></td>
                        <?php for($i = 0; $i < $month->total_day; $i++){
                            $total += $timesheet->working_times[$i];
                            $val = $timesheet->working_times[$i] == 2 ? '+' : ($timesheet->working_times[$i] == 1 ? '-' : '');
                            ?>
                            <td class="td-timesheet td-timesheet-<?php echo $timesheet->working_times[$i]?> td-timesheet-<?php echo $month->id.'-'.$timesheet->employee_id.'-'.$i?>"
                                onclick="editTimesheet(<?php echo $month->id ?>, <?php echo $timesheet->employee_id?>, <?php echo $i?>)">
                                <div class="div-timesheet-<?php echo $month->id.'-'.$timesheet->employee_id.'-'.$i?>">
                                    <?php echo $val ?>
                                </div>
                                <input type="text"
                                       style="width: 30px; display: none; background-color: transparent;"
                                       class="input-timesheet input-timesheet-<?php echo $month->id.'-'.$timesheet->employee_id.'-'.$i?>"
                                       value="<?php echo $val?>" >
                            </td>
                        <?php }?>
                        <td class="<?php echo 'total-'.$month->id.'-'.$timesheet->employee_id ?>"><?php echo floatval($total/2)?></td>
                    </tr>
                <?php } ?>
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
    .td-timesheet-1{
        background-color: lightgray;
    }
    .td-timesheet-0{
        background-color: burlywood;
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

    function editTimesheet(month_id, employee_id, day_index) {
        $('.table-timesheet').removeClass('dragscroll');
        var input = $('.input-timesheet-'+month_id+'-'+employee_id+'-'+day_index);
        var div = $('.div-timesheet-'+month_id+'-'+employee_id+'-'+day_index);
        input.show();
        div.hide();
        var val = input.val();
        input.val('');
        input.val(val);
        input.focus();
        input.focusout(function () {
            var working_times = input.val();
            console.log(val !== working_times);
            if(val !== working_times){
                if(working_times === '+' || working_times === '-' || working_times === ''){
                    $('#loading').show();
                    working_times = working_times === '+' ? 2 : (working_times === '-' ? 1 : 0);
                    updateTimeSheet(month_id, employee_id, day_index, working_times, input, div)
                }
                else{
                    input.val(val);
                }
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
    function updateTimeSheet(month_id, employee_id, day_index, working_times, input, div) {
        $.ajax({
            url : "<?php echo admin_url('timesheets/update'); ?>",
            type : "post",
            dataType:"text",
            data : {
                month_id: month_id,
                employee_id: employee_id,
                day_index: day_index,
                working_times: working_times,
            },
            success : function (result){
                console.log(result);
                if(result){
                    result = JSON.parse(result);
                    var val = result.working_times === '2' ? '+' : result.working_times === '1' ? '-' : '';
                    div.html(val);
                    input.val(val);
                    var divBg = $('.td-timesheet-'+ month_id + '-' + employee_id + '-' + day_index);
                    divBg.removeClass('td-timesheet-0');
                    divBg.removeClass('td-timesheet-1');
                    divBg.removeClass('td-timesheet-2');
                    divBg.addClass('td-timesheet-'+ result.working_times);
                    $('.total-' + month_id + '-' + employee_id).html(result.total);
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
