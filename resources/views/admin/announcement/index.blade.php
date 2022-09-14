@extends('larasnap::layouts.app', ['class' => 'announcement-index'])
@section('title','Announcements')
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
        <h1 class="h3 mb-0 text-gray-800">Announcements</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('announcement.index') }}" id="list-form"
                              class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            @canAccess('announcement.create')
                            <div class="col-md-2 pad-0">
                                <a href="{{ route('announcement.create') }}" style="    padding: 8px 9px 6px 5px;" title="Add New Announcement"
                                   class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Announcement
                                </a>
                            </div>
                            @endcanAccess
                            <!-- list filters -->
                            <div class="col-md-10 filters">
                              @include('larasnap::list-filters.announcement')
                            </div>
                            <!-- list filters -->
                            <br> <br>






                            <div class="table-responsive">
                                <table class="table" id="announcementtable">
                                    <thead>
                                    <tr >
                                        @canAccess('announcement.destroy')  <th><input type="checkbox" id="bulk-checkall"></th>
                                        @endcanAccess
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        @canAccess('announcement.edit')
                                        <th>Actions</th>
                                        @endcanAccess

                                    </tr>

                                    </thead>
                                    <tbody>
                                    @forelse($announcements as $i => $announcement)
                                        <tr >
                                            @canAccess('announcement.destroy')
                                            <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $announcement->id }}" data-id="{{$announcement->id}}"></td>
                                            @endcanAccess
                                            <td>{{ ++$i }}</td>
                                            <td>{{date(setting('date_format'),strtotime($announcement->created_at))}}</td>
                                            <td>{{ $announcement->title }}</td>
                                            <td>
                                            <p  data-toggle="tooltip" data-trigger="hover" rel="popover" data-placement="left" title="{{$announcement->description}}" class="task-desription">{{strlen($announcement->description) > 15 ? substr($announcement->description,0, 20)  : $announcement->descriptionn}}...</p>
                                            </td>
                                            @canAccess('announcement.edit')
                                            <td>

                                                <a href="{{ route('announcement.edit', $announcement->id) }}"
                                                   title="Edit Admin">
                                                    <button class="btn btn-primary btn-sm" type="button"><i
                                                            aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                                    </button>
                                                </a>
                                                @endcanAccess
                                                @canAccess('announcement.destroy')
                                                <a href="#" onclick="return individualDelete({{ $announcement->id }})" title="Delete Announcement"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                                @endcanAccess
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Announcements found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $announcements->links() }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

