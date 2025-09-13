                <div>    
                    <div class="col-md-12 clear"> 
                        <div id="list-type" class="proerty-th">
                            @foreach($units as $unit)
                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            @php $images = explode("|",$unit->image_path) @endphp
                                            <a href="property-1.html" ><img src="{{URL::to($images[0])}}"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> {{$unit->project->name}} {{$unit->number}} </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> {{$unit->area_sqft + $unit->project->common_area}} sqft </span>
                                            <span class="proerty-price pull-right"> TK {{$unit->price}}</span>
                                            <p style="display: none;">{{$unit->view}}</p>
                                            <div class="property-icon">
                                                <img src="{{asset('public/frontend/assets/img/icon/bed.png')}}">{{$unit->bedrooms}}|
                                                <img src="{{asset('public/frontend/assets/img/icon/shawer.png')}}">{{$unit->bathrooms}}|
                                                @php $features = explode("|",$unit->features) @endphp
                                                <img src="{{asset('public/frontend/assets/img/icon/cars.png')}}">{{in_array('parking',$features) ? '1' : '0'}}  
                                            </div>
                                        </div>


                                    </div>
                                </div> 
                            @endforeach


                                
                        </div>
                    </div>
                    
                     {!! $units->links('livewire::bootstrap-pagination') !!}
                </div>    