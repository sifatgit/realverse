@extends('frontend.index')
@section('homeContent')
        <!-- property area -->
        <div class="content-area single-property" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   

                <div class="clearfix padding-top-40" >

                    <div class="col-md-8 single-property-content prp-style-1 ">
                        <div class="row">
                            <div class="light-slide-item">            
                                <div class="clearfix">
                                    <div class="favorite-and-print">
                                        <a class="printer-icon " href="javascript:window.print()">
                                            <i class="fa fa-print"></i> 
                                        </a>
                                    </div> 

                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                    	@php $images = explode(",",$unit->image_path) @endphp
                                    	
                                        @foreach($images as $image)
                                        @if(file_exists($image) || filter_var($image , FILTER_VALIDATE_URL))
                                        <li data-thumb="{{URL::to($image)}}"> 
                                            <img src="{{URL::to($image)}}" />
                                        </li>
                                        @else
                                        <li data-thumb="{{asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png')}}"> 
                                            <img src="{{asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png')}}" />
                                        </li>
                                        @endif                                        
                                        @endforeach
                                        

                                        
                                                                                
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-property-wrapper">
                            <div class="single-property-header">                                          
                                <h1 class="property-title pull-left">{{$unit->number}}</h1>
                                <span class="property-price pull-right">${{number_format($unit->price)}}</span>
                            </div>

                            <div class="property-meta entry-meta clearfix ">   

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-tag">                                        
                                        <img src="{{asset('public/frontend/assets/img/icon/sale-orange.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Status</span>
                                        <span class="property-info-value">{{$unit->condition}}</span>
                                    </span>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info icon-area">
                                        <img src="{{asset('public/frontend/assets/img/icon/room-orange.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Area</span>
                                        <span class="property-info-value">{{$unit->area_sqft}} <b class="property-info-unit">Sq Ft</b></span>
                                    </span>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info icon-area">
                                        <img src="{{asset('public/frontend/assets/img/icon/room-orange.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Common Area</span>
                                        <span class="property-info-value">N/A <b class="property-info-unit"></b></span>
                                    </span>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bed">
                                        <img src="{{asset('public/frontend/assets/img/icon/bed-orange.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Bedrooms</span>
                                        <span class="property-info-value">{{$unit->bedrooms}}</span>
                                    </span>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bath">
                                        
                                        <img src="{{asset('public/frontend/assets/img/icon/shawer-orange.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Bathrooms</span>
                                        <span class="property-info-value">{{$unit->bathrooms}}</span>
                                    </span>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-garage">

                                        <img src="{{asset('public/frontend/assets/img/icon/os-orange.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Balconies</span>
                                        <span class="property-info-value">{{$unit->balconies}}</span>
                                    </span>
                                </div>                                

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bed">
                                        <img src="{{asset('public/frontend/assets/img/icon/cars-orange.png')}}">
                                    </span>
                                    @php $features = $unit->features @endphp
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Car garages</span>
                                        <span class="property-info-value">{{in_array('parking',$features) ? 'Yes' : 'Not available'}}</span>
                                    </span>
                                </div>

                                
                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-garage">
                                        <img style="height: 20px; width: 35px;" src="{{asset('public/frontend/assets/img/icon/generator-icon.png')}}">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Generator</span>
                                        <span class="property-info-value">{{in_array('generator',$features) ? 'Yes' : 'Not available'}}</span>
                                    </span>
                                </div>


                            </div>
                            <!-- .property-meta -->

                            <div class="section">
                                <h4 class="s-property-title">Description</h4>
                                <div class="s-property-content">
                                    <p>{{$unit->description}}                               </p>
                                </div>
                            </div>
                            <!-- End description area  -->

                            <div class="section additional-details">

                                <h4 class="s-property-title">Additional Details</h4>

                                <ul class="additional-details-list clearfix">

                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Built In</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">{{\Carbon\Carbon::parse($unit->build_date)->format('Y')}}</span>
                                    </li>

                                    <li>
									@php
									    function ordinal($number) {
									        $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
									        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
									            return $number . 'th';
									        } else {
									            return $number . $ends[$number % 10];
									        }
									    }
									@endphp
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Floor</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">{{$unit->floor == 0 ? 'Ground floor': ordinal($unit->floor). ' Floor'}}</span>
                                    </li>
                                    
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Net area</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">{{$unit->area_sqft}} SQFT</span>
                                    </li> 

                                </ul>
                            </div>  
                            <!-- End additional-details area  -->

                            <div class="section property-features">      

                                <h4 class="s-property-title">Features</h4>                            
                                <ul>
                                	@foreach($features as $feature)
                                    <li><a href="#">{{$feature}}</a></li> 
                                    @endforeach  
                                </ul>

                            </div>
                            <!-- End features area  -->
                            @php $videos = explode(",",$unit->video_path) @endphp
                            <div class="section property-video"> 
                                <h4 class="s-property-title">Property Video</h4> 
                                <div class="video-thumb">
                                    <a class="video-popup" href="{{$videos ? $videos[0] : '#'}}" title="Virtual Tour" target="_blank">
                                        <img src="{{asset('public/frontend/assets/img/property-video.jpg')}}" class="img-responsive wp-post-image" alt="Exterior">            
                                    </a>
                                </div>
                            </div>
                            <!-- End video area  -->
                            
                            

                            <div class="section property-share"> 
                                <h4 class="s-property-title">Share width your friends </h4> 
                                <div class="roperty-social">
                                    <ul> 
                                        <li>
                                          <a title="Share this on Dribbble" href="https://dribbble.com/sharing?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/dribbble_grey.png') }}">
                                          </a>
                                        </li>

                                        <li>
                                          <a title="Share this on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/facebook_grey.png') }}">
                                          </a>
                                        </li>

                                        <li>
                                          <a title="Share this on Delicious" href="https://del.icio.us/post?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/delicious_grey.png') }}">
                                          </a>
                                        </li>

                                        <li>
                                          <a title="Share this on Tumblr" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/tumblr_grey.png') }}">
                                          </a>
                                        </li>

                                        <li>
                                          <a title="Share this on Digg" href="http://digg.com/submit?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/digg_grey.png') }}">
                                          </a>
                                        </li>

                                        <li>
                                          <a title="Share this on Twitter" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/twitter_grey.png') }}">
                                          </a>
                                        </li>

                                        <li>
                                          <a title="Share this on LinkedIn" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset('public/frontend/assets/img/social_big/linkedin_grey.png') }}">
                                          </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- End video area  -->
                            
                        </div>
                    </div>


                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right">
                            <div class="dealer-widget">
                                <div class="dealer-content">
                                    <div class="inner-wrapper">

                                        <div class="clear">
                                            <div class="col-xs-4 col-sm-4 dealer-face">
                                                <a href="">
                                                    <img src="{{URL::to($agent->profile_photo)}}" class="img-circle">
                                                </a>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 ">
                                                <h3 class="dealer-name">
                                                    <a href="">{{$agent->name}}</a>
                                                    <span>{{$agent->designation}}</span>        
                                                </h3>
                                                <div class="dealer-social-media">
                                                    <a class="twitter"  href="#">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                    <a class="facebook"  href="#">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                    <a class="gplus"  href="#">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                    <a class="linkedin"  href="#">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a> 
                                                    <a class="instagram"  href="#">
                                                        <i class="fa fa-instagram"></i>
                                                    </a>       
                                                </div>

                                            </div>
                                        </div>

                                        <div class="clear">
                                            <ul class="dealer-contacts">                                       
                                               
                                                <li><i class="pe-7s-mail strong"> </i> {{$agent->email}}</li>
                                                <li><i class="pe-7s-call strong"> </i> {{$agent->phone}}</li>
                                            </ul>
                                            <p>{{$agent->bio}}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default sidebar-menu similar-property-wdg wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Similar Properties</h3>
                                </div>
                                <div class="panel-body recent-property-widget">
                                        <ul>
                                        @foreach($similar_units as $unit)
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                    @php
                                    $images = explode(",",$unit->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || (file_exists(public_path($image)) && !is_dir(public_path($image)));
                                        $src = $isValid ? $image : asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp
                                                <a href="{{route('user.unit.show',$unit->id)}}"><img src="{{$src}}"></a>
                                                <span class="property-seeker">
                                                    <b class="b-1">A</b>
                                                    <b class="b-2">S</b>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="{{route('unit.show',$unit->id)}}">{{$unit->project->name}} {{$unit->number}} </a></h6>
                                                <span class="property-price">${{number_format($unit->price)}}</span>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>                          

                            <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Ads here  </h3>
                                </div>
                                <div class="panel-body recent-property-widget">
                                    <img src="{{asset('public/frontend/assets/img/ads.jpg')}}">
                                </div>
                            </div>

                            <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                                <div class="panel-heading">
                                    <h3 class="panel-title">Smart search</h3>
                                </div>
                                <div class="panel-body search-widget">
                                <form action="{{route('units.smart-search')}}" method="GET" class=" form-inline">
                                   
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input name="name" type="text" class="form-control" placeholder="Key word">
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <div class="row">
                                                <div class="col-xs-6">

                                                    <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Select Your City" name="city_id">
                                                    	@foreach($cities as $city)
                                                    	<option value="{{$city->id}}">{{$city->name}}</option>
                                                    	@endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-6">

                                                    <select id="basic" class="selectpicker show-tick form-control" name="status">
                                                        <option value=""> -Status- </option>
                                                        <option value="under_construction">Under Construction</option>
                                                        <option value="complete">Complete</option>  

                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="price-range">Price range ($):</label>
                                                <input type="text" class="span2" value="[{{$min['price']}},{{$max['price']}}]" data-slider-min="{{$min['price']}}" 
                                                       data-slider-max="{{$max['price']}}" data-slider-step="" 
                                                       data-slider-value="[{{$min['price']}},{{$max['price']}}]" id="price-range" name="price" ><br />
                                                       @php $price_min = (1/1000000) * $min['price'] @endphp
                                                       @php $price_max = (1/1000000) * $max['price'] @endphp
                                                <b class="pull-left color">{{ceil(number_format($price_min, (2)) * 10)/10}}M $</b> 
                                                <b class="pull-right color">{{ceil(number_format($price_max, (2)) * 10)/10}}M $</b>
                                               
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="property-geo">Property geo (m2) :</label>
                                                <input type="text" class="span2" value="[{{$min['area_sqft']}},{{$max['area_sqft']}}]" data-slider-min="{{$min['area_sqft']}}" 
                                                       data-slider-max="{{$max['area_sqft']}}" data-slider-step="" 
                                                       data-slider-value="[{{$min['area_sqft']}},{{$max['area_sqft']}}]" id="property-geo" name="area_sqft" ><br />
                                                       @php $area_min = (1/1000) * $min['area_sqft'] @endphp
                                                       @php $area_max = (1/1000) * $max['area_sqft'] @endphp                                                       
                                                <b class="pull-left color">{{$area_min}}K ft2</b> 
                                                <b class="pull-right color">{{$area_max}}K ft2</b>                                                
                                            </div>                                            
                                        </div>
                                    </fieldset>                                

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="price-range">Min baths :</label>
                                                <input type="text" class="span2" value="[{{$min['bathrooms']}},{{$max['bathrooms']}}]" data-slider-min="{{$min['bathrooms']}}" 
                                                       data-slider-max="{{$max['bathrooms']}}" data-slider-step="" 
                                                       data-slider-value="[{{$min['bathrooms']}},{{$max['bathrooms']}}]" id="min-baths" name="bathrooms"><br />
                                                <b class="pull-left color">{{$min['bathrooms']}}</b> 
                                                <b class="pull-right color">{{$max['bathrooms']}}</b>                                                
                                            </div>

                                            <div class="col-xs-6">
                                                <label for="property-geo">Min bed :</label>
                                                <input type="text" class="span2" value="[{{$min['bedrooms']}},{{$max['bedrooms']}}]" data-slider-min="{{$min['bedrooms']}}" 
                                                       data-slider-max="{{$max['bedrooms']}}" data-slider-step="" 
                                                       data-slider-value="[{{$min['bedrooms']}},{{$max['bedrooms']}}]" id="min-bed" name="bedrooms"><br />
                                                <b class="pull-left color">{{$min['bedrooms']}}</b> 
                                                <b class="pull-right color">{{$max['bathrooms']}}</b>

                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="wifi">Wifi </label>
                                                </div> 
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="parking"> Parking</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="swimming"> Swimming</label>
                                                </div> 
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="gym"> Gym</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </fieldset>   

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="center"> Convention center</label>
                                                </div> 
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="elevator"> Elevator</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="generator"> Generator</label>
                                                </div> 
                                            </div>                                            
                                        </div>
                                    </fieldset>   

                                        <fieldset >
                                            <div class="row">
                                                <div class="col-xs-12">  
                                                    <input class="button btn largesearch-btn" value="Search" type="submit">
                                                </div>  
                                            </div>
                                        </fieldset>                                     
                                    </form>
                                </div>
                            </div>

                        </aside>
                    </div>
                </div>

            </div>
        </div>
@endsection