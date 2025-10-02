@foreach($units as $unit)
                                @php
                                    $features = is_array($unit->features) ? $unit->features : json_decode($unit->features, true);
                                @endphp
                                <div id="{{$unit->id}}" class="col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            @php
                                            $images = explode(",",$unit->image_path);
                                            $image = $images[0] ?? '';
                                                $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                                $src = $isValid ? URL::to($image) : asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                            @endphp                                            
                                            <a href="{{route('user.unit.show',$unit->id)}}" ><img src="{{$src}}"></a>
                                        </div>
                                        <div class="item-entry overflow">
                                            <h5><a href="{{route('user.unit.show',$unit->id)}}"> {{$unit->number}} </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> {{number_format($unit->area_sqft)}} sqft </span>
                                            <span class="proerty-price pull-right"> ${{number_format($unit->price)}}</span>
                                            <p style="display: none;">{{$unit->description}}</p>
                                            <div class="property-icon">
                                                <img src="{{asset('frontend/assets/img/icon/bed.png')}}">({{$unit->bedrooms}})|
                                                <img src="{{asset('frontend/assets/img/icon/shawer.png')}}">({{$unit->bathrooms}})|
                                                <img src="{{asset('frontend/assets/img/icon/cars.png')}}">(({{in_array('parking', $features) ? '1' : '0'}}))  

                                                <div class="dealer-action pull-right">
                                                    <a href="{{route('user.unit.show',$unit->id)}}" class="button">View</a>
                                                    <a href="{{route('user.unit.update',$unit->id)}}" class="button">Edit </a>
                                                    <a data-id="{{$unit->id}}" href="{{route('user.unit.delete',$unit->id)}}" class="button delete_user_car">Delete</a>
                                                    
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>                             
                                                       

@endforeach