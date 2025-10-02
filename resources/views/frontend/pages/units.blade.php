@extends('frontend.index')
@section('homeContent')
        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Property list</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                     
                <div class="col-md-3 p0 padding-top-40">
                    <div class="blog-asside-right pr0">
                        <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                            <div class="panel-heading">
                                <h3 class="panel-title">Smart search</h3>
                            </div>
                            @php 
                                    $rawPrice = $allrequest['price'] ?? "{$min['price']},{$max['price']}";

                                    // Convert to string if it's an array
                                    if (is_array($rawPrice)) {
                                        $price_val = implode(',', $rawPrice);
                                    } else {
                                        // Remove any wrapping square brackets if it's a string
                                        $price_val = trim($rawPrice, '[]');
                                    } 
                                    $rawArea = $allrequest['area_sqft'] ?? "{$min['area_sqft']},{$max['area_sqft']}";

                                    // Convert to string if it's an array
                                    if (is_array($rawArea)) {
                                        $area_val = implode(',', $rawArea);
                                    } else {
                                        // Remove any wrapping square brackets if it's a string
                                        $area_val = trim($rawArea, '[]');
                                    }
                                    $rawBathrooms = $allrequest['bathrooms'] ?? "{$min['bathrooms']},{$max['bathrooms']}";

                                    // Convert to string if it's an array
                                    if (is_array($rawBathrooms)) {
                                        $bathrooms_val = implode(',', $rawBathrooms);
                                    } else {
                                        // Remove any wrapping square brackets if it's a string
                                        $bathrooms_val = trim($rawBathrooms, '[]');
                                    }
                                    $rawBedrooms = $allrequest['bedrooms'] ?? "{$min['bedrooms']},{$max['bedrooms']}";

                                    // Convert to string if it's an array
                                    if (is_array($rawBedrooms)) {
                                        $bedrooms_val = implode(',', $rawBedrooms);
                                    } else {
                                        // Remove any wrapping square brackets if it's a string
                                        $bedrooms_val = trim($rawBedrooms, '[]');
                                    }
                                
                            @endphp
                            <div class="panel-body search-widget">
                                <form action="{{route('units.smart-search')}}" class=" form-inline smart_search" method="GET"> 
                                    @csrf
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input value="{{ old('name', $allrequest['name'] ?? '') }}" type="text" name="name" class="form-control" placeholder="Key word">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-6">

                                                <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Select Your City" name="city_id">
                                                    <option value="">Select a city</option>
                                                    @foreach($cities as $city)
                                                    <option {{ (isset($allrequest['city_id']) && $allrequest['city_id'] == $city->id) ? 'selected' : '' }} value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-6">

                                                <select id="basic" class="selectpicker show-tick form-control" name="status">
                                                    <option value=""> -Status- </option>
                                                    <option value="under_construction" {{ (isset($allrequest['status']) && $allrequest['status'] == 'under_construction') ? 'selected' : '' }}>Under Construction </option>
                                                    <option value="complete" {{ (isset($allrequest['status']) && $allrequest['status'] == 'complete') ? 'selected' : '' }}>Complete</option> 

                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="price-range">Price range ($):</label>
                                                <input type="text" class="span2" value="[{{$price_val}}]" data-slider-min="{{$min['price']}}" 
                                                       data-slider-max="{{$max['price']}}" data-slider-step="" 
                                                       data-slider-value="[{{$price_val}}]" id="price-range" name="price" ><br />
                                                       @php $price_min = (1/1000000) * $min['price'] @endphp
                                                       @php $price_max = (1/1000000) * $max['price'] @endphp
                                                <b class="pull-left color">{{ceil(number_format($price_min, (2)) * 10)/10}}M $</b> 
                                                <b class="pull-right color">{{ceil(number_format($price_max, (2)) * 10)/10}}M $</b>
                                               
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="property-geo">Property geo (m2) :</label>
                                                <input type="text" class="span2" value="[{{$area_val}}]" data-slider-min="{{$min['area_sqft']}}" 
                                                       data-slider-max="{{$max['area_sqft']}}" data-slider-step="" 
                                                       data-slider-value="[{{$area_val}}]" id="property-geo" name="area_sqft" ><br />
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
                                                <input type="text" class="span2" value="[{{$bathrooms_val}}]" data-slider-min="{{$min['bathrooms']}}" 
                                                       data-slider-max="{{$max['bathrooms']}}" data-slider-step="" 
                                                       data-slider-value="[{{$bathrooms_val}}]" id="min-baths" name="bathrooms"><br />
                                                <b class="pull-left color">{{$min['bathrooms']}}</b> 
                                                <b class="pull-right color">{{$max['bathrooms']}}</b>                                                
                                            </div>

                                            <div class="col-xs-6">
                                                <label for="property-geo">Min bed :</label>
                                                <input type="text" class="span2" value="[{{$bedrooms_val}}]" data-slider-min="{{$min['bedrooms']}}" 
                                                       data-slider-max="{{$max['bedrooms']}}" data-slider-step="" 
                                                       data-slider-value="[{{$bedrooms_val}}]" id="min-bed" name="bedrooms"><br />
                                                <b class="pull-left color">{{$min['bedrooms']}}</b> 
                                                <b class="pull-right color">{{$max['bathrooms']}}</b>

                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="wifi" {{ (isset($allrequest['features']) && in_array('wifi', $allrequest['features'])) ? 'checked' : '' }}>Wifi </label>
                                                </div> 
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="parking" {{ (isset($allrequest['features']) && in_array('parking', $allrequest['features'])) ? 'checked' : '' }}> Parking</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="swimming" {{ (isset($allrequest['features']) && in_array('swimming', $allrequest['features'])) ? 'checked' : '' }}> Swimming</label>
                                                </div> 
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="gym" {{ (isset($allrequest['features']) && in_array('gym', $allrequest['features'])) ? 'checked' : '' }}> Gym</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </fieldset>   

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="center" {{ (isset($allrequest['features']) && in_array('center', $allrequest['features'])) ? 'checked' : '' }}> Convention center</label>
                                                </div> 
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="elevator" {{ (isset($allrequest['features']) && in_array('elevator', $allrequest['features'])) ? 'checked' : '' }}> Elevator</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label> <input type="checkbox" name="features[]" value="generator" {{ (isset($allrequest['features']) && in_array('generator', $allrequest['features'])) ? 'checked' : '' }}> Generator</label>
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

                        <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recommended</h3>
                            </div>
                            <div class="panel-body recent-property-widget">
                                        <ul>
                                        @foreach($recomend as $rec)    
                                        <li>
                                            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                                
                                    @php
                                    $images = explode(",",$rec->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || (file_exists(public_path($image)) && !is_dir(public_path($image)));
                                        $src = $isValid ? $image : asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp                                                
                                                <a href="{{route('unit.show',$rec->id)}}"><img src="{{$src}}"></a>
                                                <span class="property-seeker">
                                                    <b class="b-1">A</b>
                                                    <b class="b-2">S</b>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="{{route('unit.show',$rec->id)}}">{{$rec->project->name}} {{$rec->number}} </a></h6>
                                                <span class="property-price">${{number_format($rec->price)}}</span>
                                            </div>
                                        </li>
                                        @endforeach


                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9  pr0 padding-top-40 properties-page orderbyunits">
                    <div class="col-md-12 clear"> 
                        <div class="col-xs-10 page-subheader sorting pl0">
                            <input id="unitIds" type="hidden" name="unitIds" value="">
                            <ul class="sort-by-list">
                                <li>
                                    <a href="javascript:void(0);" class="order_by_date {{count($units) < 1 ? 'disabled' : ''}}" 
                                    data-order="{{ $order === 'asc' ? 'desc' : 'asc'}}"
                                    data-current-order="{{ $order }}" data-orderby="{{ $orderby }}" >
                                        Property Date 
                                        <i class="fa {{ $order === 'asc' ? 'fa-sort-amount-asc' : 'fa-sort-amount-desc' }}"></i>                 
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0);" class="order_by_price {{count($units) < 1 ? 'disabled' : ''}}"  
                                    data-order="desc" 
                                    data-current-order="asc" 
                                    data-orderby="price">
                                        Property Price <i class="fa fa-sort-numeric-asc"></i>                      
                                    </a>
                                </li>
                            </ul><!--/ .sort-by-list-->

                            <div class="items-per-page">
                                <label for="items_per_page"><b>Property per page :</b></label>
                                <div class="sel">
                                    <select id="items_per_page" name="per_page">
                                        <option value="3">3</option>
                                        <option value="6">6</option>
                                        <option selected="selected" value="9">9</option>
                                    </select>
                                </div><!--/ .sel-->
                            </div><!--/ .items-per-page-->
                        </div>

                        <div class="col-xs-2 layout-switcher">
                            <a class="layout-list" href="javascript:void(0);"> <i class="fa fa-th-list"></i>  </a>
                            <a class="layout-grid active" href="javascript:void(0);"> <i class="fa fa-th"></i> </a>                          
                        </div><!--/ .layout-switcher-->
                    </div>

                    <div class="col-md-12 clear"> 
                        <div id="list-type" class="proerty-th">
                            @if(count($units) < 1)
                            <h2 class="text-danger">No apartments found</h2>
                            @endif
                            @foreach($units as $unit)
                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                    @php
                                    $images = explode(",",$unit->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || (file_exists(public_path($image)) && !is_dir(public_path($image)));
                                        $src = $isValid ? $image : asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp                                            
                                            <a href="{{route('unit.show',$unit->id)}}" ><img width="273" height="225" src="{{$src}}"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="{{route('unit.show',$unit->id)}}"> {{$unit->project->name}} {{$unit->number}} </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> {{number_format($unit->area_sqft + $unit->project->common_area)}} sqft </span>
                                            <span class="proerty-price pull-right"> ${{number_format($unit->price)}}</span>
                                            <p style="display: none;">{{$unit->view}}</p>
                                            <div class="property-icon">
                                                <img src="{{asset('frontend/assets/img/icon/bed.png')}}">{{$unit->bedrooms}}|
                                                <img src="{{asset('frontend/assets/img/icon/shawer.png')}}">{{$unit->bathrooms}}|
                                                @php $features = $unit->project->features @endphp
                                                <img src="{{asset('frontend/assets/img/icon/cars.png')}}">{{in_array('parking',$features) ? '1' : '0'}}  
                                            </div>
                                        </div>


                                    </div>
                                </div> 
                            @endforeach


                                
                        </div>
                    </div>
                    <div id="pagination_links">
                        {!! $units->links() !!}
                    </div>
                    <input id="currentPage" type="hidden" name="current_page" value="{{$units->currentPage()}}">
                     

                </div>  
                </div>              
            </div>
        </div>
@endsection