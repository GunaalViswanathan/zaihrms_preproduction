@extends('larasnap::layouts.app', ['class' => 'policyanddocuments-show'])
@section('title','Policies')
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
   <h1 class="h3 mb-0 text-gray-800">Policies</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('policyanddocuments.index') }}" title="Back to Policy List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Policy List
               </a>
               <br> <br>
			   <div class="row">
              <div class="col-md-8">
			  <strong class="table-heading">POLICY & DOCUMENT INFORMATION</strong>
			  <table class="details mb-10">
			  <tr><td><strong>Policy Name</strong></td><td> {{ $policyanddocuments->title ? $policyanddocuments->title: '- NA -' }}</td></tr>
			  <tr><td><strong>Description</strong></td><td> {{ $policyanddocuments->description ? $policyanddocuments->description : '- NA -' }}</td></tr>
                  <tr><td><strong>Document</strong></td><td>
                          @if($policyanddocuments->document)
                          <ul class="files-action">
                              <li class="dropdown dropdown-action">
                                  <a href="javascript:void(0)" class="dropdown-toggle btn btn-link" data-toggle="dropdown" aria-expanded="false">
                                      <i class="material-icons">  </i> {{$policyanddocuments->document ? $policyanddocuments->document : '- NA -' }}
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 142px, 0px);" x-out-of-boundaries="">

                                      <a class="dropdown-item" download="" href="{{url('storage/app/public/upload/policyanddocument/').'/'.$policyanddocuments->document}}">Download</a>

                                      <a class="dropdown-item" target="_blank" href="{{url('storage/app/public/upload/policyanddocument/').'/'.$policyanddocuments->document}}">View</a>
                                      </div>
                              </li></ul>
                          @else
                              {{'-NA-'}}
                          @endif
                      </td></tr>
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
        .files-action {
            list-style: none;
            padding: 4px 8px 8px 0px;
            margin: 0px 0px 0px -11px;
        }
    </style>
    @endsection
