@extends('frontend.index')
@section('homeContent')
        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Edit property</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area submit-property" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">
                <div class="clearfix" > 
                    <div class="wizard-container"> 
                    	@php $user = Auth::user(); @endphp
                        <div class="wizard-card ct-wizard-blue" id="wizardProperty">
                            <form action="{{route('unit.updateformsubmit',$unit->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf                        
                                <div class="wizard-header">
                                    <h3>
                                        <b>Edit</b> YOUR PROPERTY <br>
                                        <small>Fill in the required fields.</small>
                                    </h3>
                                </div>

                                <ul>
                                    <li><a href="#step1" data-toggle="tab">Step 1 </a></li>
                                    <li><a href="#step2" data-toggle="tab">Step 2 </a></li>
                                    <li><a href="#step3" data-toggle="tab">Step 3 </a></li>
                                    <li><a href="#step4" data-toggle="tab">Finished </a></li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane" id="step1">
                                        <div class="row p-b-15  ">
                                            <h4 class="info-text"> Let's start with the basic information (with validation)</h4>
                                            <div class="col-sm-4 col-sm-offset-1">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                    	@php $old_photo = $unit->user_photo @endphp
                                                    	@if($old_photo)
                                                    	<input type="hidden" name="old_photo" value="{{$old_photo}}">
                                                        <img src="{{URL::to($old_photo)}}" class="picture-src" id="wizardPicturePreview" title=""/>
                                                        @else
                                                        <img src="{{asset('public/frontend/assets/img/default-property.jpg')}}" class="picture-src" id="wizardPicturePreview" title=""/>
                                                        @endif
                                                        <input name="photo" type="file" id="wizard-picture">
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Unit No <small>(required) (e.g: A4, B3 or 2nd floor right side)</small></label>
                                                    <input name="number" type="text" class="form-control" placeholder="Super villa ..." value="{{$unit->number}}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Price <small>(required) (if your property is for rent then enter monthly rent)</small></label>
                                                    <input name="price" type="number" class="form-control" placeholder="3330000" value="{{$unit->price}}" required>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Telephone <small>(Keep it unchanged if you wanna use Account phone number)</small></label>
                                                    <input name="phone" type="tel" class="form-control" placeholder="+1 473 843 7436" value="{{$unit->phone}}" required >
                                                </div>

                                                <div class="form-group">
                                                    <label>Address <small></small></label>
                                                    <textarea name="address" class="form-control" required>{{$unit->address}}</textarea>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End step 1 -->

                                    <div class="tab-pane" id="step2">
                                        <h4 class="info-text"> How much your Property is Beautiful ? </h4>
                                        <div class="row">
                                            <div class="col-sm-12"> 
                                                <div class="col-sm-12"> 
                                                    <div class="form-group">
                                                        <label>Property Description :</label>
                                                        <textarea name="description" class="form-control" required>{{$unit->description}}</textarea>
                                                    </div> 
                                                </div> 
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Property State :</label>
                                                        <select id="states" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Select your city" name="state_id" required>
                                                            <option value="">Please select an State</option>
                                                            @foreach($states as $state)
                                                            <option {{$state->id == $unit->state_id ? 'selected' : ''}}  value="{{$state->id}}">{{$state->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Property City :</label>
                                                        <select id="cities" class="selectpicker " data-live-search="true" data-live-search-style="begins" title="Select your city" name="city_id" required>
                                                            <option value="">Select an state first</option>
                                                            <option selected value="{{$unit->city_id}}">{{$unit->city->name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Property Area :</label>
                                                        <select id="areas" class="selectpicker " data-live-search="true" data-live-search-style="begins" title="Select your city" name="area_id" required>
                                                            <option value="">Select a city first</option>
                                                            <option selected value="{{$unit->area_id}}">{{$unit->area->name}}</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Property Type  :</label>
                                                        <select id="basic" class="selectpicker show-tick form-control" name="type" required>
                                                            <option value=""> -Type- </option>
                                                            <option {{$unit->type == 'rent' ? 'selected' : ''}} value="rent">Rent </option>
                                                            <option {{$unit->type == 'sell' ? 'selected' : ''}} value="sell">Sell</option> 

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Property Status  :</label>
                                                        <select id="basic" class="selectpicker show-tick form-control" name="condition" required>
                                                            <option value=""> -Status- </option>
                                                            <option {{$unit->condition == 'new' ? 'selected' : ''}} value="new">New</option>
                                                            <option {{$unit->condition == 'used' ? 'selected' : ''}} value="used">Used</option>  

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Property Size  :</label>
                                                        <input class="form-control" type="number" name="area_sqft" value="{{$unit->area_sqft}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Build Date  :</label>
                                                        <input class="form-control" type="date" name="build_date" value="{{$unit->build_date?->format('Y-m-d')}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Level  :</label>
                                                        <input class="form-control" type="number" name="floor" value="{{$unit->floor}}" required>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-12 padding-top-15">                                                   
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="property-geo">Number of bedrooms :</label>
                                                        <input type="number" name="bedrooms" class="form-control" value="{{$unit->bedrooms}}"  required><br />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="property-geo">Number of bathrooms :</label>
                                                        <input type="number" name="bathrooms" class="form-control" value="{{$unit->bathrooms}}" required ><br />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="property-geo">Number of balconies :</label>
                                                        <input type="number" name="balconies" class="form-control" value="{{$unit->balconies}}" required ><br />
                                                    </div>
                                                </div>
                                                   
                                            </div>
								@php
								    $features = $unit->features;
								@endphp

                                            <div class="col-sm-12 padding-top-15">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                               <input {{ in_array('wifi', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="wifi"> Wifi
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input {{ in_array('parking', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="parking">Parking
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>                                                 
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input {{ in_array('swimming', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="swimming"> Swimming pool
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>                                                 
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input {{ in_array('gym', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="gym"> Gym 
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="col-sm-12 padding-bottom-15">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input {{ in_array('center', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="center"> Convention Center
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input {{ in_array('elevator', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="elevator"> Elevator
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input {{ in_array('generator', $features) ? 'checked' : '' }} name="features[]" type="checkbox" value="generator"> Generator
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <!-- End step 2 -->

                                    <div class="tab-pane" id="step3">                                        
                                        <h4 class="info-text">Give us somme images and videos ? (Videos are optional)</h4>
                                        <div class="row">  
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="property-images">Chose Images :</label>
                                                    @if($unit->image_path)
                                                    <input id="old_images" type="hidden" name="old_images" value="{{$unit->image_path}}">
                                                    @php $images = explode("|",$unit->image_path) @endphp

                                                    <label>Old images</label>
                                                    @foreach($images as $img)
                                                    <img src="{{URL::to($img)}}">
                                                    @endforeach
                                                    @endif
                                                    <input class="form-control" type="file" id="property-images" name="image[]" multiple  required>
                                                    <p class="help-block">Select multipel images for your property .</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6"> 
                                                <div class="form-group">
                                                    <label for="property-video">Property video :</label>
                                                    <input class="form-control" value="" placeholder="http://www.youtube.com, http://vimeo.com" name="property_video" type="text" name="video[]">
                                                </div> 

                                                <div class="form-group">
                                                    <input class="form-control" value="" placeholder="http://www.youtube.com, http://vimeo.com" name="property_video" type="text" name="video[]">
                                                </div>

                                                <div class="form-group">
                                                    <input class="form-control" value="" placeholder="http://www.youtube.com, http://vimeo.com" name="property_video" type="text" name="video[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End step 3 -->


                                    <div class="tab-pane" id="step4">                                        
                                        <h4 class="info-text"> Finished and submit </h4>
                                        <div class="row">  
                                            <div class="col-sm-12">
                                                <div class="">
                                                    <p>
                                                        <label><strong>Terms and Conditions</strong></label>
{{Str::limit($setting->terms_conditions, 200)}}<a class="btn btn-info" target="_blank" href="{{url('/terms-conditions')}}">Read more</a>
                                                    </p>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input id="checkbox" checked required type="checkbox" /> <strong>Accept termes and conditions.</strong><div id="terms-error">You must agree to our terms & conditions</div>
                                                        </label>
                                                    </div> 

                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End step 4 -->

                                </div>
                                
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-primary' name='next' value='Next' />
                                        <input type='submit' id="finish-step" class='btn btn-finish btn-primary ' name='finish' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-default' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>                                            
                                </div>	
                            </form>
                        </div>
                        <!-- End submit form -->
                    </div> 
                </div>
            </div>
        </div>
@endsection