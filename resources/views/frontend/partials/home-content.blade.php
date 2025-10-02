        <div class="slider-area">
            @if($sliders && count($sliders) > 0)
            <div class="slider">
                <div id="bg-slider" class="owl-carousel owl-theme">
                    
                    @foreach($sliders as $slider)
                    <div class="item"><img width="740" height="1000" src="{{URL::to($slider->image)}}"></div>
                    @endforeach

                </div>
            </div>
            @endif
            <div class="container slider-content">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                        @if($setting && $setting->slider_title)
                        <h2>{{$setting->slider_title}}</h2>
                        @else
                        <h2>property Searching Just Got So Easy</h2>
                        @endif
                        @if($setting && $setting->slider_description)
                        <p>{{$setting->slider_description}}</p>
                        @else
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi deserunt deleniti, ullam commodi sit ipsam laboriosam velit adipisci quibusdam aliquam teneturo!</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @php
        $price_val = $min['price'] . ',' . $max['price'];
        $area_val = $min['area_sqft'] . ',' . $max['area_sqft'];
        $bath_val = $min['bathrooms'] . ',' . $max['bathrooms'];
        $bed_val = $min['bedrooms'] . ',' . $max['bedrooms'];
        @endphp
        <div class="home-lager-shearch" style="background-color: rgb(252, 252, 252); padding-top: 25px; margin-top: -125px;">
            <div class="container">
                <div class="col-md-12 large-search"> 
                    <div class="search-form wow pulse">
                        <form action="{{route('units.smart-search')}}" class=" form-inline" method="GET">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <input value="" name="name" type="text" class="form-control" placeholder="Key word">
                                </div>
                                <div class="col-md-4">                                   
                                    <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Select your city" name="city_id">
                                        <option value="">Please select a city</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">                                     
                                    <select id="basic" class="selectpicker show-tick form-control" name="status">
                                        <option value=""> -Status- </option>
                                        <option value="under_construction">Under Construction</option>
                                        <option value="complete">Complete</option>


                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="search-row">   

                                    <div class="col-sm-3">
                                        <label for="price-range">Price range ($):</label>
                                        <input type="text" class="span2" value="[{{$price_val}}]" data-slider-min="{{$min[
                                        'price']}}" 
                                               data-slider-max="{{$max['price']}}" data-slider-step="" 
                                               data-slider-value="[{{$price_val}}]" id="price-range" name="price" ><br />
                                        <b class="pull-left color">{{$min['price']}}$</b> 
                                        <b class="pull-right color">{{$max['price']}}$</b>
                                    </div>
                                    <!-- End of  -->  

                                    <div class="col-sm-3">
                                        <label for="property-geo">Property geo (m2) :</label>
                                        <input type="text" class="span2" value="[{{$area_val}}]" data-slider-min="{{$min['area_sqft']}}" 
                                               data-slider-max="{{$max['area_sqft']}}" data-slider-step="" 
                                               data-slider-value="[{{$area_val}}]" id="property-geo" name="area_sqft"><br />
                                        <b class="pull-left color">{{$min['area_sqft']}}m</b> 
                                        <b class="pull-right color">{{$max['area_sqft']}}m</b>
                                    </div>
                                    <!-- End of  --> 

                                    <div class="col-sm-3">
                                        <label for="price-range">Min baths :</label>
                                        <input type="text" class="span2" value="[{{$bath_val}}]" data-slider-min="{{$min['bathrooms']}}" 
                                               data-slider-max="{{$max['bathrooms']}}" data-slider-step="" 
                                               data-slider-value="[{{$bath_val}}]" id="min-baths" name="bathrooms"><br />
                                        <b class="pull-left color">{{$min['bathrooms']}}</b> 
                                        <b class="pull-right color">{{$max['bathrooms']}}</b>
                                    </div>
                                    <!-- End of  --> 

                                    <div class="col-sm-3">
                                        <label for="property-geo">Min bed :</label>
                                        <input type="text" class="span2" value="[{{$bed_val}}]" data-slider-min="{{$min['bedrooms']}}" 
                                               data-slider-max="{{$max['bedrooms']}}" data-slider-step="" 
                                               data-slider-value="[{{$bed_val}}]" id="min-bed" name="bedrooms"><br />
                                        <b class="pull-left color">{{$min['bedrooms']}}</b> 
                                        <b class="pull-right color">{{$max['bedrooms']}}</b>
                                    </div>
                                    <!-- End of  --> 

                                </div>

                                <div class="search-row">  

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="wifi"> Wifi
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  -->  

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="swimming"> Swimming pool
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  --> 

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="parking"> Garage
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  -->  

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="center"> Convention center
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  -->  

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="generator"> Generator
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  --> 

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="elevator"> Elevator
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  --> 

                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="gym"> Gym
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End of  -->  
                                </div>   
                            </div>  
                            <div class="center">
                                <input type="submit" value="" class="btn btn-default btn-lg-sheach">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>Top Apartments</h2>
                        <p>Select from our wide range of apartments based on your preference . </p>
                    </div>
                </div>

                <div class="row">
                    <div class="proerty-th">
                        @foreach($units as $unit)
                        <div class="col-sm-6 col-md-3 p0">
                            <div class="box-two proerty-item">
                                <div class="item-thumb">
                                    @php
                                    $images = explode(",",$unit->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                        $src = $isValid ? URL::to($image) : asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp
                                    <a href="{{route('unit.show',$unit->id)}}" ><img width="273" height="225" src="{{$src}}"></a>
                                </div>
                                <div class="item-entry overflow">
                                    <h5><a href="{{route('unit.show',$unit->id)}}" >{{$unit->project->name}} {{$unit->number}} </a></h5>
                                    <div class="dot-hr"></div>
                                    <span class="pull-left"><b>Area :</b> {{number_format($unit->area_sqft + $unit->project->common_area)}} sqft</span>
                                    <span class="proerty-price pull-right">${{number_format($unit->price)}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        @if(count($units) > 0)
                        <div class="col-sm-6 col-md-3 p0">
                            <div class="box-tree more-proerty text-center">
                                <div class="item-tree-icon">
                                    <i class="fa fa-th"></i>
                                </div>
                                <div class="more-entry overflow">
                                    <h5><a href="{{route('units')}}" >CAN'T DECIDE ? </a></h5>
                                    <h5 class="tree-sub-ttl">Show all properties</h5>
                                    <button onclick="window.location.href='{{route('units')}}'" class="btn border-btn more-black" value="All properties">All properties</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        

                    </div>
                </div>
            </div>
        </div>

        <!--Welcome area -->
        <div class="Welcome-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Welcome-entry  col-sm-12">
                        <div class="col-md-5 col-md-offset-2 col-sm-6 col-xs-12">
                            <div class="welcome_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                                        <!-- /.feature title -->
                                        <h2>GARO ESTATE </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <div  class="welcome_services wow fadeInRight" data-wow-delay="0.3s" data-wow-offset="100">
                                <div class="row">
                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-home pe-4x"></i>
                                            </div>
                                            <h3>Any property</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-users pe-4x"></i>
                                            </div>
                                            <h3>More Clients</h3>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 text-center">
                                        <i class="welcome-circle"></i>
                                    </div>

                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-notebook pe-4x"></i>
                                            </div>
                                            <h3>Easy to use</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-help2 pe-4x"></i>
                                            </div>
                                            <h3>Any help </h3>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--TESTIMONIALS -->
        <div class="testimonial-area recent-property" style="background-color: #FCFCFC; padding-bottom: 15px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>Our Customers Said  </h2> 
                    </div>
                </div>

                <div class="row">
                    <div class="row testimonial">
                        <div class="col-md-12">
                            <div id="testimonial-slider">
                                @foreach($reviews as $review)
                                <div class="item">
                                    <div class="client-text">                                
                                        <p>{{$review->review}} !</p>
                                        <h4><strong>{{$review->firstname}} {{$review->lastname}}, </strong><i>{{$review->role}}</i></h4>
                                    </div>
                                    <div class="client-face wow fadeInRight" data-wow-delay=".9s"> 
                                        <img style="width: 88px; height: 88px;" src="{{URL::to($review->image)}}" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Count area -->
        <div class="count-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>You can trust Us </h2> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 percent-blocks m-main" data-waypoint-scroll="true">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-users"></span>
                                    </div>
                                    <div class="chart" data-percent="5000">
                                        <h2 class="percent" id="counter">0</h2>
                                        <h5>HAPPY CUSTOMER </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-home"></span>
                                    </div>
                                    <div class="chart" data-percent="12000">
                                        <h2 class="percent" id="counter1">0</h2>
                                        <h5>Properties in stock</h5>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-flag"></span>
                                    </div>
                                    <div class="chart" data-percent="120">
                                        <h2 class="percent" id="counter2">0</h2>
                                        <h5>City registered </h5>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-graph2"></span>
                                    </div>
                                    <div class="chart" data-percent="5000">
                                        <h2 class="percent"  id="counter3">0</h2>
                                        <h5>DEALER BRANCHES</h5>
                                    </div>
                                </div> 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- boy-sale area -->
        <div class="boy-sale-area">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-sm-10 col-sm-offset-1 col-md-offset-0 col-xs-12">
                        <div class="asks-first">
                            <div class="asks-first-circle">
                                <span class="fa fa-search"></span>
                            </div>
                            <div class="asks-first-info">
                                <h2>ARE YOU LOOKING FOR A Property?</h2>
                                <p> varius od lio eget conseq uat blandit, lorem auglue comm lodo nisl no us nibh mas lsa</p>                                        
                            </div>
                            <div class="asks-first-arrow">
                                <a href="{{route('units')}}"><span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-10 col-sm-offset-1 col-xs-12 col-md-offset-0">
                        <div  class="asks-first">
                            <div class="asks-first-circle">
                                <span class="fa fa-usd"></span>
                            </div>
                            <div class="asks-first-info">
                                <h2>DO YOU WANT TO SELL A Property?</h2>
                                <p> varius od lio eget conseq uat blandit, lorem auglue comm lodo nisl no us nibh mas lsa</p>
                            </div>
                            <div class="asks-first-arrow">
                                <a href="{{route('unit.form')}}"><span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <p  class="asks-call">QUESTIONS? CALL US  : @if($setting && $setting->phone_no)<span class="strong"> {{$setting->phone_no}}</span> @else <span class="strong"> + 3-123- 424-5700</span> @endif</p>
                    </div>
                </div>
            </div>
        </div>