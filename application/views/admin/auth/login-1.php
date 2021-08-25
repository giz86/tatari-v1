<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $company = $this->Tat_model->read_company_setting_info(1);?>
<?php $site_lang = $this->load->helper('language');?>
<?php $current_lang = $site_lang->session->userdata('site_lang');?>
<?php $favicon = base_url().'uploads/logo/favicon/fav1.png'?>

<?php
$session = $this->session->userdata('username');
if(!empty($session)){ 
	redirect('admin/dashboard/');
}
?>

<?php
$session = $this->session->userdata('username');
if($system[0]->enable_auth_background!='yes'):
	$auth_bg = 'style="background-image: none;"';
else:
	$auth_bg = '';	
endif;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Tatari | Log In</title>
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
<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/tat_login_1.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font2.css">
</head>

<body 
<?php 
echo $auth_bg;
?>
>

<img id="tatload-img" src="<?php echo base_url()?>assets/images/loading.gif" style="">
<style type="text/css">
#tatload-img {
    display: none;
    z-index: 87896969;
    float: right;
    margin-right: 25px;
    margin-top: 0px;
}
</style>

    <!-- Start Preloader -->
    <!-- Preloader End -->
    <div class="container-fluid">
      <div class="row">
        <div class="authfy-container col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
          <div class="col-sm-5 authfy-panel-left">
            <div class="brand-col">
              <div class="headline">
                <!-- brand-logo start -->
                <div class="brand-logo">
                  <img src="<?php echo base_url();?>uploads/logo/tatari_1.png ?>" alt="ታታሪ" width="200" height="200s">
                </div><!-- ./brand-logo -->
                <!-- <p>Tatari System Prototype</p> -->
              </div>
            </div>
          </div>
          <div class="col-sm-7 authfy-panel-right">
            <!-- authfy-login start -->
            <div class="authfy-login">
              <!-- panel-login start -->
              
              
              <div class="authfy-panel panel-login text-center active">
                <div class="authfy-heading">
                  <h3 class="auth-title">LogIn to Tatari System</h3>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <?php $attributes = array('class' => 'form-tatari', 'name' => 'tat-form', 'id' => 'tat-form', 'data-redirect' => 'dashboard',
					'data-form-table' => 'login', 'data-is-redirect' => '1', 'autocomplete' => 'off');?>
					<?php $hidden = array('user_id' => 0);?>
                    <?php echo form_open('admin/auth/login', $attributes, $hidden);?>
              
						<div class="form-group">
                        <input type="text" id="iusername" name="iusername" class="form-control" placeholder="Username" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <div class="pwdMask">
                          <input type="password" class="form-control" id="ipassword" name="ipassword" placeholder="Password" autocomplete="off">
                        </div>
                      </div>
                      <!-- start remember-row -->
                      <div class="row remember-row">
                        <div class="col-xs-6 col-sm-6">
                          &nbsp;
                        </div>
                        <div class="col-xs-6 col-sm-6">
                          <p class="forgotPwd">
                            <a href="<?php echo site_url('admin/auth/forgot_password');?>" class="lnk-toggler"><?php echo $this->lang->line('tat_forgot_password_link');?></a>
                          </p>
                        </div>
                      </div> <!-- ./remember-row -->
                      <div class="form-group">
                        <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => 'btn btn-primary btn-block btn-lg save', 'content' => '<i class="fa fa-lock"></i> Log In')); ?>
                      </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div> <!-- ./panel-login -->
            </div>
          </div>
        </div>
      </div> <!-- ./row -->
    </div> <!-- ./container -->	
   

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
var processing_request = '<?php echo $this->lang->line('tat_processing_request');?>';</script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/scripts/tat_login.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
$(".login-as").click(function(){
		var uname = jQuery(this).data('username');
		var password = jQuery(this).data('password');
		jQuery('#iusername').val(uname);
		jQuery('#ipassword').val(password);
	});
});	
</script>
</body>
</html>