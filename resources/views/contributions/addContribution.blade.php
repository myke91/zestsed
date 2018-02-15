@extends('layout')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Add Contributions</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
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
                    <h3 class="box-title">Add Contributions</h3>
                    @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('success')}}
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" id="frm-create-contribution" action="{{route('contributions.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Contributor</label>
                            <div class="col-sm-4">
                                <select id="memberId" name="memberId" class="selectpicker form-control" data-live-search="true" required>
                                    <option>--------</option>
                                    @foreach($regs as $key =>$reg)
                                    <option value="{{$reg->registrationId}}">{{ucfirst($reg->firstName)." ".$reg->otherNames." ".$reg->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Mode Of Payment</label>
                            <div class="col-sm-4">
                                <select id="modeOfPayment" name="modeOfPayment" class="selectpicker form-control " data-live-search="true" required>
                                    <option>--------</option>
                                    <option>Mobile Money</option>
                                    <option>Bank Transfer</option>
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Source Of Payment</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sourceOfPayment" name="sourceOfPayment" data-toggle="tooltip" required>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Vendor Name</label>
                            <div class="col-sm-4">
                                <input type="text"  class="form-control" id="vendorName" name="vendorName" required>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                                <label class="col-sm-2 control-label">Date Of Contribution</label>
                                <div class="col-sm-4">
                                    <input type="text"  class="form-control" id="dateOfContribution" name="dateOfContribution" placeholder="YYYY-MM-DD" required>
                                </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                                    <label class="col-sm-2 control-label">Contribution Amount</label>
                                    <div class="col-sm-4">
                                        <input type="text"  class="form-control" id="contributionAmount" name="contributionAmount" placeholder="00.00" required>
                                    </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success btn-sm ">Add Contribution</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection