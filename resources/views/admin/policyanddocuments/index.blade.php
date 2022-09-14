@extends('larasnap::layouts.app', ['class' => 'policyanddocuments-index'])
@section('title','Policies')
@section('content')
<!-- Page Heading  Start-->
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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Policies</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="message"></div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('policyanddocuments.index') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                        @method('POST')
                        @csrf
                        @canAccess('announcement.create')
                        <div class="col-md-2 pad-0">
                            <a href="{{ route('policyanddocuments.create') }}" title="Add New Admin" class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Policy
                            </a>
                        </div>
                        @endcanAccess
                        <!-- list filters -->
                        <div class="col-md-10 filters">
                            @include('larasnap::list-filters.policyanddocuments')
                        </div>
                        <!-- list filters -->
                        <br> <br>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        @canAccess('policyanddocuments.destroy') <th><input type="checkbox" id="bulk-checkall"></th>
                                        @endcanAccess
                                        <th>S.No</th>
                                        <th>Plicy Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($policyanddocuments as $i => $policy)
                                    <tr>
                                        @canAccess('policyanddocuments.destroy')
                                        <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $policy->id }}" data-id="{{$policy->id}}"></td>
                                        @endcanAccess
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $policy->title  }}</td>
                                        <td>
                                            <p data-toggle="tooltip" data-trigger="hover" rel="popover" data-placement="left" title="{{$policy->description}}" class="task-desription">{{strlen($policy->description) > 15 ? substr($policy->description,0, 20)  : $policy->descriptionn}}...</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('policyanddocuments.show', $policy->id) }}" title="View Admin Detail">
                                                <button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa fa-eye"></i></button>
                                            </a>
                                            @canAccess('policyanddocuments.edit')
                                            <a href="{{ route('policyanddocuments.edit', $policy->id) }}" title="Edit Admin">
                                                <button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                                </button>
                                            </a>
                                            @endcanAccess
                                            @canAccess('policyanddocuments.edit')
                                            <a href="#" onclick="return individualDelete({{ $policy->id }})" title="Delete Announcement"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                            @endcanAccess

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="12">No Policies found!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $policyanddocuments->links() }}
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