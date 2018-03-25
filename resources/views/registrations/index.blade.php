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
								<button class="btn btn-info filter" type="button">
									<i class="fa fa-search">SEARCH</i>
								</button>
							</div>
						</form>
					</div>
                    <h3 class="box-title">List of Registrations</h3>
                    <div class="table-responsive">
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
                        <table class="table" id="registrationTable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NUMBER</th>
                                    <th>OCCUPATION</th>
                                    <th>NEXT OF KIN</th>
                                    <th>OCCUPATION</th>
                                    <th colspan="3" style="text-align:center">ACTIONS</th>
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
                                <td><a href="{{route('resetPassword',$reg->registrationId)}}" onclick="return confirm('Are you sure you want to reset this user\'s password?');">
                                        <Button class="btn btn-danger">Reset Password</Button>
                                    </a>
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
            console.log(data);
			$('#registrationTable tbody').empty();
			$('.page-links').hide();
			$.each(data, function (i, value) {
                var middleName = value.otherNames === null ? '' : value.otherNames;
                if(value.isApproved == 1){
                    var line = '<td><i class="fa fa-check" id="checked"></i></td>';
                }else{
                    var line = '<td><a href="/registration/approve/'+ value.registrationId +'" onclick="return confirm(\'Are you sure you want to approve this registration?\');"><i class="fa fa-times" id="notchecked"></i></a></td>';
                }
				  $('#registrationTable').append('<tr>'+
						'<td>'+value.firstName+' '+ middleName +' '+value.lastName+'</td>'+
						'<td class="txt-oflo"> '+value.email+'</td>'+
						'<td class="txt-oflo"> '+value.phoneNumber+'</td>'+
						'<td class="txt-oflo"> '+value.occupation+'</td>'+
						'<td class="txt-oflo"> '+value.nextOfKin+'</td>'+
                        line +
						'<td><button value="'+value.registrationId+'" class="btn btn-success" id="show-reg">View Details</button></td></tr>'
				);  
			});
		}).fail(function(data){
console.log(data);
		});
	});
});

</script>
@endsection