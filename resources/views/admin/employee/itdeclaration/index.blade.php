@extends('larasnap::layouts.app', ['class' => 'itdeclaration-index'])
@section('title','Itdeclaration')
@section('content')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        /* border: 1px solid #dddddd; */
        text-align: left;
        padding: 8px;
        /* color: black; */
        font-family: Nunito, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #858796;
    }

    tr:nth-child(even) {
        background-color: #576c761a !important
    }

    .title {
        background-color: #222d32 !important;
        border-radius: 0px;
    }

    .white {
        color: white;
    }
</style>
    <!-- Page Heading  Start-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">IT Declaration List</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('itdeclaration.index') }}" id="list-form"
                              class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            @canAccess('itdeclaration.create')
                            <div class="col-md-2 pad-0">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" title="Add Declaration"
                                   class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Declaration
                                </a>
{{--                                <a href="{{route('itdeclaration.create')}}"   title="Add Declaration"--}}
{{--                                   class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Declaration--}}
{{--                                </a>--}}
                            </div>
                            @endcanAccess
                            <!-- list filters -->
                            <div class="col-md-10 filters">
                                @include('larasnap::list-filters.itdeclaration')
                            </div>
                            <!-- list filters -->
                            <br> <br>
                            <div class="table-responsive">
                                <table class="table table-striped" id="itdeclaration-table">
                                    <thead>
                                    <tr >

                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Submited Date</th>
                                        @canAccess('itdeclaration.edit')
                                        <th>Actions</th>
                                        @endcanAccess

                                    </tr>

                                    </thead>
                                    <tbody>
                                    @forelse($declaration as $i => $value)
                                        <tr >

                                            <td>{{ ++$i }}</td>
                                            <td><a href="{{route('itdeclaration.show',$value->id)}}" class="viewdetails" data-id="{{$value->id}}">{{ $value->category->label }}</a> </td>
                                            @if($value->category->name=='any-investments')
                                            <td>{{\LaraSnap\LaravelAdmin\Models\Category::find($value->sub_category_id)->label}}</td>
                                            @else
                                                <td>{{'-NA-'}}</td>
                                                @endif

                                            <td>{{date(setting('date_format'), strtotime($value->created_at)) }}</td>

                                            @canAccess('itdeclaration.edit')
                                            <td>


                                                    <button id="editdeclaration" class="btn btn-primary btn-sm editdeclaration" data-id="{{$value->id}}"  type="button"><i
                                                            aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                                    </button>

                                                @endcanAccess
                                                @canAccess('itdeclaration.show')
                                                <a href="{{ route('itdeclaration.show', $value->id) }}" class="viewdetails" data-id="{{$value->id}}"
                                                   title="View Declaration">
                                                    <button class="btn btn-info btn-sm" type="button"><i
                                                            aria-hidden="true" class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                @endcanAccess
                                                @canAccess('itdeclaration.destroy')
                                                <a href="#" onclick="return individualDelete({{ $value->id }})" title="Delete Declaration"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                                @endcanAccess
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Declaration found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $declaration->links() }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--start  add declaration form-->
    @include('admin.employee.itdeclaration.create')
    @include('admin.employee.itdeclaration.edit')

<!-- end add declaration form-->


@endsection
    <style>
        .table td,.table th{
            padding: 10px!important;
        }
    </style>
@section('script')
    <script>
        @error('category')
        $('#exampleModal').modal('show');
        @enderror
        @error('childcategory')
        $('#exampleModal').modal('show');
        @enderror
        @error('company_name')
        $('#exampleModal').modal('show');
        @enderror
        @error('documents')
        $('#exampleModal').modal('show');
        @enderror

        function getchildcategory(id,url){

            $.ajax({
                url:url,
                type:"GET",
                data:{input:id},
                success:function(data){
                    if(data.message=='success'){
                        var html="";
                        $("#childcategory").empty();
                        $("#category_id").val(data.parent.id);
                        $("#childcategory").append('<option value="">Select Sub Category</option>');
                        $('#childCategorydiv').show();
                        $('#childCategorydiv_edit').show();
                        $.each(data.result, function(index, item)
                        {
                            $("#childcategory").append("<option value="+item.id+">" + item.label + "</option>");
                        });


                    }else{
                        if(data.parent.name=='any-investments'){
                            $('#companynamediv').show()
                            $('#addressdiv').hide()
                            $('#childCategorydiv').show();
                            $('#amountdiv').show();
                        }
                        else if(data.parent.name=='details-of-rent-paid'){
                            $('#addressdiv').show()
                            $('#amountdiv').show()
                            $('#childCategorydiv').hide();
                        }
                        else if(data.parent.name=='details-of-housing-loan'){
                            $('#companynamediv').show()
                            $('#addressdiv').hide()
                            $('#childCategorydiv').hide();
                            $('#amountdiv').show();
                        }
                        else if(data.parent.name=='any-other-income' || data.parent.name=='any-other-investment'){
                            $('#addressdiv').hide()
                            $('#childCategorydiv').hide();
                            $('#companynamediv').show()
                            $('#amountdiv').show()
                        }

                        // $('#exampleModal').modal('show');
                        $("#category_id").val(data.parent.id);
                    }


                },

            });
        }
        function checkcategory(id){
        if(id==14){
            $('#company_name_label').html(' <label for="company_name" id="company_name_label" class="control-label">School Name<small class="text-danger required">*</small></label>')

        }
        else{
            $('#company_name_label').html(' <label for="company_name" id="company_name_label" class="control-label">Company Name<small class="text-danger required">*</small></label>')
        }
        }
        $(document).ready(function(){
            $(".editdeclaration").click(function(){
                var id=$(this).attr('data-id');
                var url = '{{ route("itdeclaration.edit", ":id") }}';
                var updateurl = '{{ route("itdeclaration.update",":id") }}';
                url = url.replace(':id', id);
                updateurl = updateurl.replace(':id', id);
                $.ajax({
                    url:url,
                    type:"GET",
                    data:{input:id},
                    success:function(data){
                        console.log(data);
                        $('#edit_category').val(data.category_id).attr('selected', 'selected');
                        if(data.sub_category_id){
                            $('#childcategory_edit').val(data.sub_category_id).attr('selected','selected');
                            $('#childCategorydiv_edit').show();
                        }
                        else{
                            $('#childCategorydiv_edit').hide();
                        }

                        $('#edit_company_name').val(data.name);
                        $('#edit_amount').val(parseFloat(data.amount).toFixed());
                        $('#editModal').modal('show');
                    //    update form action url
                        $('#editdeclarationform').attr('action',updateurl);
                    },

                });
            });

        });
    </script>
@endsection






