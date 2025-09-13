<option value="">Select a floor</option>
@foreach($floors as $floor)
<option value="{{$floor->id}}" {{ old('floor_id') == $floor->id ? 'selected' : '' }}>{{$floor->floor}}</option>
@endforeach