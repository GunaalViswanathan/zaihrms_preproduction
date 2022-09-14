@extends('larasnap::layouts.app', ['class' => 'announcement-show'])
@section('title','Announcement')
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
   <h1 class="h3 mb-0 text-gray-800">Declaration View</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('itdeclaration.index') }}" title="Back to Declaration List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Declaration List
               </a>
               <br> <br>
			   <div class="row">
              <div class="col-md-8">
			  <strong class="table-heading">DECLARATION DETAILS</strong>
			  <table class="details mb-10 table-bordered">

			  <tr><td><strong>Category</strong></td><td>{{ $declaration->category ? $declaration->category->label: '- NA -' }}</td></tr>
                  @if($declaration->category->name=='any-investments')

                  <tr><td><strong>Sub Category</strong></td><td>{{\LaraSnap\LaravelAdmin\Models\Category::find($declaration->sub_category_id)->label}}</td></tr>
                  @endif
                  @if($declaration->category->name!='details-of-housing-loan')
                  <tr><td><strong>Name</strong></td><td>{{ $declaration->name ? $declaration->name: '- NA -' }}</td></tr>
                  <tr><td><strong>Amount</strong></td><td>{{ $declaration->amount ? number_format($declaration->amount): '- NA -' }}</td></tr>
                  @if($declaration->category->name=='details-of-rent-paid')
                  <tr><td><strong>Address</strong></td><td>{{ $declaration->address ? $declaration->address: '- NA -' }}</td></tr>
                  @endif
                  @endif
                  <tr><td><strong>Submited Date</strong></td><td>{{date(setting('date_format'), strtotime($declaration->created_at)) }}</td></tr>
			  <tr><td><strong>Documents</strong></td><td>@forelse($declaration->itdeclarationdocument as $i =>$document)
                          <a href="{{storageUrl(config('larasnap.uploads.itdeclaration.path')).'/'.$document->filename}}" target="_blank"> {{++$i}}.{{$document->filename}}</a>
                          <a href="{{storageUrl(config('larasnap.uploads.itdeclaration.path')).'/'.$document->filename}}" target="_blank" download=""><li style="color: yellowgreen;" class="fa fa-download"></li></a>
                  <br>
                      @empty
                     {{"-NA-"}}
                      @endforelse
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
    </style>
@endsection
