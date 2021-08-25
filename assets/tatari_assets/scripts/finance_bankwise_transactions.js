$(document).ready(function() {
	var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
		"ajax": {
            url : base_url+"/bankwise_transactions_list/"+$('#current_segment').val(),
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
    });
});