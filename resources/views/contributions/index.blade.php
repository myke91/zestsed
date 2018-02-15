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
                    <div class="row col-md-3 col-sm-4 col-xs-6 pull-right">
						<form class="form-horizontal">
							<div class="col-md-4">
								<select class="form-control month">
									<option value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control year" type="text" placeholder="YEAR" />
							</div>
							<div class="col-md-4">
								<button class="btn btn-info contribution-filter" type="button">
									<i class="fa fa-search">SEARCH</i>
								</button>
							</div>
						</form>
					</div>
                    <h3 class="box-title">List of Contributions</h3>
                    <div class="table-responsive">
                        <table id="contributionTable" class="table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>AMOUNT</th>
                                    <th>VENDOR NAME</th>
                                    <th>DATE</th>
                                    <th>MODE OF PAYMENT</th>
                                    <th>APPROVE</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            @foreach($conts as $cont)
                            <tbody>
                                <tr>
                                    <td class="txt-oflo">{{$cont->firstName." ".$cont->otherNames." ".$cont->lastName}}</td>
                                    <td class="txt-oflo">GH₵ {{$cont->contributionAmount}}</td>
                                    <td class="txt-oflo">{{$cont->vendorName}}</td>
                                    <td class="txt-oflo">{{$cont->dateOfContribution}}</td>
                                    <td class="txt-oflo">{{$cont->modeOfPayment}}</td>
                                    <td>
                                        @if($cont->isApproved == 1)
                                        <i class="fa fa-check" id="checked"></i>
                                        @else
                                        <a href="{{route('approveContribution',$cont->contributionId)}}" onclick="return confirm('Are you sure you want to approve this contribution?');"><i class="fa fa-times" id="notchecked"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="contributions/{{$cont->contributionId}}/edit">
                                            <button value="{{$cont->contributionId}}" class="btn btn-success">View Details</button>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10 page-links">
                            {{$conts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$(".contribution-filter").click(function() {
		var month = $('.month').val();
		var year = $('.year').val();
		$.get('/contribution-filter', {month: month,year: year}, function (data) {
			$('#contributionTable tbody').empty();
            $('.page-links').hide();
			$.each(data, function (i, value) {
                var middleName = value.otherNames === null ? '' : value.otherNames;
                if(value.isApproved == 1){
                    var line = '<td><i class="fa fa-check" id="checked"></i></td>';
                }else{
                    var line = '<td><a href="/contribution/approve/'+ value.contributionId +'" onclick="return confirm(\'Are you sure you want to approve this contribution?\');"><i class="fa fa-times" id="notchecked"></i></a></td>';
                }
				  $('#contributionTable').append('<tr>'+
						'<td>'+value.firstName+' '+ middleName +' '+value.lastName+'</td>'+
						'<td class="txt-oflo"> GH₵ '+value.contributionAmount+'</td>'+
						'<td class="txt-oflo">'+value.vendorName+'</td>'+
						'<td class="txt-oflo">'+value.dateOfContribution+'</td>'+
						'<td class="txt-oflo">'+value.modeOfPayment+'</td>'+
						 line +
                        '<td><button value="'+value.contributionId+'" class="btn btn-success" id="show-cont">View Details</button></td></tr>'
				);  
			});
		}).fail(function(data){
console.log(data);
		});
	});
}).on('click','.edit',function(e){
e.preventDefault();
var id = $("#contributionId").val();
console.log(id);

$.ajax({
    url: "/contributions/"+id,
    type: 'PUT',
    data: $("#frm-contrib").serialize(),
    success: function(data) {
        swal('ZESTSED GH','Contribution updated successfully','success');
    }
  });
}).on('click','.delete',function(e){
    e.preventDefault();
    var id = $("#contributionId").val();
    console.log(id);
    
    $.ajax({
        url: "/contributions/"+id,
        type: 'DELETE',
        data: $("#frm-contrib").serialize(),
        success: function(data) {
            swal('ZESTSED GH','Contribution updated successfully','success');
        }
      });
    });

</script>
@endsection