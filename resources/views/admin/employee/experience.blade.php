<div class="modal fade bd-example-modal-xl" id="experience_list"  tabindex="-1" role="modal" aria-labelledby="experience_label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Experience Details</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade  bd-example-modal-xl" id="experience_details_add" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Add Education</h6>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form name="experience-details-add" id="training_details_document" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="user_id" id="exp_user_id" />
                    <input type="hidden" name="experience_id" id="experience_id" />
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">Organization<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="organization" autocomplete="off" autocomplete="false" value maxlength="50">
                                    <p class="alert-warning mt-2" id="organization_error"></p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">Designation<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="designation" autocomplete="off" autocomplete="false" value maxlength="50">
                                    <p class="alert-warning mt-2" id="designation_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">From Year<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="from_year" autocomplete="off" autocomplete="false" value >
                                    <p class="alert-warning mt-2" id="from_year_error"></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="author">To Year<small class="text-danger required">*</small></label><br/>
                                    <input class="form-control" type="text" id="to_year" autocomplete="off" autocomplete="false" value>
                                    <p class="alert-warning mt-2" id="to_year_error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary br-30" data-dismiss="modal" onclick="javascript:user_experience_list();">Close</button>
                <button id="add_experience_btn" type="button" class="btn btn-primary submitBtn br-30" onclick="javascript:store_update_experience_details('<?php echo route('experience_detail'); ?>','new_item');">Submit</button>
                <button id="edit_experience_btn" type="button" class="btn btn-primary submitBtn br-30" onclick="javascript:store_update_experience_details('<?php echo route('experience_detail'); ?>','edit_item');">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" id="experience_details_delete"  tabindex="-1" role="modal" aria-labelledby="experience_label" aria-hidden="true">
    <div class="modal-dialog modal-ml" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Delete Experience</h6>
            </div>
            <b style="padding: 2%;">Are you sure want to delete ?</b>
            <div class="modal-footer">
                <form name="experience-details-delete" id="experience-details-delete-experience" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="delete_training_id" id="delete_experience_id" />
                    <input type="hidden" name="delete_item_experience_id" id="delete_item_experience_id" />

                    <button type="button" class="btn btn-secondary br-30" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary br-30" data-dismiss="modal" onclick="javascript:store_update_experience_details('<?php echo route('experience_detail'); ?>','delete_item');">Ok</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    user_experience_list();
    function show_experience_details_popup(user_id, operationurl, operation, id='') {
        if(operation == 'delete') {
            $('#delete_experience_id').val(user_id);
            $('#delete_item_experience_id').val(id);
        } else {
            $('#exp_user_id').val(user_id);
            $('#experience_id').val(id);
        }
        jQuery.ajax({
            url: operationurl,
            type: "POST",
            data: {operation:operation,user_id:user_id,id:id,_token:'<?php echo csrf_token() ?>'},
            beforeSend: function() {
                if (operation=='list') {
                    $('#experience_details_add').modal('hide');
                    $('#experience_list').modal('show').delay( 1000 );
                    $('#experience_details_delete').modal('hide');
                }
                if (operation=='add' || operation=='edit' || operation=='delete') {
                    if (operation=='delete') {
                        $('.modal-title').html('Delete Experience Detail');
                        $('#experience_list').modal('hide');
                        $('#experience_details_add').modal('hide');
                        $('#experience_details_delete').modal('show');
                    } else {
                        $('#experience_list').modal('hide');
                        $('#experience_details_add').modal('show').delay( 1000 );
                        if (operation=='add') {
                            $('.modal-title').html('Add Experience Detail');
                            $('#add_experience_btn').show();
                            $('#edit_experience_btn').hide();
                            $('#organization').val('');
                            $('#designation	').val('');
                            $('#from_year').val('');
                            $('#to_year').val('');
                        } else if(operation=='edit') {
                            $('#add_experience_btn').hide();
                            $('#edit_experience_btn').show();
                        }
                    }
                }
            },
            success:function(result) {
                if(operation=="list") {
                    $('.modal-title').html('Experience Detail');
                    $("#experience_list .modal-body").html(result);
                }
                if(operation=="edit") {
                    $('.modal-title').html('Edit Experience Detail');
                    $('#exp_user_id').val(result.edit_details.user_id);
                    $('#experience_id').val(result.edit_details.id);
                    $('#organization').val(result.edit_details.organization);
                    $('#designation	').val(result.edit_details.designation);
                    $('#from_year').val(result.edit_details.from_year);
                    $('#to_year').val(result.edit_details.to_year);
                }
            },
            complete: function(){ }
        });
    }

    function store_update_experience_details(operationurl, operation)
    {
        if (operation == 'delete_item') {
            var delete_experience_id = $('#delete_education_id').val();
            var delete_item_experience_id = $('#delete_item_experience_id').val();
            jQuery.ajax({
                url: operationurl,
                type: "POST",
                data: {user_id:delete_experience_id, operation:operation, id:delete_item_experience_id, _token:'<?php echo csrf_token() ?>'},
                beforeSend: function() { },
                success:function(result) {
                    if (result.success == 'Experience Details Deleted') {
                        user_experience_list()
                        $('#delete_experience_id').val('');
                        $('#delete_item_experience_id').val('');
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
            var id = $('#experience_id').val();
            var user_id = $('#exp_user_id').val();
            var organization = $('#organization').val();
            var designation = $('#designation').val();
            var from_year = $('#from_year').val();
            var to_year = $('#to_year').val();

            jQuery.ajax({
                url: operationurl,
                type: "POST",
                data: {organization:organization, designation:designation, from_year:from_year, to_year:to_year, id:id, operation:operation, user_id:user_id, _token:'<?php echo csrf_token() ?>'},
                beforeSend:function(){
                    $('.alert-warning').hide();
                },
                success:function(result) {
                    if(result.success == 'Experience Details Added') {
                        $('#experience_list').modal('hide');
                        $('#experience_details_add').modal('hide');
                        user_experience_list();
                        if (operation == 'new_item') {
                            $('#alert-model').modal('show');
                            $('#alert-message').html('<b class="p-4">'+result.add+'</b>');
                        }
                    }
                    if(result.success == 'Experience Details Updated') {
                        $('#experience_list').modal('hide');
                        $('#experience_details_add').modal('hide');
                        user_experience_list();
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
    function user_experience_list()
    {
        $.ajax({
            type: "GET",
            url: '<?= route('experience',$user->id); ?>',
            success: function (addhtml) {
                $('#experienceajaxupload').html(addhtml);
            }
        });
    }

</script>
