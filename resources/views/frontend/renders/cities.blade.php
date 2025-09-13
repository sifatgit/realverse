<option value="">Select a City</option>
@foreach($cities as $city)
<option value="{{$city->id}}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{$city->name}}</option>
@endforeach