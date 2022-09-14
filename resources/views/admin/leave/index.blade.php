@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','Leave | Permission')
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
        .form-control{
            height : 28px !important;
        }
        .select2-selection select2-selection--single {
            height: calc(1.5em + .75rem + 2px) !important;
    padding: .375rem .75rem !important;
    font-size: 1rem!important;
    font-weight: 400!important;
    line-height: 1.5!important;
    color: #6e707e!important;
    background-color: #fff!important;
    background-clip: padding-box!important;
    border: 1px solid #d1d3e2!important;;
    border-radius: .35rem!important;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out!important; 
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
        <h1 class="h3 mb-0 text-gray-800">Leave | Permission</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form  method="POST" action="{{ route('leave.index') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            <div class="col-md-3 pad-0">
                                @canAccess('leave.create')
                                <a href="{{ route('leave.create') }}" data-toggle="tooltip" data-placement="top" title="Apply Leave | Permission" class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Apply Leave | Permission</a>
                                @endcanAccess
                            </div>
                            <!-- list filters -->
                            <div class="col-md-9 filter">
                            @if(config('larasnap.module_list.user.sort-by'))
                                <select class="form-control" name="sort_by" id="sort-by" onchange="filter(this.value)">
                                @foreach (config('larasnap.module_list.user.sort-by') as $option)
                                    <option @if($data['sort_by']==$option['value']) selected @endif value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                @endforeach
                                </select>
                            @endif
                                @if(config('larasnap.module_list.user.leave-status'))
                                    <select class = "form-control"  name="status"  id="status" onchange="filterByID(this.value)">
                                        <option value="">Select Status</option>
                                        @foreach (config('larasnap.module_list.user.leave-status') as $option)
                                            <option @if($data['status'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if(config('larasnap.module_list.user.leave-type'))
                                    <select class = "form-control"  name="type"  id="type" onchange="filterByID(this.value)">
                                        <option value="">Select Type</option>
                                        @foreach (config('larasnap.module_list.user.leave-type') as $option)
                                            <option @if($data['type'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if(strtolower(loginUserRole(auth()->user()->id)) != 'employee')
                                    <select class="form-control js-example-basic-single" name="user_id" id="user_id" onchange="filterByID(this.value)">
                                        <option value="">Select Employee</option>
                                        @foreach ($users as $option)
                                        <option @if($data['user_id'] == $option->id) selected @endif value="{{ $option->id }}">{{$option->full_name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                <input type="hidden" name="user_id" value="">
                                @endif
                            </div>
                            <div class="col-md-12 text-right">
                                Start Date
                                <input type="date" class="form-control mt-2 mb-2" name="from_date" id="from_date" value="{{ old('from_date', $data['from_date']) }}"/>
                                End Date
                                <input type="date" class="form-control mt-2 mb-2" name="to_date" id="to_date" value="{{ old('to_date', $data['to_date']) }}"/>
                                @error('to_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="submit" value="Submit" class="btn btn-primary">
                                <input type="button" value="Reset" class="btn btn-danger" id="reset">
                                <a class="btn btn-warning" href="javascript:void(0)" id="exportSubmitData"  data-toggle="tooltip" data-placement="top" title="Download Excel">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                            <!-- list filters -->
                            <br> <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Type</th>
                                        @if(strtolower(loginUserRole(auth()->user()->id)) != 'employee')
                                            <th>Name</th>
                                        @endif
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Days/Hours</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php $s = $leave->firstItem(); @endphp
                                    @forelse($leave as $i => $detail)
                                    
                                        <tr>
                                            <td>{{ $s++ }}</td>
                                            <td>{{ $detail->leave_type == 1 ? 'Leave' : ($detail->leave_type == 2 ? 'Permission' : ($detail->leave_type == 4 ? 'Half Day' : 'Work From Home') )}}</td>
                                            @if(strtolower(loginUserRole(auth()->user()->id)) != 'employee')
                                                <td>{{ucwords(reportingName($detail->user_id))}}</td>
                                            @endif
                                            @if($detail->leave_type == 1 || $detail->leave_type == 3)
                                            <td>{{ date(setting('date_format'), strtotime($detail->leave_from)) }}</td>
                                            <td>{{ date(setting('date_format'), strtotime($detail->leave_to)) }}</td>
                                            @endif
                                            @if($detail->leave_type == 4)
                                            <td>{{ date(setting('date_format'), strtotime($detail->leave_from)) }}</td>
                                            <td>{{ date(setting('date_format'), strtotime($detail->leave_from)) }}</td>
                                            @endif
                                            @if($detail->leave_type == 2)
                                                <td>{{ date(setting('date_time_format'), strtotime($detail->leave_from)) }}</td>
                                                <td>{{ date(setting('date_time_format'), strtotime($detail->leave_to)) }}</td>
                                            @endif
                                            @if($detail->leave_type == 1 || $detail->leave_type == 3)
                                                <td>{{ isset($detail->no_of_days) ? $detail->no_of_days : '- NA -' }}</td>
                                            @endif
                                            @if($detail->leave_type == 4)
                                                <td>{{ isset($detail->no_of_days) ? $detail->no_of_days : '- NA -' }}</td>
                                            @endif
                                            @if($detail->leave_type == 2)
                                                <td>{{ hourCalculate($detail->leave_from, $detail->leave_to) }}</td>
                                            @endif
                                            <td>{{ $detail->status == 1 ? 'Pending' : ($detail->status == 2 ? 'Approved' : 'Rejected') }}</td>
                                            <td>
                                                @canAccess('leave.show')
                                                @if(auth()->user()->id == $detail->user_id || auth()->user()->id == $detail->reporting_to || loginUserRole(auth()->user()->id) == 'Super Admin')
                                                <a href="{{ route('leave.show', $detail->id) }}" data-toggle="tooltip" data-placement="top" title="View detail"><button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa fa-eye"></i></button></a>
                                                @endif
                                                @endcanAccess
                                                @canAccess('leave.edit')
                                                @if(auth()->user()->id == $detail->user_id && $detail->status == 1)
                                                <a href="{{ route('leave.edit', $detail->id) }}" data-toggle="tooltip" data-placement="top" title="Edit Employee"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button></a>
                                                @endif
                                                @endcanAccess
                                                @canAccess('leave.destroy')
                                                @if(auth()->user()->id == $detail->user_id && $detail->status == 1)
                                                <a href="#" onclick="return individualDelete('{{ $detail->id }}')" data-toggle="tooltip" data-placement="top" title="Delete Employee"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                                @endif
                                                @endcanAccess

                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Leave(s) Applied</td>
                                        </tr>
                                    @endforelse
                                    
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $leave->appends(request()->input())->render() }}
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        function filter() {
            $('#list-form').submit();
        };
        $('#reset').on('click',function () {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#user_id').val('');
            $('#status').val('');
            $('#type').val('');
            $('#list-form').submit();
        });
        $('#exportSubmitData').click(function(e){
            var sort_by = $('#sort-by').val();
            var user_id = $('#user_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var type = $('#type').val();
            var url = "{{route('leaveExport')}}?sort_by="+ sort_by +"&user_id="+user_id+"&from_date="+from_date+"&to_date="+to_date+"&type="+type;
            window.open(url, '_blank');
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
