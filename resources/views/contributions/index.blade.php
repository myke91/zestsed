@extends('layout')
@section('content')
            <!-- ============================================================== -->
            <!-- Page Content -->
            <!-- ============================================================== -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Contributions</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="/addContribution">Add Contributions</a></li>
                                <li><a href="/contributions">Contributions</a></li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                   
                
                
                    <!-- ============================================================== -->
                    <!-- approved contributions table -->
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
                                <h3 class="box-title">List of Contributions</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>AMOUNT</th>
                                                <th>VENDOR NAME</th>
                                                <th>DATE</th>
                                                <th>CONTRIBUTION DETAIL</th>
                                            </tr>
                                        </thead>
                                        @foreach($conts as $cont)
                                        <tbody>
                                            <tr>
                                                <td>{{$cont->firstName}} {{$cont->otherNames}} {{$cont->lastName}}</td>
                                                <td class="txt-oflo">{{$cont->contributionAmount}}</td>
                                                <td>{{$cont->vendorName}}</td>
                                                <td class="txt-oflo">{{$cont->dateOfContribution}}</td>
                                                <td><span class="text-success">Mode of Payment: {{$cont->modeOfPayment}}
                                                    / Source of Payment: {{$cont->sourceOfPayment}} /
                                                    Date of Approval: {{$cont->dateOfApproval}} /
                                                    IsApproved: {{$cont->isApproved}}</span></td>
                                            </tr>
                                        </tbody>
                                            @endforeach
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 ">
                                        {{$conts->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
  @endsection