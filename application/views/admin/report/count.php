<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Thống kê truy cập</h2>
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
			<?php $count = explode('-', $view) ?>

			<article class="media event">
              <a class="pull-left date">
                <p class="month">Total</p>
              </a>
              <div class="media-body">
                <a class="title">Tổng lượt truy cập</a>
                <p><?php echo $count[0] ?></p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">
                	<?php 
                		$lastday = date("N"); 
                		switch ($lastday) {
                			case 1:
                				echo 'Sun';
                				break;
                			case 2:
                				echo 'Mon';
                				break;
                			case 3:
                				echo 'Tue';
                				break;
                			case 4:
                				echo 'Wed';
                				break;
                			case 5:
                				echo 'Thu';
                				break;
                			case 6:
                				echo 'Fri';
                				break;
                			case 7:
                				echo 'Sat';
                				break;
                		}
                	?>	
                </p>
                <p class="day"><?php echo (date("d")-1 < 10) ? '0'.(date("d")-1) : date("d")-1 ?></p>
              </a>
              <div class="media-body">
                <a class="title">Số lượt truy cập hôm qua</a>
                <p><?php echo $count[4] ?></p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month"><?php echo date("D") ?></p>
                <p class="day"><?php echo date("d") ?></p>
              </a>
              <div class="media-body">
                <a class="title">Số lượt truy cập hôm nay</a>
                <p><?php echo $count[6] ?></p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">Month</p>
                <p class="day"><?php echo (date("m")-1 < 10) ? '0'.(date("m")-1) : date("m")-1 ?></p>
              </a>
              <div class="media-body">
                <a class="title">Số lượt truy cập tháng trước</a>
                <p><?php echo $count[1] ?></p>
              </div>
            </article>
            <article class="media event">
              <a class="pull-left date">
                <p class="month">Month</p>
                <p class="day"><?php echo date("m") ?></p>
              </a>
              <div class="media-body">
                <a class="title">Số lượt truy cập tháng này</a>
                <p><?php echo $count[3] ?></p>
              </div>
            </article>
		</div>
	</div>
</div>
<style type="text/css">
	.event .media-body p{
		color: red;
		font-weight: bold;
	}
</style>