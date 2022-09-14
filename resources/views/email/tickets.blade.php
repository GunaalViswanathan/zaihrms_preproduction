@component('mail::message')

@if(@loginUserRole(auth()->user()->id) == 'Employee')
Employee " {{auth()->user()->full_name}} " has been raised a new ticket.
@else
  Dear employee Your ticket (#{{$data->ticket_id}}) status has been <strong>{{ucfirst($data->status)}}</strong>.
@endif

<h2>TICKET DETAILS</h2>


<p><strong>Ticket Id</strong> -  #<a href="javascript:void(0);" >{{$data->ticket_id}}</a> </p>
<p><strong>Category</strong> - {{$data->category->label}}</p>
<p><strong>Subject</strong> - {{$data->subject}}</p>
<p><strong>Description</strong> - {{$data->description}}</p>

Thanks,<br>
{{ config('app.name') }}

@endcomponent
