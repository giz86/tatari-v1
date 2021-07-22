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
      <span class="logo-mini"><b><img alt="ታ" src="" class="brand-logo" style="width:32px;"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img alt="ታ" src="" class="brand-logo" style="width:32px;"> <b>TATARI</b></span>
    
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
		 
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" title="Configurations">
                  <i class="fa fa-qrcode"></i>
                </a>
              </li>
       
         
           <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" title="My Profile">
              <i class="glyphicon glyphicon-user"></i>
            </a>
            <ul class="dropdown-menu">
              	<li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/profile');?>"> <i class="ion ion-person"></i>My Profile</a></li>
                 
                  <?php if(in_array('60',$role_resources_ids)) { ?>
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href=""> <i class="ion ion-settings"></i>Settings</a></li>
                  <?php } ?>
                  
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/profile?change_password=true');?>"> <i class="fa fa-key"></i>Change Password</a></li>
                  <li class="divider"></li>
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href=""> <i class="fa fa-lock"></i>Lock User</a></li>
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/logout');?>"> <i class="fa fa-power-off text-red"></i>Sign Out</a></li>
                </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar" title="Layout Settings"><i class="fa fa-cog fa-spin"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
