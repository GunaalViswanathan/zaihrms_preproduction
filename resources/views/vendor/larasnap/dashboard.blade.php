@extends('larasnap::layouts.app', ['class' => 'dashboard'])

@section('title','Dashboard')

@section('content')
@php
$empRole = \LaraSnap\LaravelAdmin\Models\Role::where('name', 'employee')->first();
$role = auth()->user()->user_role->role_id;
@endphp

<!-- Page Heading  Start-->
<div class="container">
    @if($role != $empRole->id)
    <div class="row admin">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3> {{ $usersActiveCount }} </h3>
                    <h5> Active Users </h5>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-red">
                <div class="inner">
                    <h3> {{ $usersInactiveCount }} </h3>
                    <h5> Inactive Users </h5>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Page Content End-->
@endsection