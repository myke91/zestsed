@extends('layout')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                   <div> Welcome,<h4 class="page-title"> {{Auth::user()->name}}</h4></div>
            </div>
        </div>
    </div>
@endsection
