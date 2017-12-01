@extends('layout')
@section('content')
@include('contributions.contributionDetails')
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
                                    <th>MODE OF PAYMENT</th>
                                    <th colspan="2">APPROVE</th>
                                </tr>
                            </thead>
                            @foreach($conts as $cont)
                            <tbody>
                                <tr>
                                    <td>{{$cont->firstName." ".$cont->otherNames." ".$cont->lastName}}</td>
                                    <td class="txt-oflo">GH₵ {{$cont->contributionAmount}}</td>
                                    <td>{{$cont->vendorName}}</td>
                                    <td class="txt-oflo">{{$cont->dateOfContribution}}</td>
                                    <td>{{$cont->modeOfPayment}}
                                    <td>
                                        @if($cont->isApproved == 1)
                                        <i class="fa fa-check" id="checked"></i>
                                        @else
                                        <a href="{{route('approveContribution',$cont->contributionId)}}" onclick="return confirm('Are you sure you want to approve this contribution?');"><i class="fa fa-times" id="notchecked"></i></a>
                                        @endif
                                    </td>
                                    <td><Button value="{{$cont->contributionId}}" class="btn btn-success" id="show-cont">View Details</Button></td>
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
    </div>
</div>

@endsection