@extends('admin.main')

@section('content')
<div class="container">
	<div class="row">
		<div class="clientprofile col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >
			<div class="profileinfo panel panel-info">
				<div class="profilehead panel-heading">
					<h2 class="panel-title pf-title" >All Tutions</h2>
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
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
						@foreach($khairs as $tuition)
							<tr>
								<td><a href="{{url('tuition/'.$tuition->id)}}">{{$tuition->title or 'no data'}}</a></td>
								<td>@if(isset($tuition->studentUser))<a href="{{url('user/'.$tuition->studentUser->id)}}">{{$tuition->studentProfile->name or 'no data'}}</a>@else No Data @endif</td>
								<td>@if(isset($tuition->tutorUser))<a href="{{url('user/'.$tuition->tutorUser->id)}}">{{$tuition->tutorProfile->name or 'no data'}}</a>@else No Data @endif</td>
								<td>{{$tuition->budget or 'no data'}}</td>
								<td>@if($tuition->status == 1 ) new @elseif($tuition->status == 2) In Progress @elseif($tuition->status == 3) Completed @elseif($tuition->status == 4) Cancelled @else No Data @endif</td>
								<td>@if($tuition->private == 1)Invited @elseif($tuition->private == 0) Offer @elseif($tuition->private == 2 ) Khair @endif</td>
								<td><a href="{{url('khair/'.$tuition->id.'/delete')}}" class="btn btn-red btn-icon">Delete<i class="entypo-trash"></i> </a></td>
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