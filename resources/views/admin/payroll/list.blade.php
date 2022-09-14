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
                            <br> <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr >

                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Action</th>


                                    </tr>

                                    </thead>
                                    <tbody>
                                    @forelse($payrolls as $i => $list)
                                        <tr>

                                            <td>{{ ++$i }}</td>
                                            <td>{{ $list->month }}</td>
                                            <td>{{ $list->year }}</td>
                                            <td>
                                                <a href="{{storageUrl(config('larasnap.uploads.payslip.path')).'/'.$list->filename}}" target="_blank" class="btn btn-info btn-sm"><li class="fa fa-eye"></li></a>
                                                                                            <a href="{{storageUrl(config('larasnap.uploads.payslip.path')).'/'.$list->filename}}" download="" class="btn btn-warning btn-sm"><li class="fa fa-download"></li></a>

                                            </td>
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

