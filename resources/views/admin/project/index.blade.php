@extends('larasnap::layouts.app', ['class' => 'project-index'])
@section('title','Project Management')
@section('content')
<!-- Page Heading  Start-->
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
@if(!userHasRole('employee'))
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Project Management</h1>
</div>
@endif
@if(userHasRole('employee'))
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Project Update</h1>
</div>
@endif
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <form method="POST" action="{{ route('project.index') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                  @method('POST')
                  @csrf
                  <!-- <div class = "row"> -->
                  <!-- <div class="col-md-4 pad-0">
                     
                  </div> -->

                  <div class="col-md-12 ">
                  @canAccess('project.create')
                     <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add New Project
                     </a>
                     @endcanAccess
                     @canAccess('daily_report.create')
                     <a href="{{ route('daily_report.create') }}" title="Add Daily Report" class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Daily Report
                     </a>
                     @endcanAccess
                     @canAccess('daily_report.bench')
                     <a href="{{route('daily_report.bench')}}" class="btn btn-primary btn-sm" style="float:right;margin-left:10px;">View Others Report <i aria-hidden="true" class="fa fa-arrow-right"></i></a></a>
                     @endcanAccess
                     @canAccess('project.project_report')
                     <a href="{{ route('project.daily_report_index') }}" style="float:right;" class="btn btn-primary btn-sm">View Project Report <i aria-hidden="true" class="fa fa-arrow-right"></i></a>
                     @endcanAccess
                  </div></br></br>

                  <!-- </div> -->
                  <!-- <div class = "row"> -->
                  <div class="col-md-12 filters">
                     @include('admin.project.filter')
                  </div>
                  <!-- </>div -->



                  <!-- list filters -->
                  <!-- list filters -->
                  <br> <br>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>S.NO</th>
                              <th>Project Name</th>
                              <th>Client Name</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Total Hours</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $s = $users->firstItem(); @endphp
                           @forelse($users as $project)
                           <tr>
                              <td>{{ $s++ }}</td>
                              <td>{{ $project->project_name }}</td>
                              <th>{{$project->client_name}}</th>
                              <td>{{ date('d-m-Y',strtotime($project->start_date))}}</td>
                              <td>{{ date('d-m-Y',strtotime($project->end_date))}}</td>
                              <td>{{$project->allocated_hours}}</td>
                              <td>
                                 @canAccess('project.daily_report_show')
                                 <a href="{{ route('project.daily_report_show', $project->id) }}" data-toggle="tooltip" data-placement="top" title="View Report"><button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa fa-eye"></i></button></a>
                                 @endif
                                 @canAccess('project.edit')
                                 <a href="{{ route('project.edit', $project->id) }}" title="Edit Project" data-toggle="tooltip" data-placement="top"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button></a>
                                 @endcanAccess
                                 @canAccess('project.destroy')
                                 <a href="#" onclick="return individualDelete('{{ $project->id }}')" title="Delete Project" data-toggle="tooltip" data-placement="top"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                 @endcanAccess
                              </td>
                           </tr>
                           @empty
                           <tr>
                              <td class="text-center" colspan="12">No Records found</td>
                           </tr>
                           @endforelse
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
   var autocomplete_url = "{{ route('project.search') }}";
   $('#autocompleteList').on('click', 'li', function() {
      var search_project = $(this).attr('data-value');
      $('#search_project').val(search_project);
      $('#list-form').submit();
   });
   $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
</script>
@endsection