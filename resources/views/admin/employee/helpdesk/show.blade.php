@extends('larasnap::layouts.app', ['class' => 'helpdesk-show'])
@section('title','Announcement')
@section('content')
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    color: black;
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
   <h1 class="h3 mb-0 text-gray-800">Ticket Details</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('helpdesks.index') }}" title="Back to Ticket List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Ticket List
               </a>
               <br> <br>
			   <div class="row">
              <div class="col-md-8">
			  <strong class="table-heading">TICKET INFORMATION</strong><br><br>
			  <table class="details mb-10 table-bordered">
			  <tr><td><strong>Category</strong></td><td>{{$helpdesk->category->label}}</td></tr>
                  <tr><td><strong>Subject</strong></td><td>{{ $helpdesk->subject}}</td></tr>


			  <tr><td><strong>Description</strong></td><td>{{$helpdesk->description}}</td></tr>
                  <tr><td><strong>Created Date</strong></td><td>{{date(setting('date_format'),strtotime($helpdesk->created_at))}}</td></tr>
                  <tr><td><strong>Updated Date</strong></td><td>{{date(setting('date_format'),strtotime($helpdesk->updated_at))}}</td></tr>

                  <tr><td><strong>Status</strong></td><td><span class="badge badge-success">{{ ucfirst($helpdesk->status)}}</span></td></tr>

                  <tr><td><strong>Image</strong></td><td><a target="_blank" href="{{url('storage/app/public/upload/ticket/').'/'.$helpdesk->images}}"> {{ $helpdesk->images ? $helpdesk->images:"-NA-"}}</a></td></tr>

			  </table>
			  </div>

            </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page Content End-->
@endsection
@section('css')
    <style>
        .details td{
            padding: 10px 11px 10px 10px;

        }
    </style>
@endsection
