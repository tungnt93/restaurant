<!-- jQuery -->
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
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
<script src="<?php echo admin_theme('');?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/pdfmake/build/vfs_fonts.js"></script>

<script>
    $(document).ready(function() {
        $('#txtBirthday').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtStartDate').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
