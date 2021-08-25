<?php
$session = $this->session->userdata('username');
$system = $this->Tat_model->read_setting_info(1);
$company_info = $this->Tat_model->read_company_setting_info(1);
$user = $this->Tat_model->read_employee_info($session['user_id']);
?>

<?php
$role_user = $this->Tat_model->read_user_role_info($user[0]->user_role_id);
if(!is_null($role_user)){
	$role_resources_ids = explode(',',$role_user[0]->role_resources);
} else {
	$role_resources_ids = explode(',',0);	
}
?>

<?php $site_lang = $this->load->helper('language');?>
<?php $wz_lang = $site_lang->session->userdata('site_lang');?>
<?php
if(!empty($wz_lang)):
	$lang_code = $this->Tat_model->get_language_info($wz_lang);
	$flg_icn = '<i class="fa fa-globe"></i>';
elseif($system[0]->default_language!=''):
	$lang_code = $this->Tat_model->get_language_info($system[0]->default_language);
	$flg_icn = '<i class="fa fa-globe"></i>';
else:
	$flg_icn = '<i class="fa fa-globe"></i> ';	
endif;
?>

<style type="text/css">
.main-header .sidebar-toggle-tatari-chat:before {
	content: "\f0e6";
}
.main-header .sidebar-toggle-tatari-quicklinks:before {
	content: "\f00a";
}
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('admin/dashboard/');?>" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img alt="tatari" src="<?php echo base_url();?>uploads/logo/fav1.png ?>" class="brand-logo" style="width:32px;"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img alt="tatari" src="<?php echo base_url();?>uploads/logo/tat-big.png ?>" class="brand-logo" style="width:140px;"> <b></b></span>
    
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" title="Sidebar">
        <span class="sr-only">Toggle navigation</span>
      </a>
     
       <?php  if($user[0]->user_role_id=='1'){?>
          <a href="javascript:void(0);" class="sidebar-toggle sidebar-toggle-tatari-quicklinks" role="button" data-toggle="modal" data-target=".modal-tatariapps" title="Quick Links">	</a>
        <?php } ?>  
            
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">    
          
        <?php if($system[0]->module_language=='true'){?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" title="<?php echo $this->lang->line('tat_languages');?>">
                <i class="fa fa-language"> </i> <?php echo $this->lang->line('tat_lang');?>
                </a>
                <ul class="dropdown-menu ">
                <?php $languages = $this->Tat_model->all_languages();?>
				        <?php foreach($languages as $lang):?>
              
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/dashboard/set_language/').$lang->language_code;?>"><i class="fa fa-globe"></i><?php echo $lang->language_name;?></a></li>
                  <?php endforeach;?>
                </ul>
              </li>
            <?php } ?>  


           <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" title="My Profile">
              <i class="glyphicon glyphicon-user"></i>
            </a>
            <ul class="dropdown-menu">
              	<li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/profile');?>"> <i class="ion ion-person text-green"></i>My Profile</a></li>
                  
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/profile?change_password=true');?>"> <i class="fa fa-key text-yellow"></i><?php echo $this->lang->line('header_change_password');?></a></li>
                  <li class="divider"></li>
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/auth/lock');?>"> <i class="fa fa-lock text-purple"></i><?php echo $this->lang->line('tat_lock_user');?></a></li>
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/logout');?>"> <i class="fa fa-power-off text-red"></i><?php echo $this->lang->line('header_sign_out');?></a></li>
                  </ul>
                </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
