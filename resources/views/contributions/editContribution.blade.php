@extends('layout')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit Contribution</h4> </div>
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
                    <h3 class="box-title">Edit Contributions</h3>
                    @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('success')}}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session('error')}}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" id="frm-update-contribution" action="{{route('contributions.update',$contrib->contributionId)}}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="contributionId" id="contributionId" value="{{$contrib->contributionId}}">
                        {{csrf_field()}}
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Contributor</label>
                            <div class="col-sm-4">
                                <input name="member" class="form-control" value="{{$contrib->firstName}}  {{$contrib->otherNames}} {{$contrib->lastName}}"  readonly>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Mode Of Payment</label>
                            <div class="col-sm-4">
                                <select id="modeOfPayment" name="modeOfPayment" class="selectpicker form-control " data-live-search="true" required>
                                    <option>--------</option>
                                    <option {{$contrib->modeOfPayment === 'Mobile Money' ? "selected" : ""}}>Mobile Money</option>
                                    <option {{$contrib->modeOfPayment === 'Bank Transfer' ? "selected" : ""}}>Bank Transfer</option>
                                    <option {{$contrib->modeOfPayment === 'Cash' ? "selected" : ""}}>Cash</option>
                                    <option {{$contrib->modeOfPayment === 'Cheque' ? "selected" : ""}}>Cheque</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Source Of Payment</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sourceOfPayment" name="sourceOfPayment" data-toggle="tooltip" value="{{$contrib->sourceOfPayment}}" required>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Vendor Name</label>
                            <div class="col-sm-4">
                                <input type="text"  class="form-control" id="vendorName" name="vendorName" value="{{$contrib->vendorName}}" required>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                                <label class="col-sm-2 control-label">Date Of Contribution</label>
                                <div class="col-sm-4">
                                    <input type="text"  class="form-control" id="dateOfContribution" name="dateOfContribution" value="{{$contrib->dateOfContribution}}" placeholder="YYYY-MM-DD" required>
                                </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                                    <label class="col-sm-2 control-label">Contribution Amount</label>
                                    <div class="col-sm-4">
                                        <input type="text"  class="form-control" id="contributionAmount" name="contributionAmount" value="{{$contrib->contributionAmount}}" placeholder="00.00" required>
                                    </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Is Approved?</label>
                            <div class="col-sm-4">
                                <input type="text"  class="form-control" id="isApproved" name="isApproved" value="{{$contrib->isApproved}}"  readonly>
                            </div>
                </div>
                <div class="form-group has-success has-feedback">
                    <label class="col-sm-2 control-label">Date of Approval</label>
                    <div class="col-sm-4">
                        <input type="text"  class="form-control" id="dateOfApproval" name="dateOfApproval" value="{{$contrib->dateOfApproval}}" readonly>
                    </div>
        </div>
                        <div class="clearfix"></div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success btn-sm">Update Contribution</button>
                            <button type="button" class="btn btn-danger btn-sm delete-contribution">Delete Contribution</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).on('click','.delete-contribution',function(e){
        e.preventDefault();
        var response = confirm('Are you sure you want to delete this contribution?');
        if(response){
            var id = $("#contributionId").val();
            $.ajax({
                url: "/contributions/"+id,
                type: 'DELETE',
                data: 'contributions/'+id+'/delete',
                success: function(data) {
                        swal({title:'ZESTSED GH',
                        text:'Contribution deleted successfully',
                        icon:'success'
                    }).then(function(){
                        location.href = '/contributions';
                    });
                },
                error:function(data){
                    console.log(data.responseJSON.message);
                    swal('ZESTSED GH',data.responseJSON.message,'error');
                }
              }); 
        }
    });
</script>
@endsection
</script>