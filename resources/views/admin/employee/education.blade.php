<div class="modal fade bd-example-modal-xl" id="education_list"  tabindex="-1" role="modal" aria-labelledby="education_label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Education Details</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade  bd-example-modal-xl" id="education_details_add" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Add Education</h6>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form name="education-details-add" id="training_details_document" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="education_id" id="education_id" />
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">Name of Institue<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="institute_name" autocomplete="off" autocomplete="false" value maxlength="50">
                                    <p class="alert-warning mt-2" id="institute_name_error"></p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">Qualification<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="qualification" autocomplete="off" autocomplete="false" value maxlength="50">
                                    <p class="alert-warning mt-2" id="qualification_error"></p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">Passing Year<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="passing_year" autocomplete="off" autocomplete="false" value >
                                    <p class="alert-warning mt-2" id="passing_year_error"></p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">Percentage Scored<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="percentage_score" autocomplete="off" autocomplete="false" value>
                                    <p class="alert-warning mt-2" id="percentage_score_error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary br-30" data-dismiss="modal" onclick="javascript:user_education_list();">Close</button>
                <button id="add_training_item_btn" type="button" class="btn btn-primary submitBtn br-30" onclick="javascript:store_update_education_details('<?php echo route('education_detail'); ?>','new_item');">Submit</button>
                <button id="edit_training_item_btn" type="button" class="btn btn-primary submitBtn br-30" onclick="javascript:store_update_education_details('<?php echo route('education_detail'); ?>','edit_item');">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" id="education_details_delete"  tabindex="-1" role="modal" aria-labelledby="education_label" aria-hidden="true">
    <div class="modal-dialog modal-ml" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b><h6 class="modal-title">Delete Education</h6></b>
            </div>
            <b style="padding: 2%;">Are you sure want to delete ?</b>
            <div class="modal-footer">
                <form name="education-details-delete" id="education-details-delete-education" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="delete_training_id" id="delete_education_id" />
                    <input type="hidden" name="delete_item_education_id" id="delete_item_education_id" />

                    <button type="button" class="btn btn-secondary br-30" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary br-30" data-dismiss="modal" onclick="javascript:store_update_education_details('<?php echo route('education_detail'); ?>','delete_item');">Ok</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    user_education_list();
});
    function show_education_details_popup(user_id, operationurl, operation, id='') {
        if(operation == 'delete') {
            $('#delete_education_id').val(user_id);
            $('#delete_item_education_id').val(id);
        } else {
            $('#user_id').val(user_id);
            $('#education_id').val(id);
        }
        jQuery.ajax({
            url: operationurl,
            type: "POST",
            data: {operation:operation,user_id:user_id,id:id,_token:'<?php echo csrf_token() ?>'},
            beforeSend: function() {
                if (operation=='list') {
                    $('#education_details_add').modal('hide');
                    $('#education_list').modal('show').delay( 1000 );
                    $('#education_details_delete').modal('hide');
                }
                if (operation=='add' || operation=='edit' || operation=='delete') {
                    if (operation=='delete') {
                        $('.modal-title').html('Delete Education Detail');
                        $('#education_list').modal('hide');
                        $('#education_details_add').modal('hide');
                        $('#education_details_delete').modal('show');
                    } else {
                        $('#education_list').modal('hide');
                        $('#education_details_add').modal('show').delay( 1000 );
                        if (operation=='add') {
                            $('.modal-title').html('Add Education Detail');
                            $('#add_training_item_btn').show();
                            $('#edit_training_item_btn').hide();
                            $('#institute_name').val('');
                            $('#qualification').val('');
                            $('#passing_year').val('');
                            $('#percentage_score').val('');
                        } else if(operation=='edit') {
                            $('#add_training_item_btn').hide();
                            $('#edit_training_item_btn').show();
                        }
                    }
                }
            },
            success:function(result) {
                if(operation=="list") {
                    $('.modal-title').html('Education Detail');
                    $("#education_list .modal-body").html(result);
                }
                if(operation=="edit") {
                    $('.modal-title').html('Edit Education Detail');
                    $('#user_id').val(result.edit_details.user_id);
                    $('#education_id').val(result.edit_details.id);
                    $('#institute_name').val(result.edit_details.institute_name);
                    $('#qualification').val(result.edit_details.qualification);
                    $('#passing_year').val(result.edit_details.passing_year);
                    $('#percentage_score').val(result.edit_details.percentage_score);
                }
            },
            complete: function(){ }
        });
    }

    function store_update_education_details(operationurl, operation)
    {
        if (operation == 'delete_item') {
            var delete_education_id = $('#delete_education_id').val();
            var delete_item_education_id = $('#delete_item_education_id').val();
            jQuery.ajax({
                url: operationurl,
                type: "POST",
                data: {user_id:delete_education_id, operation:operation, id:delete_item_education_id, _token:'<?php echo csrf_token() ?>'},
                beforeSend: function() { },
                success:function(result) {
                    if (result.success == 'Education Details Deleted') {
                        user_education_list()
                        $('#delete_education_id').val('');
                        $('#delete_item_education_id').val('');
                        if (operation == 'delete_item') {
                            $('#alert-model').modal('show');
                            $('#alert-message').html('<b class="p-4">' + result.success + '</b>');
                        }
                    }
                },
                complete: function(){ }
            });
        } else {
            var form_searialize = "";
            var id       = $('#education_id').val();
            var user_id        = $('#user_id').val();
            var institute_name = $('#institute_name').val();
            var qualification  = $('#qualification').val();
            var passing_year   = $('#passing_year').val();
            var percentage_score = $('#percentage_score').val();

                jQuery.ajax({
                    url: operationurl,
                    type: "POST",
                    data: {institute_name:institute_name, qualification:qualification, passing_year:passing_year, percentage_score:percentage_score, id:id, operation:operation, user_id:user_id, _token:'<?php echo csrf_token() ?>'},
                    beforeSend:function(){
                        $('.alert-warning').hide();
                    },
                    success:function(result) {
                        if(result.success == 'Education Details Added') {
                            $('#education_list').modal('hide');
                            $('#education_details_add').modal('hide');
                            user_education_list();
                            if (operation == 'new_item') {
                                $('#alert-model').modal('show');
                                $('#alert-message').html('<b class="p-4">'+result.add+'</b>');
                            }
                        }
                        if(result.success == 'Education Details Updated') {
                            $('#education_list').modal('hide');
                            $('#education_details_add').modal('hide');
                            user_education_list();
                            if (operation == 'edit_item') {
                                $('#alert-model').modal('show');
                                $('#alert-message').html('<b class="p-4">'+result.edit+'</b>');
                            }
                        }
                        var error = result.errors;
                        if (error!='') {
                            $.each(error, function (error,x) {
                                $('#'+error+'_error').show();
                                $('#'+error+'_error').html(x);
                            });
                            return false;
                        }
                    },
                    complete: function(){ }
                });

        }
    }
    function user_education_list()
    {
        $.ajax({
            type: "GET",
            url: '<?= route('education',$user->id); ?>',
            success: function (addhtml) {
                $('#educationajaxupload').html(addhtml);
            }
        });
    }

</script>
