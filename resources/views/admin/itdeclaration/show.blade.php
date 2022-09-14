@extends('larasnap::layouts.app', ['class' => 'declaration-show'])
@section('title','IT Declaration')
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
   <h1 class="h3 mb-0 text-gray-800">Declaration View - {{$users->full_name}}</h1>
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
                    @php
                    $count=0;
                    @endphp

                    @forelse($declarations as $i=>$declaration)
                        @if($count==0)
                       <table class="table table-bordered">
                           <tbody>
                           @else
                           @endif
                    <tr>
                        @if($declaration->category->name=='any-investments' && $count==0)
                            @php
                            $count++;

                            @endphp
<td width="40%" style="background-color: #576c761a;"><strong class="table-heading">{{ strtoupper($declaration->category ? $declaration->category->label: '- NA -' )}}</strong></td>
                            <td style="background-color: #576c761a;"><strong class="table-heading">Name</strong></td>
                            <td style="background-color: #576c761a;"><strong class="table-heading">Amount</strong></td>
                            <td style="background-color: #576c761a;"><strong class="table-heading">Download</strong></td>
                        @elseif($declaration->category->name!='any-investments')
                            <td style="background-color: #576c761a;"><strong>{{ strtoupper($declaration->category ? $declaration->category->label: '- NA -' )}}</strong></td>

                            <td style="background-color: #576c761a;"><strong class="table-heading">Amount</strong></td>
                            @if($declaration->category->name=='any-other-investment' || $declaration->category->name=='any-other-income'|| $declaration->category->name=='details-of-housing-loan')
                            <td style="background-color: #576c761a;"><strong class="table-heading">Download</strong></td>
                            @endif
                            @if($declaration->category->name=='details-of-rent-paid')
                            <td style="background-color: #576c761a;"><strong class="table-heading">Address</strong></td>
                            <td style="background-color: #576c761a;"><strong class="table-heading">Download</strong></td>
                            @endif
                        @endif

                    </tr>
                    <tr>

                    </tr>
                    <tr>

                            @if($declaration->category->name=='any-investments')
                            <td width="40%">

                             {{\LaraSnap\LaravelAdmin\Models\Category::find($declaration->sub_category_id)->label}}
                       </td>
                                @endif
                                @if($declaration->category->name=='any-investments')
                                    <td width="20%">  {{ $declaration->name ? $declaration->name: '- NA -' }}</td>
                                @else
                                    <td width="40%">{{ $declaration->name ? $declaration->name: '- NA -' }}</td>
                                    @endif

                                    <td width="20%">{{ $declaration->amount ? number_format($declaration->amount): '- NA -' }}</td>
                                @if($declaration->category->name=='details-of-rent-paid')
                                   <td width="20%">{{ $declaration->address ? $declaration->address: '- NA -' }}</td>
                                    @endif
                                <td>
                                @forelse($declaration->itdeclarationdocument as $i =>$document)

                                    <a href="{{storageUrl(config('larasnap.uploads.itdeclaration.path')).'/'.$document->filename}}" target="_blank" download=""><li style="color: yellowgreen;" class="fa fa-download"></li></a>
                                    <br>
                                @empty
                                    {{"-NA-"}}
                                @endforelse
                                </td>
                    </tr>




                    @empty
                      <strong >No Results Found</strong>
                    @endforelse
                       </tbody>
                   </table>
{{--                  @forelse($declarations as $i=>$declaration)--}}

{{--                       <div class="col-md-12">--}}
{{--                           @if($declaration->category->name=='any-investments' && $i==0)--}}
{{--                  <strong class="table-heading">{{++$i}}.{{ strtoupper($declaration->category ? $declaration->category->label: '- NA -' )}}</strong>--}}

{{--                               @elseif($declaration->category->name!='any-investments')--}}
{{--                                   <strong class="table-heading">{{$i--}}{{--.{{ strtoupper($declaration->category ? $declaration->category->label: '- NA -' )}}</strong>--}}
{{--                           @endif--}}

{{--                       </div>--}}

{{--                      @if($declaration->category->name=='any-investments')--}}
{{--                          <div class="col-md-3">--}}
{{--                              <strong>SubCategory</strong>--}}
{{--                              <p>{{\LaraSnap\LaravelAdmin\Models\Category::find($declaration->sub_category_id)->label}}</p>--}}
{{--                          </div>--}}

{{--                      @endif--}}
{{--                      @if($declaration->category->name!='details-of-housing-loan')--}}
{{--                          <div class="col-md-3">--}}
{{--                              <strong>Name</strong>--}}
{{--                              <p>{{ $declaration->name ? $declaration->name: '- NA -' }}</p>--}}
{{--                          </div>--}}
{{--                           <div class="col-md-3">--}}
{{--                              <strong>Amount</strong>--}}
{{--                              <p>{{ $declaration->amount ? number_format($declaration->amount): '- NA -' }}</p>--}}
{{--                          </div>--}}


{{--                      @endif--}}
{{--                       @if($declaration->category->name=='details-of-rent-paid')--}}
{{--                       <div class="col-md-3">--}}
{{--                           <strong>Address</strong>--}}
{{--                           <p>{{ $declaration->address ? $declaration->address: '- NA -' }}</p>--}}
{{--                       </div>--}}
{{--                       @endif--}}
{{--                       <div class="col-md-3">--}}
{{--                           <strong>Documents</strong>--}}
{{--                           @forelse($declaration->itdeclarationdocument as $i =>$document)--}}
{{--                               <a href="{{storageUrl(config('larasnap.uploads.itdeclaration.path')).'/'.$document->filename}}" target="_blank"> {{++$i}}.{{$document->filename}}</a>--}}
{{--                               <a href="{{storageUrl(config('larasnap.uploads.itdeclaration.path')).'/'.$document->filename}}" target="_blank" download=""><li style="color: yellowgreen;" class="fa fa-download"></li></a>--}}
{{--                               <br>--}}
{{--                           @empty--}}
{{--                               {{"-NA-"}}--}}
{{--                           @endforelse--}}
{{--                       </div>--}}

{{--                  @empty--}}
{{--                      <div class="col-md-12">--}}
{{--                       <p style="text-align: center;"><strong>No Records Found</strong></p>--}}
{{--                      </div>--}}
{{--                  @endforelse--}}
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
        td,th{
            padding: 8px!important;
        }

    </style>
@endsection
