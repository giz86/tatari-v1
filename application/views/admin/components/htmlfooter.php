<?php $session = $this->session->userdata('username'); ?>
<?php $company = $this->Tat_model->read_company_setting_info(1);?>
<?php $user = $this->Tat_model->read_user_info($session['user_id']); ?>
<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $theme = $this->Tat_model->read_theme_info(1);?>
<?php 
$this->load->view('admin/components/vendors/del_dialog');
?>
<!-- jQuery 3 -->
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/vendor/jquery/jquery-3.2.1.min.js"></script> 
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
  
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>assets/tatari_assets/vendor/bootstrap-select/bootstrap-select.js"></script>
<script src="<?php echo base_url();?>assets/tatari_assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url();?>assets/tatari_assets/vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/vendor/Trumbowyg/dist/trumbowyg.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/vendor/toastr/toastr.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- App -->
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/js/adminlte.min.js"></script>
<?php if($theme[0]->theme_option == 'template_1'):?>
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/js/demo.js"></script>
<?php else:?>
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/dist/js/demo_template2.js"></script>
<?php endif;?>
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/tatari_assets/theme_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">var user_role = '<?php //echo $user[0]->user_role_id;?>';</script>
<script type="text/javascript">var user_session_id = '<?php echo $session['user_id'];?>';</script>
<script type="text/javascript">var js_date_format = '<?php echo $this->Tat_model->set_date_format_js();?>';</script>
<script type="text/javascript">var site_url = '<?php echo site_url(); ?>admin/';</script>
<script type="text/javascript">var base_url = '<?php echo site_url().'admin/'.$this->router->fetch_class(); ?>';</script>
<script type="text/javascript">var processing_request = '<?php echo $this->lang->line('tat_processing_request');?>';</script>
<script type="text/javascript">var request_submitted = '<?php echo $this->lang->line('tat_hr_request_submitted');?>';</script>
<script src="<?php echo base_url();?>assets/tatari_assets/js/bootstrap-checkbox.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	toastr.options.closeButton = <?php echo $system[0]->notification_close_btn;?>;
	toastr.options.progressBar = <?php echo $system[0]->notification_bar;?>;
	toastr.options.timeOut = 3000;
	toastr.options.showMethod = 'slideDown';
	toastr.options.hideMethod = 'slideUp';
	toastr.options.preventDuplicates = true;
	toastr.options.positionClass = "<?php echo $system[0]->notification_position;?>";
   // setTimeout(refreshChatMsgs, 5000);
   $('[data-toggle="popover"]').popover();
});
function escapeHtmlSecure(str)
{
	var map =
	{
		'alert': '&lt;',
		'313': '&lt;',
		'bzps': '&lt;',
		'<': '&lt;',
		'>': '&gt;',
		'script': '&lt;',
		'html': '&lt;',
		'php': '&lt;',
	};
	return str.replace(/[<>]/g, function(m) {return map[m];});
}	
</script>
<script type="text/javascript">
$(document).ready(function(){
	
	/*  Toggle Starts   */
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
	$('.js-switch:checkbox').checkboxpicker();
	$('.date').datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat:'yy-mm-dd',
	yearRange: '1900:' + (new Date().getFullYear() + 15),
	beforeShow: function(input) {
		$(input).datepicker("widget").show();
	}
	});
});
</script>

<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/tatari_assets/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/tatari_assets/scripts/'.$path_url.'.js'; ?>"></script>

<?php if($this->router->fetch_class() =='dashboard') { ?>
	<?php if($system[0]->is_ssl_available=='yes'){?>
	<script src="<?php echo base_url();?>assets/tatari_assets/scripts/user/set_clocking_ssl.js"></script>
    <?php } else {?>
    <script src="<?php echo base_url();?>assets/tatari_assets/scripts/user/set_clocking_non_ssl.js"></script>
    <?php } ?>
<?php } ?>

<?php if($user[0]->user_role_id==1 && $this->router->fetch_class() =='dashboard'):?>
	<!-- Department and Designation Pie Charts -->
    <script src="<?php echo base_url();?>assets/tatari_assets/vendor/charts/chart.min.js" type="text/javascript"></script>    
    <script src="<?php echo base_url();?>assets/tatari_assets/scripts/xchart/employee_department.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/tatari_assets/scripts/xchart/employee_designation.js" type="text/javascript"></script>
<?php endif; ?>

<script>
  function testAnim(x) {
    $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
  };

  $(document).ready(function(){
    $('.js--triggerAnimation').click(function(e){
      e.preventDefault();
      var anim = $('.js--animations').val();
      testAnim(anim);
    });

    $('.js--animations').change(function(){
      var anim = $(this).val();
      testAnim(anim);
    });
  });
</script>
