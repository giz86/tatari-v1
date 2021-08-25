$(document).ready(function() {
	var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
		"ajax": {
            url : base_url+"/transaction_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
    });
});