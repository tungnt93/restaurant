<?php foreach ($tables as $row){ ?>
    <a href="<?php echo admin_url('table/order/'.$row->id)?>" class="col-md-2" style="text-align: center; margin: 10px 0px">
        <div class="table-order" data-toggle="tooltip" title="<?php echo $row->status == 3 ? $row->customer.', '.date('h:i d/m/Y', $row->time) : ''?>">
            <i class="fa <?php echo $row->status == 2 ? 'fa-cutlery' : ( $row->status == 3 ? 'fa-clock-o' : 'fa-plus')?>" aria-hidden="true"></i>
            <br>
            <h4 class="table-name"><?php echo $row->name?></h4>
        </div>

    </a>
<?php } ?>