@extends('admin.main')

@section('content')

<div class="container">
	<div class="row">
		<div class="clientprofile col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >
			<div class="profileinfo panel panel-info">
				<div class="profilehead panel-heading">
					<h2 class="panel-title pf-title" >All Users</h2>
				</div>
				<div class="profilebody panel-body">
					<table id="myTable" class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Gender</th>
								<th>Type</th>
								<th>Avatar</th>
								<th>Address</th>
								<th>Hourly Rate</th>
								<th>Email</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr>
								<td><a href="{{url('user/'.$user->id)}}">{{$user->profile->name or 'no data'}}</a></td>
								<td>{{$user->profile->gender or 'no data'}}</td>
								<td>@if($user->user_type == 2) Student @elseif($user->user_type == 3) Teacher @elseif($user->user_type == 1) Admin @endif</td>
								<td><img src="{{url($user->profile->avatar) or url('upload\avatar\default.jpg')}}" alt="No image"></td>
								<td>{{$user->profile->address or 'no data'}}</td>
								<td>{{$user->profile->hourly_rate or 'no data'}}</td>
								<td>{{$user->email or 'no data'}}</td>
								@if($user->block == 1)
								<td><a href="{{url('user/'.$user->id.'/unblock')}}" class="btn btn-blue btn-icon">Unblock<i class="entypo-user"></i> </a></td>
								@else
								<td><a href="{{url('user/'.$user->id.'/block')}}" class="btn btn-blue btn-icon">Block<i class="entypo-block"></i> </a></td>
								@endif
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