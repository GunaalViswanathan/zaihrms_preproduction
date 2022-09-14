@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','Employee Management')
@section('css')
    <style>
        .append{
            height: 35px;
            padding-top: 5px;
            position: absolute;
            top: 1px;
            right: 32px;
            border-left: 1px solid #d1d3e2;
            padding-left: 2%;
            background-color: #fff;
            cursor: pointer;
        }
        .search_button{
            background-color: white;
            border: 0;
            color: #8d87ad;
        }
        .search_button:hover {
            background-color: white;
            border: 0 !important;
            color: #8d87ad;
        }
        .search_fields{
            width: 30% !important;
            border-radius: 5px;
        }
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
@endsection
@section('content')
    <!-- Page Heading  Start-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee List</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form  method="POST" action="{{ route('employee.index') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            <div class="col-md-2 pad-0">
                                <a href="{{ route('employee.create') }}" data-toggle="tooltip" data-placement="top" title="Add Employee" class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Employee</a>
                            </div>
                            <!-- list filters -->
                            <div class="col-md-10 filters">
                                @include('admin.filters.employee')
                            </div>
                            @if(config('larasnap.module_list.user.search'))
                                <div class="col-md-12 mt-3 mb-2 text-right">
                                    <input type="text" name="search" id="search" placeholder="Search User..." class="form-control ml-10 search_fields" value="{{ $filters['search'] }}" data-toggle="tooltip" data-placement="top" title="Search by Name, Email, Mobile">
                                    <div class="append">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            @endif
                            <!-- list filters -->
                            <br> <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="bulk-checkall"></th>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Reporting</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $s = $users->firstItem(); @endphp
                                    @forelse($users as $i => $user)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $user->id }}" data-id="{{$user->id}}"></td>
                                            <td>{{ $s++ }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->userProfile->mobile_no }}</td>
                                            <td>{{ reportingName($user->reporting_to) }}</td>

                                            <td>
                                                @canAccess('employee.destroy')
                                                <a href="{{ route('employee.show', $user->id) }}" data-toggle="tooltip" data-placement="top" title="View Employee"><button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa fa-eye"></i></button></a>
                                                @endcanAccess
                                                @canAccess('employee.edit')
                                                <a href="{{ route('admin.employee_edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Employee"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button></a>
                                                @endcanAccess
                                                @canAccess('employee.destroy')
                                                <a href="#" onclick="return individualDelete('{{ $user->id }}')" data-toggle="tooltip" data-placement="top" title="Delete Employee"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                                @endcanAccess
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No User found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $users->appends(request()->input())->render() }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content End-->
@endsection
@section('script')
    <script>
        $(document).keypress(
            function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
        $('.append').on('click',function () {
            $('#list-form').submit();
        })
        $('#exportSubmitData').click(function(e){
            var sort_by = $('#sort-by').val();
            var reporting_to = $('#reporting_to').val();
            var user_status = $('#user_status').val();
            var search = $('#search').val();
            var url = "{{route('employeeExport')}}?sort_by="+ sort_by +"&reporting_to="+reporting_to+"&user_status="+user_status+"&search="+search;
            window.open(url, '_blank');
        });
    </script>
@endsection
