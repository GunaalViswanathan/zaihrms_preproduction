@extends('larasnap::layouts.app', ['class' => 'holiday-index'])
@section('title','PaySlip')
@section('content')
    <!-- Page Heading  Start-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payslip List </h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('payrolls.index') }}" id="list-form"
                              class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            <div class="col-md-2 pad-0">
                                <a href="{{ route('payrolls.index') }}" title="Payroll Seach"
                                   class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Search
                                </a>

                            </div>
                            <div class="col-md-10 pad-0" >
                                <a style="float: right" href="{{ route('payrolls.create',$employee->id) }}" title="Upload Payslip"
                                   class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Upload Payslip
                                </a>

                            </div>

                            <br> <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr >

                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        @if(auth()->user()->id == $employee->id)
                                        <th>Action</th>
                                        @endif


                                    </tr>

                                    </thead>
                                    <tbody>
                                    @forelse($payrolls as $i => $list)
                                        <tr>

                                            <td>{{ ++$i }}</td>
                                            <td>{{ $list->month }}</td>
                                            <td>{{ $list->year }}</td>
                                            @if(auth()->user()->id == $employee->id)
                                            <td>
                                                <a href="{{storageUrl(config('larasnap.uploads.payslip.path')).'/'.$list->filename}}" target="_blank" class="btn btn-info btn-sm"><li class="fa fa-eye"></li></a>
                                                                                            <a href="{{storageUrl(config('larasnap.uploads.payslip.path')).'/'.$list->filename}}" download="" class="btn btn-warning btn-sm"><li class="fa fa-download"></li></a>

                                            </td>
                                            @endif
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Payslip found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $payrolls->links() }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

