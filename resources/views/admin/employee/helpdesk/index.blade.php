@extends('larasnap::layouts.app', ['class' => 'helpdesk-index'])
@section('title','Help Desk')
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
        <h1 class="h3 mb-0 text-gray-800">Help Desk</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('helpdesks.index') }}" id="list-form"
                              class="form-inline my-2 my-lg-0" autocomplete="off">
                            @method('POST')
                            @csrf
                            @if(@loginUserRole(auth()->user()->id) == 'Employee')
                            @canAccess('helpdesks.create')
                            <div class="col-md-2 pad-0">
                                <a href="{{ route('helpdesks.create') }}" title="Add helpdesks"
                                   class="btn btn-primary btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Add Ticket
                                </a>
                            </div>
                            @endcanAccess
                            @endif
                            <!-- list filters -->
                            <div class="col-md-10 filters">
                              @include('larasnap::list-filters.helpdesk')
                            </div>
                            <!-- list filters -->
                            <br> <br>
                            <div class="table-responsive @if(@loginUserRole(auth()->user()->id) == 'Employee')table-striped @endif">
                                <form method="post" id="ticket_status_form" action="{{route('helpdesks.updateticketstatus',1)}}">
                                <table class="table">
                                    <thead>
                                    <tr >
                                        @canAccess('helpdesks.destroy')  <th><input type="checkbox" id="bulk-checkall"></th>
                                        @endcanAccess
                                        <th>S.No</th>
                                        <th>Ticket Id</th>
                                        <th>Category</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        @canAccess('helpdesks.edit')
                                        <th>Actions</th>
                                        @endcanAccess

                                    </tr>

                                    </thead>
                                    <tbody>
                                    @forelse($helpdesks as $i => $helpdesk)
                                        <tr >
                                            @canAccess('helpdesks.destroy')
                                            <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $helpdesk->id }}" data-id="{{$helpdesk->id}}"></td>
                                            @endcanAccess
                                            <td>{{ ++$i }}</td>
                                            <td><a href="{{route('helpdesks.show',$helpdesk->id)}}"> #{{ $helpdesk->ticket_id }}</a></td>
                                            <td>{{$helpdesk->category->label }}</td>
                                            <td>{{ $helpdesk->subject }}</td>

                                            <td>
                                                @if(@loginUserRole(auth()->user()->id) == 'Employee')
                                                    @if($helpdesk->status=='open')
                                                    <span class="badge badge-info">{{ucfirst($helpdesk->status)}}</span>


                                                    @elseif($helpdesk->status=='closed')
                                                        <span class="badge badge-success">{{ucfirst($helpdesk->status)}}</span>
                                                    @elseif($helpdesk->status=='inprogress')
                                                        <span class="badge badge-warning">{{ucfirst($helpdesk->status)}}</span>
                                                    @elseif($helpdesk->status=='cancelled')
                                                        <span class="badge badge-danger">{{ucfirst($helpdesk->status)}}</span>
                                                        @endif
@else
                                                    <form></form>
                                                <form method="post" id="ticket_status_form_{{$helpdesk->id}}" action="{{route('helpdesks.updateticketstatus',$helpdesk->id)}}">

                                                    @csrf
                                                    @method('POST')

                                                <select onchange="updateTicketStatus({{$helpdesk->id}})"  name="ticket_status">
                                                    @foreach(config('larasnap.module_list.ticket_status') as $ticketStatus)
                                                        <option value="{{$ticketStatus['value']}}" {{$ticketStatus['value']==$helpdesk->status ? 'selected':""}}>{{$ticketStatus['label']}}</option>
                                                    @endforeach
                                                </select>
                                                </form>
                                                @endif
                                                </td>
                                            <td>

                                                @canAccess('helpdesks.edit')
                                                <a href="{{ route('helpdesks.show', $helpdesk->id) }}"
                                                   title="Show Ticket">
                                                    <button class="btn btn-info btn-sm" type="button"><i
                                                            aria-hidden="true" class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                @endcanAccess
                                                @if($helpdesk->status=='open')

                                                @canAccess('helpdesks.edit')

                                                <a href="{{ route('helpdesks.edit', $helpdesk->id) }}"
                                                   title="Edit Ticket">
                                                    <button class="btn btn-primary btn-sm" type="button"><i
                                                            aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                                    </button>
                                                </a>
                                                @endcanAccess
                                                @endif
                                                @canAccess('helpdesks.destroy')
                                                <a href="#" onclick="return individualDelete({{ $helpdesk->id }})" title="Delete Ticket"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                                @endcanAccess
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="12">No Tickets Found!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $helpdesks->links() }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function updateTicketStatus(id){
        if(confirm("Are you sure, you want to change the status?")){
            $("#ticket_status_form_"+id).submit();
        }else{
            return false;
        }
    }
</script>
@if(@loginUserRole(auth()->user()->id) == 'Employee')
@section('css')
    <style>
        .table td, .table th{
            padding:8px;
        }

    </style>
@endsection
@endif
