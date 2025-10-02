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
                                            <a href="{{ route('unit.show',$unit->id)}}" ><img src="{{$src}}"></a>
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
                            