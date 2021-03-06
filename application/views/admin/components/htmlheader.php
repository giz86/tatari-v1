<?php $company = $this->Tat_model->read_company_setting_info(1);?>

<?php $favicon = base_url().'uploads/logo/favicon/'.$company[0]->favicon;?>


<?php $theme = $this->Tat_model->read_theme_info(1);?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title;?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="icon" type="image/x-icon" href="<?php echo $favicon;?>" >
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/Ionicons/css/ionicons.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
<?php if($theme[0]->theme_option == 'template_1'):?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/AdminLTE.min.css">
<?php elseif($theme[0]->theme_option == 'template_2'):?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/skins/_all-skins-template2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/AdminLTE_Template2.min.css">
<?php else:?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/css/AdminLTE.min.css">
<?php endif;?>
<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/morris.js/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/jvectormap/jquery-jvectormap.css">
<!-- Date Picker -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/plugins/iCheck/all.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/jquery-ui/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/toastr/toastr.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/kendo/kendo.common.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/kendo/kendo.default.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/Trumbowyg/dist/ui/trumbowyg.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/clockpicker/dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/animate.css">
<?php if($theme[0]->theme_option == 'template_1'):?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/tat_custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/aux_tatari.css">
<?php elseif($theme[0]->theme_option == 'template_2'):?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari_template2/tat_custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari_template2/aux_tatari.css">
<?php else:?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/tat_custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/aux_tatari.css">
<?php endif;?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/tat_itatari.css">
<?php if($this->router->fetch_class() =='chat'){?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/tat_tatari_chat.css">
<?php } ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/switch.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/css/tatari/tat_tatari_custom.css">

<!-- Google Poppins TransFont -->
<link rel="stylesheet" href="<?php echo base_url();?>/assets/fonts/font1.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/tatari_assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php if($this->router->fetch_class() =='roles') { ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/kendo/kendo.common.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/tatari_assets/vendor/kendo/kendo.default.min.css">
<?php } ?>
</head>