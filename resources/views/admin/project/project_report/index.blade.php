@extends('larasnap::layouts.app', ['class' => 'report-index'])
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
   <h1 class="h3 mb-0 text-gray-800">Project Report</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <form method="POST" action="{{ route('project.daily_report_index_filter') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                  @method('POST')
                  @csrf
                  <div class="card-body">
                     <a href="{{ route('project.index') }}" title="Back to Project List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Project List</a>
                  </div>
                  <!-- list filters -->
                  <div class="col-md-9 filters">
                     @include('admin.project.project_report.filter')
                  </div>
                  <!-- list filters -->
                  <br> <br>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>S.NO</th>
                              <th>Task Date</th>
                              <th>Project</th>
                              <th>Resource</th>
                              <th>Worked Details</th>
                              <th>Hours Spent</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $s = $users->firstItem(); @endphp
                           @php
                           $total=0;
                           @endphp
                           @if(($filters['project_name']!='all') || ($filters['resources']!='all') || ($filters['from_date']!='all') || ($filters['to_date']!='all'))
                           @forelse($users as $report)
                           @php
                           $count_hours = $report->hours_spent;
                           $total +=$count_hours;
                           @endphp
                           <tr>
                              <td>{{ $s++ }}</td>
                              <td>{{ date('d-m-Y',strtotime($report->date))}}</td>
                              @if($report->project)
                              <td>{{$report->project->project_name}}</td>
                              @else
                              <td>{{WorkMode($report->work_mode)}}</td>
                              @endif
                              <td>{{ $report->user->full_name}}</td>
                              <td>
                                 <p data-toggle="tooltip" data-trigger="hover" rel="popover" data-placement="left" title="{{$report->description}}" class="task-desription">{{strlen($report->description) > 15 ? substr($report->description,0, 15)  : $report->description}}...</p>
                              </td>
                              <td>{{ $report->hours_spent}}</td>                             
                           </tr>
                           @empty
                           <tr>
                              <td class="text-center" colspan="12">No Records found!</td>
                           </tr>
                           @endforelse
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
                              <td class="text-center" colspan="12">No Records found!</td>
                           </tr>
                           @endif                          
                        </tbody>
                     </table>
                     @if(($filters['project_name']!='all') || ($filters['resources']!='all') || ($filters['from_date']!='all') || ($filters['to_date']!='all'))
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
      var project_name = $('#project').val();
      var resource = $('#resource').val();
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var export_format = $('#export option:selected').val();
      var url = "{{route('DailyReportExport')}}?sort_by=" + sort_by + "&project_name=" + project_name + "&resource=" + resource + "&from_date=" + from_date + "&to_date=" + to_date + "&export_format=" + export_format;
      window.open(url, '_blank');
   });
   $(function() {
      $("#date").datepicker({
         dateFormat: 'dd-mm-yy'
      });
      $("#date").datepicker("show");
   });
</script>
@endsection