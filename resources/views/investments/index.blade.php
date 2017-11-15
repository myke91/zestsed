@extends('layout')
@section('content')
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Investments</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Investments</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- ============================================================== -->
        <!-- invsetments table -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                        <select class="form-control pull-right row b-none">
                            <option>March 2017</option>
                            <option>April 2017</option>
                            <option>May 2017</option>
                            <option>June 2017</option>
                            <option>July 2017</option>
                        </select>
                    </div>
                    <h3 class="box-title">List of Investments</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>CONTRIBUTOR</th>
                                    <th>INTEREST RATE</th>
                                    <th>DATE OF CONTRIBUTION</th>
                                </tr>
                            </thead>
                            @foreach($invests as $invest)
                            <tbody>
                                <tr>
                                    <td>{{$invest->firstName}} {{$invest->otherNames}} {{$invest->lastName}}</td>
                                    <td class="txt-oflo">{{$invest->interestRate}}</td>
                                    <td class="txt-oflo">{{$invest->dateOfInvestment}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10 ">
                            {{$invests->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection