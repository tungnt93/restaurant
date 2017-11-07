<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('site/head');?>
</head>
<body>
	<?php $this->load->view('site/header');?>
	<div class="container" id="main-content">
		<div class="row">
			<?php $this->load->view($temp);?>
		</div>
	</div>
	<?php $this->load->view('site/footer');?>
	<div id="back_to_top"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></div>
</body>
</html>