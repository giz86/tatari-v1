$(document).ready(function() {
	$('#tat_table').DataTable( {
   	"ajax": {
            url : base_url+"/account_balances_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}
    } );
} );