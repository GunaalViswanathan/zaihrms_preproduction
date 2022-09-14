@extends('larasnap::layouts.app', ['class' => 'announcement-show'])
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
   <h1 class="h3 mb-0 text-gray-800">Holiday List</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('announcement.index') }}" title="Back to Admin List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Announcement List
               </a>
               <br> <br>
			   <div class="row">
              <div class="col-md-8">
			  <strong class="table-heading">ANNOUNCEMENT INFORMATION</strong>
			  <table class="details mb-10">
			  <tr><td><strong>Title</strong></td><td>{{ $announcement->title ? $announcement->title: '- NA -' }}</td></tr>
			  <tr><td><strong>Description</strong></td><td>{{ $announcement->description ? $announcement->description : '- NA -' }}</td></tr>

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
