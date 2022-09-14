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
                            <div class="col-lg-12">
                            <div class="accordion" id="accordionExample">
                                @forelse($announcements as $i => $announcement)

                                        <div class="card_{{$i}}">
                                            <div class="card-header" style="padding: 0px 0px 0px 13px;" id="headingOne_{{$i}}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link"  data-id="{{$i}}" type="button" data-toggle="collapse" data-target="#collapseOne_{{$i}}" aria-expanded="true" aria-controls="collapseOne_{{$i}}">
                                                        {{$announcement->title}}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseOne_{{$announcement->id}}" class="collapse @if($i=='0')show @endif" aria-labelledby="headingOne_{{$announcement->id}}" data-parent="#accordionExample">
                                                <div class="card-body" style="font-size: 0.9rem;">
                                                  {{$announcement->description ? $announcement->description:"-NA-"}}
                                                    <br>
                                                    <br>
                                                    <p style="float: right;font-size: 0.7rem;"><strong>posted at :</strong> {{date(setting('date_time_format'),strtotime($announcement->created_at))}}</p>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>




                                @empty



                                        <p style="text-align:center;"><strong style="text-align: center;">{{"No Announcements Found!"}}</strong></p>
                                @endforelse
                            </div>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <style>
        .table td, .table th{
            padding:8px;
        }
    </style>
    @endsection
@section('script')
    <script>

        $('[data-toggle="collapse"]').on('mouseenter', function() {
            var id=$(this).attr('data-id');
            $(this).parents('.card_'+id).find('.collapse').collapse('show');
        });


    </script>
@endsection


