$(document).ready(function () {
    var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url: base_url + "/role_list/",
            type: 'GET'
        },
    });

    $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_tat"]').select2({ width: '100%' });



    $("#delete_record").submit(function (e) {
        e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize() + "&is_ajax=2&form=" + action,
            cache: false,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                } else {
                    $('.delete-modal').modal('toggle');
                    tat_table.api().ajax.reload(function () {
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                }
            }
        });
    });


    $('.edit-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var role_id = button.data('role_id');
        var modal = $(this);
        $.ajax({
            url: base_url + "/read/",
            type: "GET",
            data: 'jd=1&is_ajax=1&mode=modal&data=role&role_id=' + role_id,
            success: function (response) {
                if (response) {
                    $("#ajax_modal").html(response);
                }
            }
        });
    });


    $("#tat-form").submit(function (e) {
        e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $('.save').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize() + "&is_ajax=1&add_type=role&form=" + action,
            cache: false,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                    $('.save').prop('disabled', false);
                } else {
                    tat_table.api().ajax.reload(function () {
                        toastr.success(JSON.result);
                    }, true);
                    $('.add-form').removeClass('in');
                    $('.select2-selection__rendered').html('--Select--');
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                    $('#tat-form')[0].reset();
                    $('.save').prop('disabled', false);
                }
            }
        });
    });
});
$(document).on("click", ".delete", function () {
    $('input[name=_token]').val($(this).data('record-id'));
    $('#delete_record').attr('action', base_url + '/delete/' + $(this).data('record-id'));
});


$(document).ready(function () {
    $("#role_access").change(function () {
        var sel_val = $(this).val();
        if (sel_val == '1') {
            $('.role-checkbox').prop('checked', true);
        } else {
            $('.role-checkbox').prop("checked", false);
        }
    });
});