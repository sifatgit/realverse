@extends('frontend.index')
@section('homeContent')
        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">List Layout With Sidebar</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FFF;">
            <div class="container">   
                <div class="row">

                    <div class="col-md-9 pr-30 padding-top-40 properties-page user-properties">

                        <div class="section"> 
                            <div class="page-subheader sorting pl0 pr-10">
                                <input id="unitIds" type="hidden" name="unitIds" value="">

                                <ul class="sort-by-list pull-left">
                                    <li class="">
                                        <a id="orderby" href="javascript:void(0);" class="sub_order_by_date" data-orderby="{{ $orderby }}" data-order="{{$order === 'asc' ? 'desc' : 'asc'}}" data-current-order="{{ $order }}" data-orderby="{{ $orderby}}">
                                            Property Date <i class="fa {{ $order === 'asc' ? 'fa-sort-amount-asc' : 'fa-sort-amount-desc' }}"></i>					
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="javascript:void(0);" class="sub_order_by_price" data-orderby="price" data-current-order="asc" data-order="desc">
                                            Property Price <i class="fa fa-sort-numeric-desc"></i>						
                                        </a>
                                    </li>
                                </ul><!--/ .sort-by-list-->

                                <div class="items-per-page pull-right">
                                    <label for="items_per_page"><b>Property per page :</b></label>
                                    <div class="sel">
                                        <select id="" name="per_page" class="items_per_page">
                                            <option value="3">3</option>
                                            <option value="6">6</option>
                                            <option selected value="9">9</option>
                                        </select>
                                    </div><!--/ .sel-->
                                </div><!--/ .items-per-page-->
                            </div>

                        </div>
                        <div id="section">
                            <div id="list-type" class="proerty-th-list">
                            @if(count($units) < 1)
                            <br>
                            <h6 class="text-warning">You haven't submitted any property yet.</h6>
                            @endif                                
                        @foreach($units as $unit)
                                @php
                                    $features = is_array($unit->features) ? $unit->features : json_decode($unit->features, true);
                                    $images = explode(",",$unit->image_path)
                                @endphp
                                    @php
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                        $src = $isValid ? URL::to($image) : asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp                                
                                <div id="{{$unit->id}}" class="col-md-4 p0">
                                            <div class="box-two proerty-item">
                                                <div class="item-thumb">
                                                    <a href="{{route('user.unit.show',$unit->id)}}" ><img src="{{$src}}"></a>
                                                </div>
                                                <div class="item-entry overflow">
                                                    <h5><a href="{{route('user.unit.show',$unit->id)}}"> {{$unit->number}} </a></h5>
                                                    <div class="dot-hr"></div>
                                                    <span class="pull-left"><b> Area :</b> {{$unit->area_sqft}} sqft </span>
                                                    <span class="proerty-price pull-right"> ${{number_format($unit->price)}}</span>
                                                    <p style="display: none;">{{$unit->description}}</p>
                                                    <div class="property-icon">
                                                        <img src="{{asset('public/frontend/assets/img/icon/bed.png')}}">({{$unit->bedrooms}})|
                                                        <img src="{{asset('public/frontend/assets/img/icon/shawer.png')}}">({{$unit->bathrooms}})|
                                                        <img src="{{asset('public/frontend/assets/img/icon/cars.png')}}">({{in_array('parking', $features) ? '1' : '0'}})  

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
                            </div>
                        </div>
                        <div id="pagination_links">
                        {!! $units->links() !!}
                    	</div>
                        <input id="currentPage" type="hidden" name="current_page" value="{{$units->currentPage()}}">

                    </div>       

                    <div class="col-md-3 p0 padding-top-40">
                        <div class="blog-asside-right">
                            <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                                <div class="panel-heading">
                                    <h3 class="panel-title">Hello {{Auth::user()->username}}</h3>
                                </div>
                                <div class="panel-body search-widget">

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
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                        $src = $isValid ? URL::to($image) : asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
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
                </div>
            </div>
        </div>
@endsection