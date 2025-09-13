<option value="">Select an area</option>
@foreach($areas as $area)
<option value="{{$area->id}}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{$area->name}}</option>
@endforeach