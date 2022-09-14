@extends('larasnap::layouts.app', ['class' => 'bench-index'])
@section('title','Project Management')
@section('content')
<style>
   .task-desription {
      white-space: nowrap !important;
      /* width: 30%!important; */
      overflow: hidden !important;
      text-overflow: ellipsis !important;
   }
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
   <h1 class="h3 mb-0 text-gray-800">Others Report(Bench/Estimation/Interview/Others)</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <form method="POST" action="{{ route('report.bench_index_filter') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                  @method('POST')
                  @csrf
                  <div class="card-body">
                     <a href="{{ route('project.index') }}" title="Back to Project List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Project List</a>
                  </div>
                  <!-- list filters -->
                  <div class="col-md-8 filters">
                  @if(config('larasnap.module_list.user.sort-by'))
                     <select class="form-control" name="sort_by" id="sort-by" onchange="filter(this.value)">
                        @foreach (config('larasnap.module_list.user.sort-by') as $option)
                        <option @if($filters['sort_by']==$option['value']) selected @endif value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                     </select>
                     @endif
                     @if(!userHasRole('employee'))
                     <select name="resources" class="form-control  ml-10" id="resource" onchange="filterByID(this.value)">
                        <option value="">Search By Employee Name</option>
                        @foreach($resources as $resource)
                        <option @if($filters['resources']==$resource->id) selected @endif value="{{$resource->id}}">{{ $resource->full_name }}</option>
                        @endforeach
                     </select>
                     @endif
                    
                     <div class="col-md-12">
                        Start Date
                        <input type="date" class="form-control mt-2 mb-1" name="from_date" id="from_date" value="{{ $filters['from_date'] }}" />
                        End Date
                        <input type="date" class="form-control mt-2 mb-1" name="to_date" id="to_date" value="{{ $filters['to_date'] }}" />
                     </div>
                     @error('to_date')
                     <div class="text-danger">{{ $message }}</div>
                     @enderror
                     <input type="submit" value="Submit" class="btn btn-primary">
                     <a href="{{route('daily_report.bench')}}" class="btn btn-danger" value="Reset">Reset</a>
                     <select name="export" class="form-control btn btn-dark" id="export" onchange="filterByID(this.value)">
                        <option value="">Download As </option>
                        <option><a value="XLSX" id="exportSubmitData">XLSX</a></option>
                        <option><a value="PDF" id="exportSubmitData">PDF</a></option>
                     </select>

                  </div>
                  <!-- list filters -->
                  <br> <br>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>S.NO</th>
                              <th>Task Date</th>
                              <th>Work Mode</th>
                              @if(!userHasRole('employee'))
                              <th>Resource</th>
                              @endif
                              <th>Worked Details</th>
                              <th>Hours Spent</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $s = 1; @endphp
                           @php
                           $total=0;
                           @endphp
                           @forelse($users as $report)
                           @if($report->project_id == 0)
                           @php
                           $count_hours = $report->hours_spent;
                           $total +=$count_hours;
                           @endphp
                           @endif
                           <tr>
                           @if($report->project_id == 0)
                              <td>{{ $s++ }}</td>
                              <td>{{ date('d-m-Y',strtotime($report->date))}}</td>
                              <td>{{ WorkMode($report->work_mode)}}</td>
                              @if(!userHasRole('employee'))
                              <td>{{ $report->user->full_name}}</td>
                              @endif
                              <td>
                                 <p data-toggle="tooltip" data-trigger="hover" rel="popover" data-placement="left" title="{{$report->description}}" class="task-desription">{{strlen($report->description) > 15 ? substr($report->description,0, 15)  : $report->description}}...</p>
                              </td>
                              <td>{{ $report->hours_spent}}</td>
                              @endif
                           </tr>
                           @empty
                           <tr>
                              <td class="text-center" colspan="12">No Records found!</td>
                           </tr>
                           @endforelse
                           @if(!userHasRole('employee'))
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><b>Total Hours Spent</b></td>
                              <td>{{$total}}</td>
                           </tr>                           
                           @else
                           <tr>
                              <td></td>
                              <td></td>
                              @if(userHasRole('employee'))
                              <td></td>
                              @endif
                              <td><b>Total Hours Spent</b></td>
                              <td>{{$total}}</td>
                           </tr>
                           @endif
                        </tbody>
                     </table>
                     @if($report->project_id == 0)
                     <div class="pagination">
                        {{ $users->links() }}
                     </div>
                     @endif
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page Content End-->
@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
   $('#export').change(function(e) {
      var sort_by = $('#sort-by').val();
      var resource = $('#resource').val();
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var export_format = $('#export option:selected').val();
      var url = "{{route('BenchReportExport')}}?sort_by=" + sort_by + "&resource=" + resource + "&from_date=" + from_date + "&to_date=" + to_date + "&export_format=" + export_format;
      window.open(url, '_blank');
   });
</script>
@endsection