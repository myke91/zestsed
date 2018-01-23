@extends('layout') @section('content')

<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Dashboard</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					@guest
					<li>
						<a href="{{ route('login') }}">Login</a>
					</li>
					@else
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
					@endguest
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>

		<!-- .row -->
		<div class="row">
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="white-box analytics-info">
					<h3 class="box-title">Total Subscriptions
						<small>APPROVED</small>
					</h3>
					<ul class="list-inline two-part">
						<li>
							<div id="sparklinedash"></div>
						</li>
						<li class="text-right">
							<i class="ti-arrow-up text-success"></i>
							<span class="counter text-success">{{$registration}}</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="white-box analytics-info">
					<h3 class="box-title">Total Contributions
						<small>APPROVED</small>
					</h3>
					<ul class="list-inline two-part">
						<li>
							<div id="sparklinedash2"></div>
						</li>
						<li class="text-right">
							<i class="ti-arrow-up text-purple"></i>
							<span class="counter text-purple">{{$contribution}}</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="white-box analytics-info">
					<h3 class="box-title">Total Investments
						<small>UNITS</small>
					</h3>
					<ul class="list-inline two-part">
						<li>
							<div id="sparklinedash3"></div>
						</li>
						<li class="text-right">
							<i class="ti-arrow-up text-info"></i>
							<span class="counter text-info">{{$investment}}</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--/.row -->
		<!--row -->
		<!-- /.row -->
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<div class="white-box">
					<h3 class="box-title">Overview</h3>
					<ul class="list-inline text-right">
						<li>
							<h5>
								<i class="fa fa-circle m-r-5 text-info"></i>Contributions</h5>
						</li>
						<li>
							<h5>
								<i class="fa fa-circle m-r-5 text-inverse"></i>Investments</h5>
						</li>
					</ul>
					<div id="ct-visits" style="height: 405px;"></div>
				</div>
			</div>
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
								<button class="btn btn-info contribution-filter" type="button">
									<i class="fa fa-search">SEARCH</i>
								</button>
							</div>
						</form>
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
									<td class="txt-oflo">GH₵ {{$cont->contributionAmount}}</td>
									<td>{{$cont->vendorName}}</td>
									<td class="txt-oflo">{{$cont->dateOfContribution}}</td>
									<td>
										<span class="text-success">Mode of Payment: {{$cont->modeOfPayment}} / Source of Payment: {{$cont->sourceOfPayment}} / Date of Approval: {{$cont->dateOfApproval}}</span>
									</td>
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
		<!-- ============================================================== -->
		<!-- investments table -->
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
								<button class="btn btn-info investment-filter" type="button">
									<i class="fa fa-search">SEARCH</i>
								</button>
							</div>
						</form>
					</div>
					<h3 class="box-title">List of Investments</h3>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>CONTRIBUTOR</th>
									<th>QUOTA AMOUNT</th>
									<th>CURRENT VALUE</th>
									<th>INVESTMENT PERIOD</th>
									<th>CYCLE PERIOD</th>
								</tr>
							</thead>
							@foreach($invests as $invest)
							<tbody>
								<tr>
									<td>{{$invest->firstName}} {{$invest->otherNames}} {{$invest->lastName}}</td>
									<td class="txt-oflo">GH₵ {{$invest->quotaAmount}}</td>
									<td class="txt-oflo">GH₵ {{$invest->quotaWithInterest}}</td>
									<td class="txt-oflo">{{$invest->quotaMonth}} {{$invest->quotaYear}}</td>
									<td class="txt-oflo">{{$invest->cycleMonth}} {{$invest->cycleYear}}</td>
								</tr>
							</tbody>
							@endforeach
						</table>
					</div>
					<div class="row">
						<div class="col-md-10 ">
							{{$invests->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection