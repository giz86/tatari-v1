$(document).ready(function(){			
	
	$("#basic_info").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$('.icon-spinner3').show();
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&data=basic_info&type=basic_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.icon-spinner3').hide();
					$('.save').prop('disabled', false);
				} else {
					toastr.success(JSON.result);
					$('.icon-spinner3').hide();
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
	

	$("#f_profile_picture").submit(function(e){
		var fd = new FormData(this);
		$('.icon-spinner3').show();
		var user_id = $('#user_id').val();
		var session_id = $('#session_id').val();
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 2);
		fd.append("type", 'profile_picture');
		fd.append("data", 'profile_picture');
		fd.append("form", action);
		e.preventDefault();
		$('.save').prop('disabled', true);
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.icon-spinner3').hide();
					$('.save').prop('disabled', false);
				} else {
					toastr.success(JSON.result);
					$('#remove_file').show();
					$('.icon-spinner3').hide();
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$("#remove_profile_picture").attr('checked', false);
					$('#u_file').attr("src", JSON.img);
					if(user_id == session_id){
						$('.user_avatar').attr("src", JSON.img);
					}
					$('.save').prop('disabled', false);
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('.icon-spinner3').hide();
				$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
				$('.save').prop('disabled', false);
			} 	        
	   });
	});
	

	$("#profile_background").submit(function(e){
		var fd = new FormData(this);
		$('.icon-spinner3').show();
		var user_id = $('#user_id').val();
		var session_id = $('#session_id').val();
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 2);
		fd.append("type", 'profile_background');
		fd.append("data", 'profile_background');
		fd.append("form", action);
		e.preventDefault();
		$('.save').prop('disabled', true);
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.icon-spinner3').hide();
					$('.save').prop('disabled', false);
				} else {
					toastr.success(JSON.result);
					$('#remove_file').show();
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.icon-spinner3').hide();
					$("#remove_profile_picture").attr('checked', false);
					$('#u_file').attr("src", JSON.img);
					if(user_id == session_id){
						$('.user_avatar').attr("src", JSON.img);
					}
					$('.save').prop('disabled', false);
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
				$('.icon-spinner3').hide();
				$('.save').prop('disabled', false);
			} 	        
	   });
	});
		

	
	$(".nav-tabs-link").click(function(){
		var profile_id = $(this).data('profile');
		var profile_block = $(this).data('profile-block');
		$('.nav-tabs-link').removeClass('active');
		$('.current-tab').hide();
		$('#user_profile_'+profile_id).addClass('active');
		$('#'+profile_block).show();
	});
	
	$(".salary-tab").click(function(){
		var profile_id = $(this).data('profile');
		var profile_block = $(this).data('profile-block');
		$('.salary-tab-list').removeClass('active');
		$('.salary-current-tab').hide();
		$('#suser_profile_'+profile_id).addClass('active');
		$('#'+profile_block).show();
	});

	
	
	jQuery("#e_change_password").submit(function(e){	
	e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		$('.icon-spinner3').show();
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=31&data=e_change_password&type=change_password&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.icon-spinner3').hide();
					jQuery('.save').prop('disabled', false);
				} else {
					toastr.success(JSON.result);
					$('.icon-spinner3').hide();
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					jQuery('#e_change_password')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
		
});	

$(document).ready(function(){
	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
	
	if($('#change_pass').val()=='true'){
		$('.current-tab').hide();
		$('.nav-tabs-link').removeClass('active');
		$('#change_password').show();
		$('#user_profile_14').addClass('active');
	}
		
	$('.cont_date').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: '1850:' + (new Date().getFullYear() + 10),
	});	
	
});