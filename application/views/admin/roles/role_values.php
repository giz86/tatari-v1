<script type="text/javascript">

	jQuery("#treeview_r1").kendoTreeView({
		checkboxes: {
		checkChildren: true,
		template: "<label><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'> #= item.text #</label>"
		},

		check: onCheck,
	dataSource: [

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_organization');?>", add_info: "", value:"2", items: [
	
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_company');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "5",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "5",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "246",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "247",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "248",},
	]},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_department');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "3",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "3",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "240",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "241",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "242",}
	]},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_designation');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "4",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "4",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "243",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "244",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "245",},
	{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_designation').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "249",}
	]},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_location');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "6",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "6",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "250",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "251",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "252",},	
	]},

]}, 	
	
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('let_staff');?>",  add_info: "", value: "103",  items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('dashboard_employees');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "13",  items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "13",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "201",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_edit');?>", value: "202",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_delete');?>", value: "203",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_view_company_emp_title');?>",  add_info: "<?php echo $this->lang->line('tat_view_company_emp_title');?>", value: "372",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_view_location_emp_title');?>",  add_info: "<?php echo $this->lang->line('tat_view_location_emp_title');?>", value: "373",}
	]},


		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_set_employees_salary');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "351"},
		
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_employees_directory');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "88"},
		
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_employees_last_login');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "22"}
	]},

	//
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_hr');?>",  add_info: "", value: "12",  items: [
	
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_transfers');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "15",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "15",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "210",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "211",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "212",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_transfers').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "233",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_resignations');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "16",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "16",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "213",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "214",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "215",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_resignations').'</small>';?>",  add_info: "<?php echo $this->lang->line('left_resignations');?>", value: "234",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_manager_level_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_manager_level_title');?>", value: "406"},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_hrd_level_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_hrd_level_title');?>", value: "407"},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_gm_om_level_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_gm_om_level_title');?>", value: "408"}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_promotions');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "18",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "18",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "219",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "220",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "221",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_promotions').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "236",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_complaints');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "19",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "19",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "222",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "223",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "224",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_complaints').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "237",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_warnings');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "20",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "20",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "225",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "226",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "227",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_warnings').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "238",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_terminations');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "21",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "21",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "228",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "229",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "230",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_terminations').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "239",}
		]}
	]},
	
	

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_attendances');?>",  add_info: "", value: "27",  items: [

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "28", items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "28",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_timesheet').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "397",},
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_month_timesheet_title');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "10", items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "10",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('tat_month_timesheet_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "253",},
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_date_wise_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "29",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "29",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_date_wise_attendance').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "381",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_update_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "30",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "30",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "277",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "278",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "279",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_upd_company_attendance').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "310",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_overtime_request');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "401", items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "401"},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "402"},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "403"},
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_import_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_attendance_import');?>", value: "31",},
	
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_office_shifts');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "7",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "7",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "280",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "281",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "282",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_change_default');?>",  add_info: "<?php echo $this->lang->line('tat_role_change_default');?>", value: "2822",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_office_shifts').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "311",}
		]},

		{	 id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_leaves');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "46",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "46",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "287",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "288",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "289",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_leaves').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "290",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_1st_level_approval').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "286",},
		{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_2nd_level_approval').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "312",}
		]},	

	]},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_payroll');?>",  add_info: "", value: "32",  items: [
	
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_generate_payslip');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "36",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "36",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "313",},
	{ id: "", class: "role-checkbox", text: "<?php echo '<small>'.$this->lang->line('tat_role_generate_company_payslips').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "314",}
	]},

	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_payment_history');?>",  add_info: "<?php echo $this->lang->line('tat_view_payslip');?>", value: "37", check: "<?php if(isset($_GET['role_id'])) { if(in_array('37',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "37", check: "<?php if(isset($_GET['role_id'])) { if(in_array('37',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_payment_history').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "391", check: "<?php if(isset($_GET['role_id'])) { if(in_array('391',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_payroll_verifier_title');?>",  add_info: "<?php echo $this->lang->line('tat_payroll_verifier_title');?>", value: "404"},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_payroll_approver_title');?>",  add_info: "<?php echo $this->lang->line('tat_payroll_approver_title');?>", value: "405"},

	]},
    
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_vacancy');?>",  add_info: "", value: "48",  items: [
	
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_job_posts');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "49",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "49",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "291",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "292",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "293",}
		]},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_jobs_listing');?> <small><?php echo $this->lang->line('left_frontend');?></small>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "50"},

		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_job_candidates');?>",  add_info: "<?php echo $this->lang->line('tat_update_status_delete');?>", value: "51",items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "51",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_dwn_resume');?>",  add_info: "<?php echo $this->lang->line('tat_role_dwn_resume');?>", value: "294",},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_delete');?>", value: "295",}
		]},

	]},




		{ id: "", class: "role-checkbox",text: "<?php echo $this->lang->line('tat_hr_report_title');?>", add_info: "",value: "110",  items: [
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_hr_reports_payslip');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "111"},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_hr_reports_attendance_employee');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "112"},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_hr_report_employees');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "117"},
		{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_hr_report_leave_report');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "409"},
		]},
	
	]
	});
	
	jQuery("#treeview_r2").kendoTreeView({
	checkboxes: {
	checkChildren: true,
	template: "<label><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'> #= item.text #</label>"
	},

	check: onCheck,
	dataSource: [


	{ id: "", class: "role-checkbox",text: "<?php echo $this->lang->line('tat_acc_accounts');?>", add_info: "",value: "71",  items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_account_list');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "72",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "72",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "352",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "353",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "354",}
	]},

	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_account_balances');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "73",},
	]},


	{ id: "", class: "role-checkbox",text: "<?php echo $this->lang->line('tat_acc_payees_payers');?>", add_info: "",value: "79",  items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_payees');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "80",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "80",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "364",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "365",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "366",}
	]},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_payers');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "81",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "81",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "367",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "368",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "369",}
	]},
	]},


	{ id: "", class: "role-checkbox",text: "<?php echo $this->lang->line('tat_acc_transactions');?>", add_info: "",value: "74",  items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_deposit');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "75",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "75",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "355",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "356",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "357",}
	]},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_expense');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "76",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "76",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "358",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "359",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "360",}
	]},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_transfer');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "77",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "77",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "361",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "362",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "363",}
	]},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_view_transactions');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "78",},
	]},
	
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_invoices');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "87",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_invoices_title');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "121",items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "121",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_create');?>",  add_info: "<?php echo $this->lang->line('tat_role_create');?>", value: "120",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "328",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "329",}
	]},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_invoice_payments');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "330",},
	]},
	
	{ id: "", class: "role-checkbox",text: "<?php echo $this->lang->line('tat_acc_reports');?>", add_info: "",value: "82",  items: [
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_account_statement');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "83"},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_expense_reports');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "84",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_income_reports');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "85",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_acc_transfer_report');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "86",},
	]},
	


	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_system');?>",  add_info: "", value: "57",  items: [
	
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_settings');?>",  add_info: "<?php echo $this->lang->line('tat_view_update');?>", value: "60",},
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_constants');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "61",},
    { id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('left_db_backup');?>",  add_info: "<?php echo $this->lang->line('tat_create_delete_download');?>", value: "62",},
	]},
	
	{ id: "", class: "role-checkbox", text: "<?php echo $this->lang->line('tat_theme_settings');?>",  add_info: "<?php echo $this->lang->line('tat_theme_settings');?>", value: "94",},


	]
	});

function onCheck() {
var checkedNodes = [],
		treeView = jQuery("#treeview2").data("kendoTreeView"),
		message;
		jQuery("#result").html(message);
}
</script>