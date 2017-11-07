<a id="addSlide" class="btn btn-primary">Thêm slide</a><br><br>
<div id="form_add_slide" style="border: 1px solid #dedede; padding: 20px; margin-bottom: 20px; display: none;">
    <form method="post" action="" enctype="multipart/form-data">
        <div><input type="file"  id="slideUpload" name="slideUpload" accept="image/*"></div>
        <div style="margin: 20px 0px">
            <img id="pre_img" style="width: 150px" />
        </div>
        <div>
            <input type="submit" id="btnAddSlide" name="btnAddSlide" required="required" class="btn btn-info" value="Thêm">
            <a class="btn btn-danger" id="cancelAddSlide">Hủy</a>
        </div>    
    </form>
</div>
<table id="" class="table table-striped table-bordered bulk_action">
<thead>
  <tr>
    <th><input type="checkbox" id="check-all" class="flat"></th>
    <th>STT</th>
    <th>Hình ảnh</th>
    <th>Hành động</th>
  </tr>
</thead>

<tbody>
    <?php foreach ($list_slider as $key => $value): ?>
        <tr>
            <td><input type="checkbox" id="check-all" class="flat"></td>
            <td><?php echo $key + 1 ?></td>
            <td><img src="<?php echo public_url('images/slide/'.$value);  ?>" width="300px"></td>
            <td><a onclick="delSlide(<?php echo $key ?>)" class="btn btn-danger">Xóa</a></td>
        </tr>
    <?php endforeach ?>
</tbody>
</table>
<style type="text/css">
    th, td{
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<script type="text/javascript">
    function delSlide(pos){
        var r = confirm("Bạn có chắc chắn muốn xóa slide này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('content/delSlide/')?>" + pos;
        } 
    }
</script>