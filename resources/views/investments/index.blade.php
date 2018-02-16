@extends('layout') @section('content')
<style>
	#myInput {

		background-position: 10px 12px;
		/* Position the search icon */
		background-repeat: no-repeat;
		/* Do not repeat the icon image */
		width: 100%;
		/* Full-width */
		font-size: 16px;
		/* Increase font-size */
		border: 1px solid #ddd;
		/* Add a grey border */
		margin-bottom: 12px;
		/* Add some space below the input */
	}
</style>
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Investments</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li>
						Add Investments
					</li>
					<li>
						<a href="/investments">Investments</a>
					</li>
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
					<h3 class="box-title">List of Investments for current month</h3>
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
					<div class="table-responsive">
						<table class="table" id="investTable">
							<thead>
								<tr>
									<th>CONTRIBUTOR</th>
									<th>INITIAL QUOTA</th>
									<th>ROLLOVER QUOTA</th>
									<th>INTEREST AMOUNT</th>
									<th>CUMMULATIVE INTEREST</th>
									<th>INV. CYCLE</th>
									<th>DATE OF CONTRIBUTION</th>
								</tr>
							</thead>
							@forelse($invests as $invest)
							<tbody>
								<tr>
									<td>{{$invest->firstName." ".$invest->otherNames." ".$invest->lastName}}</td>
									<td class="txt-oflo"> GH₵ {{$invest->quotaAmount}}</td>
									<td class="txt-oflo"> GH₵ {{$invest->quotaRollover}}</td>
									<td class="txt-oflo"> GH₵ {{$invest->interestAmount}}</td>
									<td class="txt-oflo"> GH₵ {{$invest->cumulativeInterest}}</td>
									<td class="txt-oflo">{{$invest->cycleMonth." ".$invest->cycleYear}}</td>
									<td class="txt-oflo">{{$invest->quotaMonth." ".$invest->quotaYear}}</td>
								</tr>
							</tbody>
							@empty No data @endforelse
						</table>
					</div>
					<div class="row">
						<div class="col-md-10 page-links">
							{{$invests->links()}}
						</div>
						<div class="row pull-right"></div>
							<div class="col-md-10 ">
								<a href="/correctInvestment">
									<button class="btn btn-info" ><i class="fa fa-check-square-o"></i>&nbsp;Correct First Cycle</button>
								</a>
								<a href="/process-eom">
									<button class="btn btn-success" ><i class="fa fa-refresh"></i>&nbsp;Synchronized Investments</button>
								</a>
								
							</div>
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
  	$(".select-all").change(function() {
		if($(this).is(':checked')){
			$(".select").prop("checked", true);
			return false;
		}else{
			$(".select").prop("checked", false);
			return false;	
		}
	
	});

	$(".filter").click(function() {
		var month = $('.month').val();
		var year = $('.year').val();
		$.get('/invest-filter', {month: month,year: year}, function (data) {
			$('#investTable tbody').empty();
			$('.page-links').hide();
			$.each(data, function (i, value) {
				var middleName = value.otherNames === null ? '' : value.otherNames;
				var cycleMonth = value.cycleMonth === null ? '' : value.cycleMonth;
				var cycleYear = value.cycleYear === null ? '' : value.cycleYear;
				  $('#investTable').append('<tr><td><input class="select" name="investment[]" type="checkbox" value="'+value.investmentId+'" /></td>'+
						'<td>'+value.firstName+' '+ middleName +' '+value.lastName+'</td>'+
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

	$("#execute-eom").click(function(e) {
		e.preventDefault();
		console.log('click received for eom');
		var batch = [];
		$(".select:checked").each(function() {
			batch.push($(this).val());
		});

		$.post('/process-eom', {batch}, function (data) {
			console.log(data);
			swal('ZESTSED GH','Investment cycle completed successfully','success');
		}).fail(function(data){
			console.log(data);
			swal('ZESTSED GH','Investment cycle processing failed. \r\n Contact Administrator.','error');
		});
	});
});

</script>
@endsection