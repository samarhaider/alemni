@extends('admin.main')

@section('content')

		
<div class="container">			
	<div class="row">
		<div class="col-md-12">
			<div class=" panel panel-primary" data-collapsed="0">
			
				<div class="profilehead panel-heading">
					<div class=" panel-title pf-title">
						Add Khair To {{$tutor->profile->name or 'No Data'}}
					</div>
				</div>
				<div class="panel-body">
					<form role="form" class="form-horizontal form-groups-bordered" method="post" action="{{url('khair/'.$tutor->id)}}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Title</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Title">
							</div>
							@if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Start Date</label>
							<div class="col-sm-5">
								<div class="input-group">
									<input type="text" class="form-control datepicker" name="start_date" value="{{old('start_date')}}" data-format="yyyy-mm-dd">
									
									<div class="input-group-addon">
										<a href="#"><i class="entypo-calendar"></i></a>
									</div>
								</div>
							</div>
							@if ($errors->has('start_date')) <p class="help-block">{{ $errors->first('start_date') }}</p> @endif
						</div>
						
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Longitude</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control" id="longitude" name="longitude" value="{{old('longitude')}}">
							</div>
							@if ($errors->has('longitude')) <p class="help-block">{{ $errors->first('longitude') }}</p> @endif

						</div>
						
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Latitude</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control" id="latitude" name="latitude" value="{{old('longitude')}}" >
							</div>
							@if ($errors->has('latitude')) <p class="help-block">{{ $errors->first('latitude') }}</p> @endif
						</div>
						
						<div class="form-group">
							<div id="map" style="width:100%;height:400px;"></div>
						</div>
						
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Budget</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="budget" name="budget" placeholder="Budget" value="{{old('budget')}}">
							</div>
							@if ($errors->has('budget')) <p class="help-block">{{ $errors->first('budget') }}</p> @endif

						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Daily Timings</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control timepicker" name="daily_timing" data-template="dropdown" data-show-seconds="true" value="{{old('daily_timing')}}" data-default-time="11:25" data-show-meridian="true" data-minute-step="5">
							</div>
							@if ($errors->has('daily_timing')) <p class="help-block">{{ $errors->first('daily_timing') }}</p> @endif

						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Days</label>
							<div class="col-sm-5">
								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_0')) selected @endif  name="day_of_week_0">Sunday
									</label>
								</div>
								
								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_1')) selected @endif name="day_of_week_1">Monday
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_2')) selected @endif name="day_of_week_2">Tuesday
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_3')) selected @endif name="day_of_week_3">Wednesday
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_4')) selected @endif name="day_of_week_4">Thursday
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_5')) selected @endif name="day_of_week_5">Friday
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="checkbox" @if(old('day_of_week_6')) selected @endif name="day_of_week_6">Saturday
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Subjects</label>
							<div class="col-sm-5">
								<select name="subjects" class="form-control" >
									<option @if(old('subjects') == 'Maths') selected @endif value="Maths" >Maths</option>
									<option @if(old('subjects') == 'Science') selected @endif value="Science" >Science</option>
									<option @if(old('subjects') == 'Language') selected @endif value="Language" >Language</option>
									<option @if(old('subjects') == 'Test preparation') selected @endif value="Test preparation" >Test preparation</option>
									<option @if(old('subjects') == 'Elementary education') selected @endif value="Elementary education" >Elementary education</option>
									<option @if(old('subjects') == 'Computer') selected @endif value="Computer" >Computer</option>
									<option @if(old('subjects') == 'Business') selected @endif value="Business" >Business</option>
									<option @if(old('subjects') == 'History') selected @endif value="History" >History</option>
									<option @if(old('subjects') == 'Music') selected @endif value="Music" >Music</option>
									<option @if(old('subjects') == 'Special Needs') selected @endif value="Special Needs" >Special Needs</option>
									<option @if(old('subjects') == 'Sports/Recreation') selected @endif value="Sports/Recreation" >Sports/Recreation</option>
									<option @if(old('subjects') == 'Religion') selected @endif value="Religion" >Religion</option>
									<option @if(old('subjects') == 'Art') selected @endif value="Art" >Art</option>
								</select>
							</div>
							@if ($errors->has('subjects')) <p class="help-block">{{ $errors->first('subjects') }}</p> @endif

						</div>
						<div class="form-group">
							<label for="field-ta" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-5">
								<textarea class="form-control autogrow" id="field-ta" name="invite_description" placeholder="Description" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 48px;">{{old('description')}}</textarea>
							</div>
							@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif

						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Grade</label>
							<div class="col-sm-5" >
								<input type="text" class="form-control" id="invite_grade" value="{{old('invite_grade')}}" name="invite_grade" placeholder="Grade">
							</div>
							@if ($errors->has('invite_grade')) <p class="help-block">{{ $errors->first('invite_grade') }}</p> @endif

						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">End Date</label>
							
							<div class="col-sm-5">
								<div class="input-group">
									<input type="text" name="invite_end_date" class="form-control datepicker" value="{{old('invite_end_date')}}" data-format="yyyy-mm-dd">
									
									<div class="input-group-addon">
										<a href="#"><i class="entypo-calendar"></i></a>
									</div>
								</div>
							</div>
							@if ($errors->has('invite_end_date')) <p class="help-block">{{ $errors->first('invite_end_date') }}</p> @endif

						</div>
						<div class="form-group">
							<input type="submit" name="" class="btn btn-primary" value="Add">
						</div>	
					</form>
				</div>
			</div>
		
		</div>
	</div>
</div>
@endsection
@push('styles')
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{url('neon/js/select2/select2-bootstrap.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/select2/select2.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/selectboxit/jquery.selectBoxIt.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/daterangepicker/daterangepicker-bs3.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/icheck/skins/minimal/_all.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/icheck/skins/square/_all.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/icheck/skins/flat/_all.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/icheck/skins/futurico/futurico.css')}}">
	<link rel="stylesheet" href="{{url('neon/js/icheck/skins/polaris/polaris.css')}}">
	<style type="text/css">
		.help-block{
			color:red;
		}
	</style>	
@endpush
@push('scripts')
	<!-- Imported scripts on this page -->
	<script src="{{url('neon/js/select2/select2.min.js')}}"></script>
	<script src="{{url('neon/js/bootstrap-tagsinput.min.js')}}"></script>
	<script src="{{url('neon/js/typeahead.min.js')}}"></script>
	<script src="{{url('neon/js/selectboxit/jquery.selectBoxIt.min.js')}}"></script>
	<script src="{{url('neon/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{url('neon/js/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{url('neon/js/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{url('neon/js/moment.min.js')}}"></script>
	<script src="{{url('neon/js/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{url('neon/js/jquery.multi-select.js')}}assets/"></script>
	<script src="{{url('neon/js/icheck/icheck.min.js')}}"></script>
	<script type="text/javascript">
	var map;
    var image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
    function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 16
    });
    marker = new google.maps.Marker({
             map: map,
             icon: image
         });
    var geocoder = new google.maps.Geocoder();
    
    geocoder.geocode({
        'address': 'saudia arabia'
      }, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            map.fitBounds(results[0].geometry.viewport);
        }
    });
    google.maps.event.addListener(map, 'click', function (event) {
         $('#latitude').val(event.latLng.lat());
         $('#longitude').val(event.latLng.lng());
                 var geocoder = new google.maps.Geocoder();
                 geocoder.geocode({
                     'latLng':event.latLng
                 }, function (results, status) {
                     console.log(results, status);
                     if (status == google.maps.GeocoderStatus.OK) {
                         console.log(results);
                         var lat = results[0].geometry.location.lat(),
                             lng = results[0].geometry.location.lng(),
                             placeName = results[0].address_components[0].long_name,
                             latlng = new google.maps.LatLng(lat, lng);
                            marker.setPosition(latlng);
                    }
                });
            });
        }
 	$(document).ready(function()
	{
		

	});
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDInhqI1vL-r6K6b6qznsA2z9wdUU_2F0E&callback=initMap"></script>
@endpush