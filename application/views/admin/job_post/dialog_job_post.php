<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['job_id']) && $_GET['data']=='job'){
?>

<?php
$all_job_types = $this->Tat_model->get_job_type();
$cresult = $this->Department_model->all_departments();
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_edit_job');?></h4>
</div>

<?php $attributes = array('name' => 'edit_job', 'id' => 'edit_job', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $job_id, 'ext_name' => $job_title);?>
<?php echo form_open('admin/job_post/update/'.$job_id, $attributes, $hidden);?>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
       
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="title"><?php echo $this->lang->line('tat_e_details_jtitle');?></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_jtitle');?>" name="job_title" type="text" value="<?php echo $job_title;?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="job_type"><?php echo $this->lang->line('tat_job_type');?></label>
              <select class="form-control" name="job_type" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_job_type');?>">
                <option value=""></option>
                <?php foreach($all_job_types->result() as $job_type) {?>
                <option value="<?php echo $job_type->job_type_id?>" <?php if($job_type_id==$job_type->job_type_id):?> selected="selected" <?php endif;?>><?php echo $job_type->type;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group">
              <label for="dept_id"><?php echo $this->lang->line('tat_department');?></label>
              <select class="form-control" name="dept_id" id="dept_id" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_department');?>">
                <option value=""><?php echo $this->lang->line('tat_select_one');?></option>
                <?php foreach($cresult as $department) {?>
                <option value="<?php echo $department->department_id?>" <?php if($department->department_id==$dept_id):?> selected="selected"<?php endif;?>><?php echo $department->department_name;?></option>
                <?php } ?>
              </select>
            </div>
            </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="vacancy"><?php echo $this->lang->line('tat_number_of_positions');?></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_number_of_positions');?>" name="vacancy" type="text" value="<?php echo $job_vacancy;?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="is_featured"><?php echo $this->lang->line('tat_job_is_featured');?></label>
              <select class="form-control" name="is_featured" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_job_is_featured');?>">
                <option value="1" <?php if($is_featured=='1'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_yes');?></option>
                <option value="0" <?php if($is_featured=='0'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_no');?></option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="status"><?php echo $this->lang->line('dashboard_tat_status');?></label>
              <select class="form-control" name="status" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('dashboard_tat_status');?>">
                <option value="1" <?php if($status=='1'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_published');?></option>
                <option value="2" <?php if($status=='2'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_unpublished');?></option>
              </select>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="date_of_closing" class="control-label"><?php echo $this->lang->line('tat_date_of_closing');?></label>
              <input class="form-control e_date" placeholder="<?php echo $this->lang->line('tat_date_of_closing');?>" readonly="true" name="date_of_closing" type="text" value="<?php echo $date_of_closing;?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="gender"><?php echo $this->lang->line('tat_employee_gender');?></label>
              <select class="form-control" name="gender" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_gender');?>">
                <option value="0" <?php if($gender=='0'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_gender_male');?></option>
                <option value="1" <?php if($gender=='1'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_gender_female');?></option>
                <option value="2" <?php if($gender=='2'):?> selected <?php endif;?>><?php echo $this->lang->line('tat_job_no_preference');?></option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="experience" class="control-label"><?php echo $this->lang->line('tat_job_minimum_experience');?></label>
              <select class="form-control" name="experience" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_job_minimum_experience');?>">
                <option value="0" <?php if($minimum_experience=='0'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_fresh');?></option>
                <option value="1" <?php if($minimum_experience=='1'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_1year');?></option>
                <option value="2" <?php if($minimum_experience=='2'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_2years');?></option>
                <option value="3" <?php if($minimum_experience=='3'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_3years');?></option>
                <option value="4" <?php if($minimum_experience=='4'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_4years');?></option>
                <option value="5" <?php if($minimum_experience=='5'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_5years');?></option>
                <option value="6" <?php if($minimum_experience=='6'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_6years');?></option>
                <option value="7" <?php if($minimum_experience=='7'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_7years');?></option>
                <option value="8" <?php if($minimum_experience=='8'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_8years');?></option>
                <option value="9" <?php if($minimum_experience=='9'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_9years');?></option>
                <option value="10" <?php if($minimum_experience=='10'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_10years');?></option>
                <option value="11" <?php if($minimum_experience=='11'):?> selected <?php endif;?>> <?php echo $this->lang->line('tat_job_experience_define_plus_10years');?></option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="long_description"><?php echo $this->lang->line('tat_long_description');?></label>
          <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('tat_long_description');?>" name="long_description" cols="30" rows="5" id="long_description2"><?php echo $long_description;?></textarea>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="short_description"><?php echo $this->lang->line('tat_short_description');?></label>
      <textarea class="form-control" placeholder="<?php echo $this->lang->line('tat_short_description');?>" name="short_description" cols="30" rows="3"><?php echo $short_description;?></textarea>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('tat_close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('tat_update');?></button>
  </div>
<?php echo form_close(); ?>
<style type="text/css">.trumbowyg-box, .trumbowyg-editor { min-height: 175px; }</style>
<script type="text/javascript">
 $(document).ready(function(){
					
		jQuery("#ajx_company").change(function(){
			jQuery.get(base_url+"/get_designations/"+jQuery(this).val(), function(data, status){
				jQuery('#designation_ajx').html(data);
			});
		});
		$('#long_description2').trumbowyg();

		var tat_table = $('#tat_table').dataTable({
			"bDestroy": true,
			"ajax": {
				url : "<?php echo site_url("admin/job_post/job_list") ?>",
				type : 'GET'
			},
			"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
			}
		});
		
		$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_tat"]').select2({ width:'100%' });	 
		
		$('.e_date').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:'yy-mm-dd',
			yearRange: '1900:' + (new Date().getFullYear() + 10),
			beforeShow: function(input) {
				$(input).datepicker("widget").show();
			}
		});

		$("#edit_job").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=job&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					} else {
						tat_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});	
  </script>
<?php }
?>
