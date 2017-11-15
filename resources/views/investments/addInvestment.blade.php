@extends('layout')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Add Investments</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/investments">Investments</a></li>
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
                        <h3 class="box-title">Add Investments</h3>
                        <form class="form-horizontal" role="form" id="frm-create-investment" action="{{route('postInvestments')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label">Contributor</label>
                                <div class="col-sm-4">
                                    <select id="contributionId" name="contributionId" class="selectpicker form-control " data-live-search="true" required>
                                        <option>--------</option>
                                        @foreach($regs as $key =>$reg)
                                            <option value="{{$reg->registrationId}}">{{ucfirst($reg->firstName)." ".$reg->otherNames." ".$reg->lastName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label">Interest Rate</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="interestRate" name="interestRate" data-toggle="tooltip" required>
                                </div>
                            </div>
                            <div class="form-group has-success has-feedback">
                                <label class="col-sm-2 control-label">Investment Date</label>
                                <div class="col-sm-4">
                                    <input type="text"  class="form-control" id="dateOfInvestment" name="dateOfInvestment" placeholder="Click to select date" required>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-success btn-sm " onclick="validation();">Add Investment</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        </div>


    <script src="js/sweetalert.min.js"></script>
<script type="text/javascript">

    function validation() {

        var contId = document.getElementById('contributionId').value;
        var interest = document.getElementById('interestRate').value;
        var indate = document.getElementById('dateOfInvestment').value;

        if((contId  != '') && (interest!='') && (indate!='')){
            swal("Good job!", "Investment saved successfully!", "success");
            return true;
        }

}
    $(document).ready(function(){
        $("#dateOfInvestment").each(function() {
            $(this).datepicker();
        });
    });


</script>

@endsection