@extends('layout')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Registrations</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Registrations</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- ============================================================== -->
        <!-- registrationstable -->
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
                    <h3 class="box-title">List of Registrations</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NUMBER</th>
                                    <th>OCCUPATION</th>
                                    <th>NEXT OF KIN</th>
                                    <th>MORE DETAILS</th>
                                </tr>
                            </thead>
                            @foreach($regs as $reg)
                            <tr>
                                <td>{{$reg->firstName}} {{$reg->otherNames}} {{$reg->lastName}}</td>
                                <td class="txt-oflo">{{$reg->email}} </td>
                                <td>{{$reg->phoneNumber}}</td>
                                <td class="txt-oflo">{{$reg->occupation}}</td>
                                <td>{{$reg->nextOfKin}}</td>
                                <td><span class="text-success">
                                        Gender: {{$reg->gender}} / Next Of Kin No: {{$reg->nextOfKinTelephone}} /
                                        Occupation: {{$reg->occupation}} / Date of Approval: {{$reg->dateOfApproval}}
                                    </span></td>
                            </tr>

                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10 ">
                            {{$regs->links()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endsection