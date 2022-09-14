@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','Project Management')
@section('content')
<!-- Page Heading  Start-->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">{{$report_id->project_name}}</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <form method="POST" action="{{ route('project.daily_report_show_filter',$report_id->id) }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                  @method('POST')
                  @csrf
                  <div class="card-body">
                     <a href="{{ route('project.index') }}" title="Back to Project List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Project List</a>
                  </div>
                  <div class="col-md-8 filters">
                     @include('admin.project.show_filter')
                  </div>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>S.No</th>
                              <th>Date</th>
                              <th>Project</th>
                              @if(!userHasRole('employee'))
                              <th>Resource</th>
                              @endif
                              <th>Worked Details</th>
                              <th>Hours Spent</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php
                           $total=0;
                           @endphp
                           @php $s = $users->firstItem(); @endphp
                           @forelse($users as $report)
                           @php
                           $count_hours = $report->hours_spent;
                           $total +=$count_hours;
                           @endphp
                           <tr>
                              <td>{{$s++}}</td>
                              <td>{{ date('d-m-Y',strtotime($report->date))}}</td>
                              <td>{{ $report->project->project_name}}</td>
                              @if(!userHasRole('employee'))
                              <td>{{ $report->user->full_name}}</td>
                              @endif                              
                              <td>
                              <p  data-toggle="tooltip" data-trigger="hover" rel="popover" data-placement="left" title="{{$report->description}}" class="task-desription">{{strlen($report->description) > 15 ? substr($report->description,0,15)  : $report->description }}...</p>
                              </td>
                              <td>{{ $report->hours_spent}}</td>
                           </tr>
                           @empty
                           <tr>
                              <td class="text-center" colspan="12">No Projects found!</td>
                           </tr>
                           @endforelse
                           <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              @if(!userHasRole('employee'))
                              <td></td>
                              @endif
                              <td><b>Total Hours Spent</b></td>
                              <td>{{$total}}</td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="pagination">
                        {{ $users->links() }}
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
</script>
@endsection