
<section class="col-xs-12 product-content clearfix">
    <h1 class="title clearfix"><span>Đặt bàn</span></h1>
    <div class="product-block product-grid clearfix" style="margin-top: 50px">
        <div class="x_content bs-example-popovers" id="message">

        </div>
        <div class="form-horizontal" method="post">
            <div class="form-group">
                <label class="col-sm-2 control-label">Họ tên</label>
                <div class="col-sm-4 col-xs-12">
                    <input class="form-control" class="focusedInput" name="txtName" id="txtName" required type="text" value="Tung" placeholder="Nhập họ tên">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Số điện thoại</label>
                <div class="col-sm-4 col-xs-12">
                    <input class="form-control" class="focusedInput" name="txtPhone" id="txtPhone" required type="text"Tung value="01666202390" placeholder="Nhập số điện thoại">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Số người</label>
                <div class="col-sm-4 col-xs-12">
                    <input class="form-control" class="focusedInput" name="txtNumber" id="txtNumber" required type="number" value="6" placeholder="Nhập số người">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Thời gian</label>
                <!-- <div class="col-sm-2 col-xs-12">
                    <input class="form-control" class="focusedInput" name="txtHour" required type="text" placeholder="Nhập giờ">
                </div> -->
                <div class="col-sm-4 col-xs-12">
                    <input class="form-control" id="txtDateBook" class="focusedInput" name="txtTime" value="29-11-2017 12:00 AM" required type="text" placeholder="Nhập thời gian">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tin nhắn</label>
                <div class="col-sm-4 col-xs-12">
                    <textarea class="form-control" class="focusedInput" name="txtMessage" id="txtMessage" required rows="5" type="text" placeholder="Nhập tin nhắn"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                  <input type="submit" class="btn btn-default" name="btnBook" id="btnBook" value="Đặt bàn"/>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $('#txtDateBook').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePickerIncrement: 30,
            autoApply: true,
            format: 'DD-MM-YYYY h:mm A'
        }).on('hide.daterangepicker', function (ev, picker) {
            picker.startDate.format('DD-MM-YYYY h:mm A');

        });

        $('#btnBook').click(function(){
            // alert(1);
            var txtName = $('#txtName').val();
            var txtPhone = $('#txtPhone').val();
            var txtNumber = $('#txtNumber').val();
            var txtTime = $('#txtDateBook').val();
            var txtMessage = $('#txtMessage').val();
            console.log(txtTime);
            // console.log($('#txtDateBook').data('daterangepicker').startDate);
            if(txtName == null) alert('Bạn chưa nhập Họ tên');
            else if(txtPhone == null) alert('Bạn chưa nhập Số điện thoại');
            else if(txtNumber == null) alert('Bạn chưa nhập số người');
            else if(txtTime == null) alert('Bạn chưa nhập thời gian');
            else{
                $.ajax({
                    url : "<?php echo base_url('home/actionBook'); ?>",
                    type : "post",
                    dataType:"text",
                    data : {
                        txtName: txtName,
                        txtPhone: txtPhone,
                        txtNumber: txtNumber,
                        txtTime: txtTime,
                        txtMessage: txtMessage
                    },
                    success : function (result){
                        console.log(result);
                        if(result > 0){
                            $('#message').html(
                                '<div class="alert alert-success alert-dismissible fade in" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeMessage()"><span aria-hidden="true">×</span></button>' +
                                '<strong>Thông báo: </strong> Đặt bàn thành công!'+
                                '</div>'
                            );
                            socket.emit('BOOK_TABLE', result);
                        }
                        else{
                            $('#message').html(
                                '<div class="alert alert-success alert-dismissible fade in" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
                                '<strong>Thông báo: </strong> Đặt bàn thất bại, vui lòng thử lại!'+
                                '</div>'
                            );
                        }
                    }
                });
            }
        });
    });

    function closeMessage() {
        $('#message').empty();
    }
</script>
