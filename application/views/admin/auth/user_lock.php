<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $site_lang = $this->load->helper('language');?>
<?php $wz_lang = $site_lang->session->userdata('site_lang');?>
<?php $company = $this->Tat_model->read_company_setting_info(1);?>
<?php $session = $this->session->userdata('username');?>


<?php

if($system[0]->enable_auth_background=='yes'):
	$auth_bg = 'style="background-position: center center; background-size: cover; background-image: url('.base_url().'assets/images/5.png");"';
else:
	$auth_bg = '';	
endif;
?>


<?php
$session_id = $this->session->userdata('user_id');
$iresult = $this->Login_model->read_user_info_session_id($session_id['user_id']);
?>
<?php $favicon = base_url().'uploads/logo/favicon/'.$company[0]->favicon;?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Tatari | <?php echo $title; ?></title>


<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="icon" type="image/x-icon" href="<?php echo $favicon;?>">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/AdminLTE.min.css">
<!-- toastr -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/toastr/toastr.min.css">
<!-- animate -->
<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/animate.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->


<!-- Google Font -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font2.css">

</head>
<body class="hold-transition login-page" <?php echo $auth_bg;?>>
<img id="tatload-img" src="<?php echo base_url()?>assets/img/loading.gif" style="">
<style type="text/css">
#tatload-img {
    display: none;
    z-index: 87896969;
    float: right;
    margin-right: 25px;
    margin-top: 0px;
}
</style>
<div class="login-box animated fadeInDownBig"> 
  

  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-yellow">
          <div class="widget-user-image">
            <?php  if($iresult[0]->profile_picture!='' && $iresult[0]->profile_picture!='no file') {?>
              <img src="<?php  echo base_url().'uploads/profile/'.$iresult[0]->profile_picture;?>" alt="unlock-user" class="img-circle">
              <?php } else {?>
              <?php  if($iresult[0]->gender=='Male') { ?>
              <?php 	$de_file = base_url().'uploads/profile/default_male.png';?>
              <?php } else { ?>
              <?php 	$de_file = base_url().'uploads/profile/default_female.png';?>
              <?php } ?>
              <img src="<?php  echo $de_file;?>" alt="unlock-user" class="img-circle">
              <?php  } ?>
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username"><?php echo $iresult[0]->first_name;?> <?php echo $iresult[0]->last_name;?></h3>
        </div>
        

      </div>
    <p class="login-box-msg"><?php echo $this->lang->line('tat_unlock_user_account');?></p>
    <?php $attributes = array('name' => 'tat-form', 'id' => 'tat-form', 'class' => 'form-tatari', 'autocomplete' => 'off');?>
	<?php $hidden = array('_method' => 'forgott_pass');?>
    <?php echo form_open('admin/auth/unlock/', $attributes, $hidden);?>

    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="ipassword" id="ipassword" placeholder="<?php echo $this->lang->line('tat_login_enter_password');?>"><?php echo $this->lang->line('tat_user_not_you');?>
          <a href="<?php echo site_url('admin/logout');?>"><?php echo $this->lang->line('tat_user_logged_different');?></a>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
    <div class="row">
      <!-- /.col -->
      <div class="col-xs-12"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat save', 'content' => '<i class="fa fa-unlock"></i> '.$this->lang->line('tat_hr_unlock'))); ?> </div>
      <!-- /.col --> 
    </div>
    <?php echo form_close(); ?>
    <hr>


    <div class="lockscreen-footer text-center">
      <?php if($system[0]->enable_current_year=='yes'):?>
      <?php echo date('Y');?>
      <?php endif;?>
      © Tatari System
      <?php if($system[0]->enable_page_rendered=='yes'):?>
      - <?php echo $this->lang->line('tat_page_rendered_text');?> <strong>{elapsed_time}</strong> seconds.
      <?php endif; ?>
    </div>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 


<!-- jQuery 3 --> 
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/jquery/dist/jquery.min.js"></script> 
<!-- Bootstrap 3.3.7 --> 
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 

<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/vendor/jquery/jquery-3.2.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/vendor/toastr/toastr.min.js"></script> 

<script type="text/javascript">
$(document).ready(function(){
	toastr.options.closeButton = <?php echo $system[0]->notification_close_btn;?>;
	toastr.options.progressBar = <?php echo $system[0]->notification_bar;?>;
	toastr.options.timeOut = 3000;
	toastr.options.preventDuplicates = true;
	toastr.options.positionClass = "<?php echo $system[0]->notification_position;?>";
	var site_url = '<?php echo site_url(); ?>';
});
</script> 

<script type="text/javascript">
var site_url = '<?php echo base_url(); ?>';
var processing_request = '<?php echo $this->lang->line('tat_processing_request');?>';
</script> 

<script type="text/javascript">
$(document).ready(function(){
	toastr.options.closeButton = true;
	toastr.options.progressBar = true;
	toastr.options.timeOut = 3000;
	toastr.options.positionClass = "toast-top-center";
	
	$("#tat-form").submit(function(e){
	e.preventDefault();
		$('#tatload-img').show();
		toastr.info(processing_request);
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&add_type=forgot_password&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.clear();
					$('#tatload-img').hide();
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					toastr.clear();
					$('#tatload-img').hide();
					toastr.success(JSON.result);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					window.location = site_url+'admin/dashboard?module=dashboard';
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});
</script>
</body>
</html>