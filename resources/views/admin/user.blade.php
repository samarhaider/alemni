@extends('admin.main')

@section('content')
<div class="container">
			<div class="row">
				<div class="clientprofile col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >
					<div class="profileinfo panel panel-info">
						<div class="profilehead panel-heading">
							<h3 class="panel-title pf-title">{{$user->profile->name or 'No Data'}} ( <span> @if($user->user_type == 2) Student @elseif($user->user_type == 3) Teacher @endif</span> )</h3>
						</div>
						<div class="profilebody panel-body">
							<div class="row">
								<div class="profimg col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{url($user->profile->avatar) or url('upload\avatar\default.jpg')}}" class="img-rounded img-responsive"> </div>
								<div class=" col-md-9 col-lg-9 ">
									<table class="table  table-user-information proftableinfo">
										<tbody>
											<tr>
												<td>City:</td>
												<td>{{$user->profile->city or 'No Data'}}</td>
											</tr>
											<tr>
												<td>State:</td>
												<td>{{$user->profile->state or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Address:</td>
												<td>{{$user->profile->address or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Gender:</td>
												<td>{{$user->profile->gender or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Paypal Address:</td>
												<td>{{$user->profile->paypal_address or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Email:</td>
												<td>{{$user->email}}</td>
											</tr>
											<tr>
												<td>Teaches:</td>
												<td>{{$user->profile->teaches or 'No Data'}}</td>
											</tr>
											<tr>
												<td>Specialist:</td>
												<td>{{$user->profile->specialist or "No Data"}}</td>
											</tr>
											<tr>
												<td>Hourly Rate:</td>
												<td>{{$user->profile->hourly_rate or 'No Data'}}</td>
											</tr>

											<tr>
												<td>Bio:</td>
												<td>{{$user->profile->bio or 'No Data'}}</td>
											</tr>
											
										</tbody>
									</table>
									
								</div>
							</div>
						</div>
						<div class="proffooter panel-footer">
							@if($user->user_type == 3)
							<a data-original-title="Send Khair" href="{{url('khair/'.$user->id.'/create')}}" data-toggle="tooltip" type="button" class="btn btn-blue btn-icon">Send Khair<i class="glyphicon glyphicon-envelope"></i></a>
							@endif
							<span @if($user->user_type == 3 ) class="pull-right" @endif>
								@if($user->block == 1)
								<a data-original-title="Block/Unblock this user" href="{{url('user/'.$user->id.'/unblock')}}" data-toggle="tooltip" type="button" class="btn btn-sm profmsgbtn">
								Unblock</a>
								@else
								<a data-original-title="Block/Unblock this user" href="{{url('user/'.$user->id.'/block')}}" data-toggle="tooltip" type="button" class="btn btn-sm profmsgbtn">Block</a> @endif
							</span>
						</div>
						
					</div>
				</div>
			</div>
		</div>
<div class="container">
	<div class="row">
		<div class="clientprofile col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >
			<div class="profileinfo panel panel-info">
				<div class="profilehead panel-heading">
					<h2 class="panel-title pf-title" >Tuitions</h2>
				</div>
				<div class="profilebody panel-body">
					<table id="myTable" class="table table-bordered">
						<thead>
							<tr>
								<th>Title</th>
								<th>Student Name</th>
								<th>Tutor Name</th>
								<th>Budget</th>
								<th>Status</th>
								<th>Type</th>
							</tr>
						</thead>
						<tbody>
						@foreach($user->tuitions as $tuition)
							<tr>
								<td><a href="{{url('tuition/'.$tuition->id)}}">{{$tuition->title or 'no data'}}</a></td>
								<td>@if(isset($tuition->studentUser))<a href="{{url('user/'.$tuition->studentUser->id)}}">{{$tuition->studentProfile->name or 'no data'}}</a>@else No Data @endif</td>
								<td>@if(isset($tuition->tutorUser))<a href="{{url('user/'.$tuition->tutorUser->id)}}">{{$tuition->tutorProfile->name or 'no data'}}</a>@else No Data @endif</td>
								<td>{{$tuition->budget or 'no data'}}</td>
								<td>@if($tuition->status == 1 ) new @elseif($tuition->status == 2) In Progress @elseif($tuition->status == 3) Completed @elseif($tuition->status == 4) Cancelled @else No Data @endif</td>
								<td>@if($tuition->private == 1)Invited @elseif($tuition->private == 0) Offer @endif</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
    $('#myTable').DataTable();

})
</script>	
@endpush