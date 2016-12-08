@extends('backend')

@section('content')

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        Edit Place
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="{{ URL::to('places') }}">Places</a></li>
            <li class="active"> Edit Place: {{ $place->name }} </li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Place: {{ $place->name }}
                </header>
                <div class="panel-body">
                    @include('admin.partials.error')
                    <div class="form">
                        {!! Form::model($place, ['method' => 'PATCH', 'url' => 'places/'.$place->id, 'id' => 'editpage', 'class' => 'cmxform form-horizontal tasi-form', 'files' => TRUE]) !!}
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">Name</label>
                                <div class="col-lg-5">
                                    {!! Form::text('name', $place->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="rate" class="control-label col-lg-2">Rate</label>
                                <div class="col-lg-5">
                                    {!! Form::text('rate', $place->rate, ['class' => 'form-control', 'id' => 'rate']) !!}
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="address" class="control-label col-lg-2">Address</label>
                                <div class="col-lg-5">
                                    {!! Form::text('address', $place->address, ['class' => 'form-control', 'id' => 'address']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="file-4" class="control-label col-lg-2">Thumbnail</label>
                                <div class="col-lg-10">
                                    {!! Form::file('thumbnail', ['class' => 'file']) !!}
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2">
                                        <img src="{{ $place->thumbnail }}" width="150">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Working From</label>
                                <div class="col-md-4">
                                    <div class="input-group bootstrap-timepicker">
                                        {!! Form::text('working_from', $place->working_from, ['class' => 'form-control timepicker-default', 'id' => 'working_from']) !!}
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Working To</label>
                                <div class="col-md-4">
                                    <div class="input-group bootstrap-timepicker">
                                        {!! Form::text('working_to', $place->working_to, ['class' => 'form-control timepicker-default', 'id' => 'working_to']) !!}
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategory" class="control-label col-lg-2">Subcategory</label>
                                <div class="col-lg-5">
                                    <select id="subcategory" class="form-control m-b-10 select2" name="subcategory_id">
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" {{ $place->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-md-4 control-label">Facilities</label>
                                <div class="col-lg-9 col-md-8">
                                    <div class="input-group select2-bootstrap-append">
                                        <select id="single-append-text" class="form-control select2-allow-clear" name="facilities[]" multiple>
                                            @foreach ($facilities as $key => $value)
                                                <option value="{{$key}}" {{ in_array($key, $place->facilities->lists('id')->toArray()) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach

                                        </select>
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                          <span class="glyphicon glyphicon-search"></span>
                                      </button>
                                    </span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label col-lg-2">Location</label>
                                <div class="col-lg-10">
                                    <input id="pac-input" class="controls" type="text" placeholder="Search Place">
                                    <div id="map"></div>
                                </div>
                            </div>
                            {!! Form::hidden('latitude', $place->latitude, ['class' => 'form-control', 'id' => 'latitude']) !!}
                            {!! Form::hidden('longitude', $place->longitude, ['class' => 'form-control', 'id' => 'longitude']) !!}
                            <div class="form-group" style="border-bottom: 0;padding-bottom: 0">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Save</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
<!--body wrapper end-->
<style>

#map {
        height: 500px;
        width: 100%;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#target {
  width: 345px;
}
</style>


@endsection

@section('scripts')
<script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: {{$place->latitude}}, lng: {{$place->longitude}}},
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
   google.maps.event.addDomListener(input, 'keydown', function(e) { 
    if (e.keyCode == 13) { 
        e.preventDefault(); 
    }
  }); 
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  markers.push(new google.maps.Marker({
        map: map,
        position: {lat: {{$place->latitude}}, lng: {{$place->longitude}}}
      }));
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        title: place.name,
        position: place.geometry.location
      }));
      $('#latitude').val(place.geometry.location.lat());
      $('#longitude').val(place.geometry.location.lng());
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  // [END region_getplaces]
}


    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqXER2UNvYRlhkaNqsp-m0fB7HYBFHObI&libraries=places&callback=initAutocomplete" async defer></script>

@endsection

    