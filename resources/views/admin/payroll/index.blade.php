@extends('larasnap::layouts.app', ['class' => 'payrolls-index'])
@section('title','Payslip')
@section('content')
    <!-- Page Heading  Start-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payslip </h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="post" action="{{ route('payrolls.getpayslip') }}"
                             autocomplete="off">
                            @method('POST')
                            @csrf
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="employee" class="control-label">Employee<small class="text-danger required">*</small></label>
                                            <input type="text" placeholder="Search Employee" name="employee" id="employee" class="form-control autocomplete autocomplete-value" value="{{ old('employee ', isset($employee->email) ?$employee->email.'('. ($employee->full_name).')' : '') }}" />
                                            <input type="hidden" name="employee" class="autocomplete-id" value="{{ old('employee_id', isset($employee->id) ?$employee->id : '') }}"  />
                                            <div id="autocompleteList"></div>

                                            @error('employee')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 no-label">
                                        <div class="form-group">
                                            <a href="{{route('payrolls.index')}}"  class="btn btn-warning">Reset</a>
                                            <input type="submit" value="Submit" class="btn btn-primary">
                                        </div>
                                    </div>


                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var autocomplete_url = "{{ route('employee.getemployee') }}";


    </script>
@endsection
@section('css')
    <style>
        .table td, .table th{
            padding: 0px 0px 8px 6px;
        }

    </style>
    @endsection
