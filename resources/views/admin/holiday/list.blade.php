
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="bulk-checkall"></th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($announcements as $i => $announcement)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $announcement->id }}" data-id="{{$announcement->id}}"></td>
                                            <td>{{ $announcement->id }}</td>
                                            <td>{{ $announcement->title }}</td>
                                            <td>{{ $announcement->description }}</td>
                                            <td>


                                                    <button data-toggle="model" data-target="#announcement_edit" onclick="editform({{$announcement->id}})" class="btn btn-primary btn-sm" type="button"><i
                                                            aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                                    </button>

                                                <a href="#" onclick="deleteRecord({{ $announcement->id }})" title="Delete Announcement"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Announcement found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                                <script>
                                    function editform(id){
                                        $.ajax({
                                            type: "GET",
                                            url: '{{ route('announcement.editform') }}',
                                            data:{id:id},
                                            success: function (result) {
                                                $('#edit_title').val(result.data.title);
                                                $('#edit_description').val(result.data.description);
                                                $('#announement_id').val(result.data.id);
                                                $('#announcement_edit').modal('show');
                                            }
                                        });
                                    }
                                    function deleteRecord(id){
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        })
                                        if(confirm("Are you sure, you want to delete the record?")){
                                            $("input[name=_method]").val('DELETE');
                                            var action_url = $("#list-form").prop('action');
                                            var new_action_url = action_url +'/'+id;
                                            $.ajax({
                                                type: "DELETE",
                                                url: new_action_url,
                                                success: function (result) {
                                                    Message(result.message);
                                                    ListData();
                                                }
                                            });

                                        }else{
                                            return false;
                                        }
                                    }
                                </script>
