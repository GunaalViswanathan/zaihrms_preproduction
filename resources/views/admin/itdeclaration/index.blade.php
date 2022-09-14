@extends('larasnap::layouts.app', ['class' => 'itdeclaration-index'])
@section('title','IT Declaration')

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
        <h1 class="h3 mb-0 text-gray-800">IT Declaration</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="post" action="{{route('itdeclaration.viewdetails')}}"
                              autocomplete="off" id="employeeserachform">
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
                                        <a href="{{route('itdeclaration.index')}}"  class="btn btn-warning">Reset</a>
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
    <!-- Page Content End-->
@endsection


@section('script')
    <script>
        var autocomplete_url = "{{ route('employee.getemployee') }}";


    </script>
@endsection
