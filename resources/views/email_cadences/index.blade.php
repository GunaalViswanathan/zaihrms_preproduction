@extends('larasnap::layouts.app', ['class' => 'document-index'])
@section('title','Email Cadences')
@section('content')

<div id="heading1" class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Type</h1>
    <div class="dropdown show ml-2">

        <a class="btn btn-secondary dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Customers
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('email_cadences.direct_client')}}">Direct Clients</a>
            <a class="dropdown-item" href="{{route('email_cadences.white_labelled')}}">White-labelled Partners </a>
            <a class="dropdown-item" href="{{route('email_cadences.technology')}}">Technology Partners </a>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target)
            .prev()
            .find("i:last-child")
            .toggleClass("fa-minus fa-plus");
    });
    $('a').each(function(){
   $(this).click(function(){
      $('a').removeClass('selected');
      $(this).addClass('selected');
   });
});
</script>
@endsection
<style type="text/css">
    .documentation ul {
        padding: 10px 0;
        list-style: none;
        background: #3c8dbc !important;
        display: inline-block;
        width: 100%;
    }

    .documentation ul li {
        float: left;
    }

    .documentation ul li a {
        color: #fff;
        font-size: 16px;
        padding: 0px 15px;
        border-right: 1px solid #fff;
    }

    .document-text h3 {
        color: #555;
        font-weight: bold;
    }

    .myaccordion {
        max-width: 100%;
        margin: 0px auto;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
    }

    .myaccordion .card,
    .myaccordion .card:last-child .card-header {
        border: none;
    }

    .myaccordion .card-header {
        border-bottom-color: #EDEFF0;
        background: transparent;
    }

    .myaccordion .fa-stack {
        font-size: 18px;
    }

    .myaccordion .btn {
        width: 100%;
        font-weight: bold;
        color: #004987;
        padding: 0;
    }

    .myaccordion .btn-link:hover,
    .myaccordion .btn-link:focus {
        text-decoration: none;
    }

    .myaccordion li+li {
        margin-top: 10px;
    }

    .myaccordion .card-header {
        padding: 5px 10px;
        margin-bottom: 0;
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .myaccordion h2 button {
        font-size: 20px;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>