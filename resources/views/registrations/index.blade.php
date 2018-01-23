@extends('layout')
@section('content')
@include('registrations.RegistrationDetails')
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
                    <div class="row col-md-3 col-sm-4 col-xs-6 pull-right">
						<form class="form-horizontal">
							<div class="col-md-4">
								<select class="form-control month">
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>Jul</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>
							</div>
							<div class="col-md-4">
								<input class="form-control year" type="text" placeholder="YEAR" />
							</div>
							<div class="col-md-4">
								<button class="btn btn-info filter" type="button">
									<i class="fa fa-search">SEARCH</i>
								</button>
							</div>
						</form>
					</div>
                    <h3 class="box-title">List of Registrations</h3>
                    <div class="table-responsive">
                        <table class="table" id="registrationTable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NUMBER</th>
                                    <th>OCCUPATION</th>
                                    <th>NEXT OF KIN</th>
                                    <th>OCCUPATION</th>
                                    <th colspan="2">APPROVE</th>
                                </tr>
                            </thead>
                            @foreach($regs as $reg)
                            <tr>
                                <td>{{$reg->firstName." ".$reg->otherNames." ".$reg->lastName}}</td>
                                <td class="txt-oflo">{{$reg->email}} </td>
                                <td>{{$reg->phoneNumber}}</td>
                                <td class="txt-oflo">{{$reg->occupation}}</td>
                                <td>{{$reg->nextOfKin}}</td>
                                <td>
                                    {{$reg->occupation}}
                                </td>
                                <td>
                                    @if($reg->isApproved == 1)
                                    <i class="fa fa-check" id="checked"></i>
                                    @else
                                    <a href="{{route('approveRegistration',$reg->registrationId)}}" onclick="return confirm('Are you sure you want to approve this registration?');"><i class="fa fa-times" id="notchecked"></i></a>
                                    @endif
                                </td>
                                <td><Button value="{{$reg->registrationId}}" class="btn btn-success" id="show-reg">View Details</Button></td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-10 page-links">
                            {{$regs->links()}}
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
	$(".filter").click(function() {
		var month = $('.month').val();
		var year = $('.year').val();
		$.get('/registration-filter', {month: month,year: year}, function (data) {
			$('#registrationTable tbody').empty();
			$('.page-links').hide();
			$.each(data.data, function (i, value) {
				var middleName = value.otherNames === null ? '' : value.otherNames;
				var cycleMonth = value.cycleMonth === null ? '' : value.cycleMonth;
				var cycleYear = value.cycleYear === null ? '' : value.cycleYear;
				  $('#registrationTable').append('<tr><td><input class="select" name="investment[]" type="checkbox" value="'+value.investmentId+'" /></td>'+
						'<td>'+value.firstName+' '+ +' '+value.lastName+'</td>'+
						'<td class="txt-oflo"> GH₵ '+value.quotaAmount+'</td>'+
						'<td class="txt-oflo"> GH₵ '+value.quotaRollover+'</td>'+
						'<td class="txt-oflo"> GH₵ '+value.interestAmount+'</td>'+
						'<td class="txt-oflo"> GH₵ '+value.cumulativeInterest+'</td>'+
						'<td class="txt-oflo">'+cycleMonth+' '+cycleYear+'</td>'+
						'<td class="txt-oflo">'+value.quotaMonth+' '+value.quotaYear+'</td></tr>'
				);  
			});
		}).fail(function(data){

		});
	});
});

</script>
@endsection