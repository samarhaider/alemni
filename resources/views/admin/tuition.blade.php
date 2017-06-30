@extends('admin.main')

@section('content')
<div class="container">
			<div class="row">
				<div class="clientprofile col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >
					<div class="profileinfo panel panel-info">
						<div class="profilehead panel-heading">
							<h3 class="panel-title pf-title">Tution Information</h3>
						</div>
						<div class="profilebody panel-body">
							<div class="row">
								<div class=" col-md-12 col-lg-12 ">
									<table class="table  table-user-information proftableinfo">
										<tbody>
											<tr>
												<td>Title:</td>
												<td>{{$tution->title}}</td>
											</tr>
											<tr>
												<td>Student Name:</td>
												<td>@if(isset($tution->studentUser))<a href="{{url('user/'.$tution->studentUser->id)}}">{{$tution->studentProfile->name or 'no data'}} @endif</a></td>
											</tr>
											<tr>
												<td>Tutor Name:</td>
												<td>@if(isset($tution->tutorUser))<a href="{{url('user/'.$tution->tutorUser->id)}}">{{$tution->tutorProfile->name or 'no data'}}</a>@else No Data @endif </td>
											</tr>
											<tr>
												<td>Budget:</td>
												<td>{{$tution->budget or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Status:</td>
												<td> @if($tution->status == 1 ) new @elseif($tution->status == 2) In Progress @elseif($tution->status == 3) Completed @elseif($tution->status == 4) Cancelled @else No Data @endif</td>
											</tr>
											<tr>
												<td>Type:</td>
												<td>@if($tution->private == 1)Invited @elseif($tution->private == 0) Offer @endif</td>
											</tr>
											<tr>
												<td>Start Date:</td>
												<td>{{$tution->start_date or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Daily Timings:</td>
												<td>{{$tution->daily_timing or 'No Data'}}</td>
											</tr>
											<tr>
												<td>City:</td>
												<td>{{$tution->city or 'No Data'}}</td>
											</tr>
											<tr>
												<td>State:</td>
												<td>{{$tution->state or 'No Data'}}</td>
											</tr>

											<tr>
												<td>Date:</td>
												<td>{{$tution->date or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Time:</td>
												<td>{{$tution->time or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Description:</td>
												<td>{{$tution->description or 'No Data'}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
@endsection
