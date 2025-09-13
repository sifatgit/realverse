@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Units Table (Showing {{$units->count()}} records of {{$units->total()}} from the database) </h3><br><button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>
                <!--slider store modal-->
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Unit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myunitForm" action="{{route('admin.unit.store')}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                             <label for="exampleInputPassword1">Project Name</label>
                             <select class="form-control @error('project_id') is-invalid @enderror projects project_id" name="project_id" >
                              <option value="">Please select a Project</option>
                              @foreach(App\Models\Project::all() as $project)
                              <option value="{{$project->id}}" {{ old('project_id') == $project->id ? 'selected' : '' }} >{{$project->name}}</option>
                              @endforeach
                               
                             </select>
                             <span class="error invalid-feedback" id="error-project_id" style="font-weight: bold;"></span>

                              @error('project_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror

                           </div>     

                           <div class="form-group">
                             <label for="exampleInputPassword1">Floor no.</label>
                             <select class="form-control @error('floor_id') is-invalid @enderror floors floor_id" name="floor_id" >
                              <option value="">Please select a floor</option>
                               
                             </select>
                             <span class="error invalid-feedback" id="error-floor_id" style="font-weight: bold;"></span>

                              @error('floor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror

                           </div>                          

                           <div class="form-group">
                             <label for="exampleInputPassword1">Unit No.</label>
                             <input type="text" class="form-control @error('number') is-invalid @enderror number" name="number" value="{{old('number')}}" >
                             <span class="error invalid-feedback" id="error-number" style="font-weight: bold;"></span>

                              @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                                                      
                           <div class="form-group">
                             <label for="exampleInputPassword1">Image</label>
                             <input type="file" class="form-control @error('image_path') is-invalid @enderror image_path" name="image_path[]" max="3" multiple >
                             <span class="error invalid-feedback" id="error-image_path" style="font-weight: bold;"></span>

                             @error('image_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div> 

                           <div class="form-group">
                             <label for="exampleInputPassword1">Video</label>
                             <input type="file" class="form-control @error('video_path') is-invalid @enderror video_path" name="video_path" accept="video/*">
                             <span class="error invalid-feedback" id="error-video_path" style="font-weight: bold;"></span>

                             @error('video_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Brochure</label>
                             <input type="file" class="form-control @error('pdf_path') is-invalid @enderror pdf_path" name="pdf_path" accept="application/pdf">
                             <span class="error invalid-feedback" id="error-pdf_path" style="font-weight: bold;"></span>

                             @error('pdf_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>                            


                           <div class="form-group">
                             <label for="exampleInputPassword1">Living Room</label>
                             <input type="number" class="form-control @error('living_room') is-invalid @enderror living_room" name="living_room" value="{{old('living_room')}}" min="1" >
                             <span class="error invalid-feedback" id="error-living_room" style="font-weight: bold;"></span>

                              @error('living_room')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Dining Room</label>
                             <input type="number" class="form-control @error('dining_room') is-invalid @enderror dining_room" name="dining_room" value="{{old('dining_room')}}" min="1" >
                             <span class="error invalid-feedback" id="error-dining_room" style="font-weight: bold;"></span>

                              @error('dining_room')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">BedRooms</label>
                             <input type="number" class="form-control @error('bedrooms') is-invalid @enderror bedrooms" name="bedrooms" value="{{old('bedrooms')}}" min="1" >
                             <span class="error invalid-feedback" id="error-bedrooms" style="font-weight: bold;"></span>

                              @error('bedrooms')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Bathrooms</label>
                             <input type="number" class="form-control @error('bathrooms') is-invalid @enderror bathrooms" name="bathrooms" value="{{old('bathrooms')}}" min="1" >
                             <span class="error invalid-feedback" id="error-bathrooms" style="font-weight: bold;"></span>

                              @error('bathrooms')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Balconies</label>
                             <input type="number" class="form-control @error('balconies') is-invalid @enderror balconies" name="balconies" value="{{old('balconies')}}" min="1" >
                             <span class="error invalid-feedback" id="error-balconies" style="font-weight: bold;"></span>

                              @error('balconies')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label>Total Area(sqft)</label>
                             <input type="number" class="form-control @error('area_sqft') is-invalid @enderror area_sqft" name="area_sqft" value="{{old('area_sqft')}}"  disabled>
                            <span class="error invalid-feedback" id="error-area_sqft" style="font-weight: bold;"></span>

                            @error('area_sqft')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror                             
                           </div>

                      <div class="form-group mt-3">
                          <label>Availability</label><br>
                          <select class="form-control @error('is_sold') is-invalid @enderror is_sold" name="is_sold" >
                            <option value="">Please select availability</option>
                            <option value="1" {{ old('is_sold') === '1' ? 'selected' : '' }}>Sold Out</option>
                            <option value="0" {{ old('is_sold') === '0' ? 'selected' : '' }}>Available</option>
                          </select>
                          <span class="error invalid-feedback" id="error-is_sold" style="font-weight: bold;"></span>   

                          @error('is_sold')
                              <div class="text-danger mt-1">{{ $message }}</div>
                          @enderror
                      </div>                           

                        <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror status" >

                        <option value="">Please enter the current status</option>  
                        <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>Complete</option>
                        <option value="under_construction" {{ old('status') == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                        </select>
                        <span class="error invalid-feedback" id="error-status" style="font-weight: bold;"></span>

                              @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                                                      
                           </div>

                           <div class="form-group">
                             <label>Price</label>
                             <input type="number" class="form-control @error('price') is-invalid @enderror price" name="price" value="{{old('price')}}" >
                             <span class="error invalid-feedback" id="error-price" style="font-weight: bold;"></span>

                              @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Handover Date</label>
                             <input type="date" class="form-control @error('handover_date') is-invalid @enderror handover_date" name="handover_date" value="{{old('handover_date')}}" >
                             <span class="error invalid-feedback" id="error-handover_date" style="font-weight: bold;"></span>

                              @error('handover_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Payment</label>
                             <input type="text" class="form-control @error('payment_plan') is-invalid @enderror payment_plan" name="payment_plan" value="{{old('payment_plan')}}" >
                             <span class="error invalid-feedback" id="error-payment_plan" style="font-weight: bold;"></span>

                              @error('payment_plan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Latitude</label>
                             <input type="text" class="form-control @error('latitude') is-invalid @enderror latitude" name="latitude" value="{{old('latitude')}}" >
                             <span class="error invalid-feedback" id="error-latitude" style="font-weight: bold;"></span>

                              @error('latitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Longitude</label>
                             <input type="text" class="form-control @error('longitude') is-invalid @enderror longitude" name="longitude" value="{{old('longitude')}}" >
                             <span class="error invalid-feedback" id="error-longitude" style="font-weight: bold;"></span>
                             
                              @error('longitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                      <div class="form-group">
                          <label>View</label>
                          <textarea name="view" class="form-control @error('view') is-invalid @enderror view">{{ old('view') }}</textarea>
                          <span class="error invalid-feedback" id="error-view" style="font-weight: bold;"></span>
                          @error('view')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div> 

                        <div class="form-group">
                        <label for="direction">Direction</label>
                        <select name="direction" class="form-control @error('direction') is-invalid @enderror direction" >

                        <option value="">Please enter direction</option>  
                        <option value="north" {{ old('direction') == 'north' ? 'selected' : '' }}>North</option>
                        <option value="south" {{ old('direction') == 'south' ? 'selected' : '' }}>South</option>
                        <option value="east" {{ old('direction') == 'east' ? 'selected' : '' }}>East</option>
                        <option value="west" {{ old('direction') == 'west' ? 'selected' : '' }}>West</option>
                        <option value="north-south" {{ old('direction') == 'north-south' ? 'selected' : '' }}>North-South</option>
                        <option value="east-west" {{ old('direction') == 'east-west' ? 'selected' : '' }}>East-West</option>
                        <option value="south-west" {{ old('direction') == 'south-west' ? 'selected' : '' }}>South-West</option>
                        <option value="north-east" {{ old('direction') == 'north-east' ? 'selected' : '' }}>North-East</option>
                        </select>
                        <span class="error invalid-feedback" id="error-direction" style="font-weight: bold;"></span>

                         @error('direction')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror                                                      
                      </div>                                                




                           <button type="submit" class="btn btn-success btn-block">Add</button>
                         </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Floor no.</th>
                    <th>Unit no.</th>
                    <th>Image</th>
                    <th>Video</th>
                    <th>Rooms</th>
                    <th>Area</th>
                    <th>Availability</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Handover Date</th>
                    <th>Payment Plan</th>
                    <th>Position</th>
                    <th>View</th>
                    <th>Direction</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($units as $unit)
                    <tr>
                      <td>{{$unit->id}}</td>
                        <td>{{$unit->project->name}}</td>                      
                        <td>{{$unit->floor->floor}}</td>                                          
                        <td>{{$unit->number}}</td>
                                    @php
                                    $images = explode(",",$unit->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                        $src = $isValid ? URL::to($image) : asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp 
                        <td><img src="{{$src}}" style="width:200px; height:150px;">
                        </td>
                        <td><video width="640" height="360" controls>
                        <source src="{{ asset($unit->video_path)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                      </td> 
                        <td>
                        <ul>
                          <li>Living rooms:{{$unit->living_room}}</li> 
                          <li>Dining rooms:{{$unit->dining_room}}</li> 
                          <li>Bedrooms:{{$unit->bedrooms}}</li> 
                          <li>Bathrooms:{{$unit->bathrooms}}</li> 
                          <li>Balconies:{{$unit->balconies}}</li> 
                        </ul>
                        </td>                        
                        <td>{{$unit->area_sqft}}</td>                                          
                        <td>@if($unit->is_sold == 1) Sold out @else Available @endif</td>                                          
                        <td>{{$unit->status}}</td>  
                        <td>{{$unit->price}} TK</td>
                        @php
                            $handoverDate = \Carbon\Carbon::parse($unit->handover_date);
                            $now = \Carbon\Carbon::now();

                            if ($handoverDate->isPast()) {
                                $message = 'Already handed over';
                            } else {
                                $diff = $now->diff($handoverDate);

                                $monthsLeft = ($diff->y * 12) + $diff->m;
                                $daysLeft = $diff->d;

                                if ($monthsLeft >= 1) {
                                    $message = $monthsLeft . ' month' . ($monthsLeft > 1 ? 's' : '') . ' from now';
                                } elseif ($daysLeft > 0) {
                                    $message = $daysLeft . ' day' . ($daysLeft > 1 ? 's' : '') . ' from now';
                                } else {
                                  if($unit->is_sold){
                                    $message = 'Already handed over';
                                  }
                                  else{
                                    $message = 'Instantly';
                                  }
                                }
                            }
                        @endphp

                        <td>{{ $message }}</td>                                        
                        <td>{{$unit->payment_plan}}</td>                                          
                        <td>Latitude:{{$unit->latitude}}<br>
                            Longitude:{{$unit->longitude}}
                        </td>                                        
                        <td>{{$unit->view}}</td>                                         
                        <td>{{$unit->direction}}</td>                                                                                   
     

                      <td>
                  

<a data-toggle="modal" data-target="#modal-default1{{$unit->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
                  <div class="modal fade" id="modal-default1{{$unit->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit unit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myunitupdateform" action="{{route('admin.unit.update',$unit->id)}}" method="Post" enctype="multipart/form-data">
                          @csrf

                      <div class="form-group">
                        <input type="hidden" name="old_project_id" value="{{$unit->project_id}}">
                      </div>    
                      <div class="form-group">
                          <label>Project Name</label>
                          <select class="form-control @error('project_id') is-invalid @enderror project_id{{$unit->id}}" name="project_id"  disabled>
                              <option value="">Please select a Project</option>
                              @foreach(App\Models\Project::all() as $project)
                              <option value="{{ $project->id }}" {{ old('project_id', $unit->project_id) == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                              @endforeach
                          </select>
                          <span class="error invalid-feedback" id="error-project_id{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('project_id')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>                          
                      <div class="form-group">
                        <input type="hidden" name="old_floor_id" value="{{$unit->floor_id}}">
                      </div>
                      <div class="form-group">
                          <label>Floor No.</label>
                          <select class="form-control @error('floor_id') is-invalid @enderror floor_id{{$unit->id}}" name="floor_id"  disabled>
                              <option value="">Please select a Floor</option>
                              @foreach(App\Models\Floor::all() as $floor)
                              <option value="{{ $floor->id }}" {{ old('floor_id', $unit->floor_id) == $floor->id ? 'selected' : '' }}>{{ $floor->floor }}</option>
                              @endforeach
                          </select>
                          <span class="error invalid-feedback" id="error-floor_id{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('floor_id')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div> 

                      <div class="form-group">
                          <label>Unit No.</label>
                          <input type="text" class="form-control @error('number') is-invalid @enderror number{{$unit->id}}" name="number"  value="{{ old('number', $unit->number) }}" readonly >
                          <span class="error invalid-feedback" id="error-number{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('number')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>


                            <div class="form-group">
                              <label>Old Image</label>
                              @php $images = explode("|",$unit->image_path); @endphp
                              <img src="{{URL::to($images[0])}}" style="width: 200px; height: 150px;">
                            </div><br>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Image</label>
                             <input type="file" class="form-control @error('image_path') is-invalid @enderror image_path{{$unit->id}}" name="image_path[]" max="3" multiple>
                             <span class="error invalid-feedback" id="error-image_path{{$unit->id}}" style="font-weight: bold;"></span>

                             @error('image_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Video</label>
                             <input type="file" class="form-control @error('video_path') is-invalid @enderror video_path{{$unit->id}}" name="video_path" accept="video/*">
                             <span class="error invalid-feedback" id="error-video_path{{$unit->id}}" style="font-weight: bold;"></span>

                             @error('video_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label>Old brochure</label>
                             <a href="{{ route('admin.unit.brochure.view',$unit->id) }}" target="_blank">View PDF</a>

                           </div>
                           <div class="form-group">
                             <label for="exampleInputPassword1">Change Brochure</label>
                             <input type="file" class="form-control @error('pdf_path') is-invalid @enderror pdf_path{{$unit->id}}" name="pdf_path" accept="application/pdf">
                             <span class="error invalid-feedback" id="error-pdf_path{{$unit->id}}" style="font-weight: bold;"></span>

                             @error('pdf_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                      <div class="form-group">
                          <label>Living Room</label>
                          <input type="number" class="form-control @error('living_room') is-invalid @enderror living_room{{$unit->id}}" name="living_room"
                              value="{{ old('living_room', $unit->living_room) }}" >
                              <span class="error invalid-feedback" id="error-living_room{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('living_room')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Dining Room</label>
                          <input type="number" class="form-control @error('dining_room') is-invalid @enderror dining_room{{$unit->id}}" name="dining_room"
                              value="{{ old('dining_room', $unit->dining_room) }}" >
                          <span class="error invalid-feedback" id="error-dining_room{{$unit->id}}" style="font-weight: bold;"></span>
                              
                          @error('dining_room')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Bedroom</label>
                          <input type="number" class="form-control @error('bedrooms') is-invalid @enderror bedrooms{{$unit->id}}" name="bedrooms"
                              value="{{ old('bedrooms', $unit->bedrooms) }}" >
                              <span class="error invalid-feedback" id="error-bedrooms{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('bedrooms')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Bathroom</label>
                          <input type="number" class="form-control @error('bathrooms') is-invalid @enderror bathrooms{{$unit->id}}" name="bathrooms"
                              value="{{ old('bathrooms', $unit->bathrooms) }}" >
                              <span class="error invalid-feedback" id="error-bathrooms{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('bathrooms')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Balconies</label>
                          <input type="number" class="form-control @error('balconies') is-invalid @enderror balconies{{$unit->id}}" name="balconies"
                              value="{{ old('balconies', $unit->balconies) }}" >
                              <span class="error invalid-feedback" id="error-balconies{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('balconies')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Area (sqft)</label>
                          <input type="number" class="form-control @error('area_sqft') is-invalid @enderror area_sqft{{$unit->id}}" name="area_sqft" value="{{ old('area_sqft', $unit->area_sqft) }}"  readonly>
                          <span class="error invalid-feedback" id="error-area_sqft{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('area_sqft')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>


                      <div class="form-group mt-3">
                          <label>Availability</label><br>
                          <select class="form-control @error('is_sold') is-invalid @enderror is_sold{{$unit->id}}" name="is_sold" >
                              <option value="">Please select availability</option>
                              <option value="1" {{ old('is_sold', $unit->is_sold) == 1 ? 'selected' : '' }}>Sold Out</option>
                              <option value="0" {{ old('is_sold', $unit->is_sold) == 0 ? 'selected' : '' }}>Available</option>
                          </select>
                          <span class="error invalid-feedback" id="error-is_sold{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('is_sold')
                              <div class="text-danger mt-1">{{ $message }}</div>
                          @enderror
                      </div>                      

                      <div class="form-group">
                          <label for="status">Status</label>
                          <select name="status" class="form-control @error('status') is-invalid @enderror status{{$unit->id}}" >
                              <option value="">Please enter the current status</option>  
                              <option value="complete" {{ old('status', $unit->status) == 'complete' ? 'selected' : '' }}>Complete</option>
                              <option value="under_construction" {{ old('status', $unit->status) == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                          </select>
                          <span class="error invalid-feedback" id="error-status{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('status')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      <div class="form-group">
                          <label>Price</label>
                          <input type="number" class="form-control @error('price') is-invalid @enderror price{{$unit->id}}" name="price" value="{{ old('price', $unit->price) }}" >
                          <span class="error invalid-feedback" id="error-price{{$unit->id}}" style="font-weight: bold;"></span>
                          @error('price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                        <label>Handover Date</label>
                        <input type="date" class="form-control @error('handover_date') is-invalid @enderror handover_date{{$unit->id}}" name="handover_date" value="{{ old('handover_date' , $unit->handover_date) }}" >
                        <span class="error invalid-feedback" id="error-handover_date{{$unit->id}}" style="font-weight: bold;"></span>

                        @error('handover_date')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror                        
                      </div>

                      <div class="form-group">
                        <label>Payment Plan</label>
                        <input type="text" class="form-control @error('payment_plan') is-invalid @enderror payment_plan{{$unit->id}}" name="payment_plan" value="{{ old('payment_plan' ,$unit->payment_plan) }}" >
                        <span class="error invalid-feedback" id="error-payment_plan{{$unit->id}}" style="font-weight: bold;"></span>

                       @error('payment_plan')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror                        
                      </div>

                      <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" class="form-control @error('latitude') is-invalid @enderror latitude{{$unit->id}}" name="latitude" value="{{ old('latitude' ,$unit->latitude) }}" readonly>
                        <span class="error invalid-feedback" id="error-latitude{{$unit->id}}" style="font-weight: bold;"></span>
                        
                       @error('latitude')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror                        
                      </div>

                      <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" class="form-control @error('longitude') is-invalid @enderror longitude{{$unit->id}}" name="longitude" value="{{ old('longitude' ,$unit->longitude) }}" readonly>
                        <span class="error invalid-feedback" id="error-longitude{{$unit->id}}" style="font-weight: bold;"></span>

                       @error('longitude')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror                        
                      </div> 

                      <div class="form-group">
                          <label>View</label>
                          <textarea name="view" class="form-control @error('view') is-invalid @enderror view{{$unit->id}}">{{ old('view', $unit->view) }}</textarea>
                          <span class="error invalid-feedback" id="error-view{{$unit->id}}" style="font-weight: bold;"></span>

                          @error('view')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                        <div class="form-group">
                          <input type="hidden" name="old_direction" value="{{$unit->direction}}">
                        </div>
                        <div class="form-group">
                        <label for="direction">Direction</label>
                        <select name="direction" class="form-control @error('direction') is-invalid @enderror direction{{$unit->id}}" disabled>

                        <option value="">Please enter direction</option>  
                        <option value="north" {{ old('direction' , $unit->direction) == 'north' ? 'selected' : '' }}>North</option>
                        <option value="south" {{ old('direction' , $unit->direction) == 'south' ? 'selected' : '' }}>South</option>
                        <option value="east" {{ old('direction' , $unit->direction) == 'east' ? 'selected' : '' }}>East</option>
                        <option value="west" {{ old('direction' , $unit->direction) == 'west' ? 'selected' : '' }}>West</option>
                        <option value="north-south" {{ old('direction' , $unit->direction) == 'north-south' ? 'selected' : '' }}>North-South</option>
                        <option value="east-west" {{ old('direction' , $unit->direction) == 'east-west' ? 'selected' : '' }}>East-West</option>
                        <option value="south-west" {{ old('direction' , $unit->direction) == 'south-west' ? 'selected' : '' }}>South-West</option>
                        <option value="north-east" {{ old('direction' , $unit->direction) == 'north-east' ? 'selected' : '' }}>North-East</option>
                        </select>
                        <span class="error invalid-feedback" id="error-direction{{$unit->id}}" style="font-weight: bold;"></span>

                         @error('direction')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror                                                      
                      </div>

                           <button type="submit" class="btn btn-success btn-block" data-id="{{$unit->id}}">Update</button>
                         </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
<a id="delete" href="{{route('admin.unit.delete',$unit->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                {{$units->links()}}<a id="delete" class="btn btn-danger" href="{{route('admin.units.delete')}}">Delete all units.</a>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

    <!-- /.content -->
@endsection