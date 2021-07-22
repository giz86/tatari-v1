$(document).ready(function() {
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' }); 
	jQuery("#filter_company").change(function(){
		jQuery.get(escapeHtmlSecure(site_url+"employees/filter_company_flocations/"+jQuery(this).val()), function(data, status){
			jQuery('#location_ajaxflt').html(data);
		});
	});
});