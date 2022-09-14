@extends('larasnap::layouts.app', ['class' => 'holiday-index'])
@section('title','Holidays')
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
        <h1 class="h3 mb-0 text-gray-800">Holiday List</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('holidays.index') }}" id="list-form"
                              class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            @canAccess('holidays.create')
                            <div class="col-md-2 pad-0">
                                <a href="{{ route('holidays.create') }}" title="Add holiday"
                                   class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Holiday
                                </a>
                            </div>
                            @endcanAccess
                            <!-- list filters -->
                            <div class="col-md-10 filters">
                              @include('larasnap::list-filters.holidays')
                            </div>
                            <!-- list filters -->
                            <br> <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr >
                                        @canAccess('holidays.destroy')  <th><input type="checkbox" id="bulk-checkall"></th>
                                        @endcanAccess
                                        <th>S.No</th>
                                        <th>Holiday Name</th>
                                        <th>Date</th>
                                        <th>Day</th>
                                        @canAccess('holidays.edit')
                                        <th>Actions</th>
                                        @endcanAccess

                                    </tr>

                                    </thead>
                                    <tbody>
                                    @forelse($holidays as $i => $holiday)
                                        <tr >
                                            @canAccess('holidays.destroy')
                                            <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $holiday->id }}" data-id="{{$holiday->id}}"></td>
                                            @endcanAccess
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $holiday->holiday_name }}</td>

                                            <td>{{date(setting('date_format'), strtotime($holiday->holiday_date)) }}</td>
                                            @php
                                                $d    = new DateTime($holiday->holiday_date);
                                            @endphp
                                            <td>{{ date('l', strtotime($holiday->holiday_date))}}</td>
                                            @canAccess('holidays.edit')
                                            <td>

                                                <a href="{{ route('holidays.edit', $holiday->id) }}"
                                                   title="Edit Admin">
                                                    <button class="btn btn-primary btn-sm" type="button"><i
                                                            aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                                    </button>
                                                </a>
                                                @endcanAccess
                                                @canAccess('holidays.destroy')
                                                <a href="#" onclick="return individualDelete({{ $holiday->id }})" title="Delete Announcement"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                                @endcanAccess
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Holidays found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $holidays->links() }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

