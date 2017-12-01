<!-- jQuery -->
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Bootstrap -->
<script src="<?php echo admin_theme()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo admin_theme()?>src/js/my.js"></script>
<!-- FastClick -->
<script src="<?php echo admin_theme()?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo admin_theme()?>vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo admin_theme()?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo admin_theme()?>vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo admin_theme()?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo admin_theme()?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo admin_theme()?>vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo admin_theme()?>vendors/Flot/jquery.flot.js"></script>
<script src="<?php echo admin_theme()?>vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo admin_theme()?>vendors/Flot/jquery.flot.time.js"></script>
<script src="<?php echo admin_theme()?>vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo admin_theme()?>vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo admin_theme()?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo admin_theme()?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo admin_theme()?>vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo admin_theme()?>vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo admin_theme()?>vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo admin_theme()?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo admin_theme()?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo admin_theme()?>vendors/moment/min/moment.min.js"></script>
<script src="<?php echo admin_theme()?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo admin_theme()?>build/js/custom.min.js"></script>

<!-- Flot -->
<!-- datatable -->
<script src="<?php echo admin_theme();?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo admin_theme();?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo admin_theme('');?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo admin_theme('');?>vendors/pdfmake/build/vfs_fonts.js"></script>

<!--<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>-->
<!--<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />-->
<script src="<?php echo admin_theme('src/js/socket.js');?>"></script>
<script>
    var socket = io("http://localhost:3000");
    socket.on('SERVER_SEND', function(data){

    });
    socket.on('CHANGE_TABLE', function(data){
        $.ajax({
            url : "<?php echo admin_url('table/list_table'); ?>",
            type : "post",
            dataType:"text",
            success : function (result){
                if(result){
                    $('#list-table').html(result);
                }
            }
        });
    });

    socket.on('ADD_ORDER', function(data){
        $.ajax({
            url : "<?php echo admin_url('table/getQueue'); ?>",
            type : "post",
            dataType:"text",
            success : function (result){
                if(result){
                    $('#table-queue').html(result);
                }
            }
        });
    });

    socket.on('CHANGE_ORDER', function(table_id){
        $.ajax({
            url : "<?php echo admin_url('table/getQueue'); ?>",
            type : "post",
            dataType:"text",
            success : function (result){
                if(result){
                    $('#table-queue').html(result);
                }
            }
        });
        $.ajax({
            url : "<?php echo admin_url('table/getOrderByTable'); ?>",
            type : "post",
            dataType:"text",
            data : {
                table_id: table_id,
            },
            success : function (result){
                if(result){
                    $('#list-order-in-table-'+table_id).html(result);
                }
            }
        });
    });

    socket.on('BOOK_TABLE', function (book_id) {

    });

    $(document).ready(function() {
        socket.emit('CLIENT_SEND', 'test');
        $('#tb-payment').dataTable({});
//        $('#txtBirthday').daterangepicker({
//            singleDatePicker: true,
//            calender_style: "picker_4",
//            locale: {
//                format: 'DD-MM-YYYY'
//            }
//        }, function(start, end, label) {
//            console.log(start.toISOString(), end.toISOString(), label);
//        });

//        $('#txtStartDate').daterangepicker({
//            singleDatePicker: true,
//            calender_style: "picker_4",
//            locale: {
//                format: 'DD-MM-YYYY'
//            }
//        }, function(start, end, label) {
//            console.log(start.toISOString(), end.toISOString(), label);
//        });

        $('input[name="txtBirthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: 'DD-MM-YYYY'
        });

        $('input[name="txtStartDate"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: 'DD-MM-YYYY'
        });

//        $('#txtDate').daterangepicker({
//            singleDatePicker: true,
//            showDropdowns: true,
//            format: 'DD-MM-YYYY'
//        });

        $('input[name="txtMonth"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            format: 'MM/YYYY'
        }).on('hide.daterangepicker', function (ev, picker) {
            $('.table-condensed tbody tr:nth-child(2) td').click();
            picker.startDate.format('MM/YYYY');
        });

        $( function() {
            $('#txtDate').datepicker( {
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy',
            });
            $('#txtDateCopy').datepicker( {
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy',
            });
        });



    });
</script>

<script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
