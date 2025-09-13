@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Projects Table</h3><br><button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>
                <!--slider store modal-->
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myprojectForm" action="{{route('admin.project.store')}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                             <label for="exampleInputPassword1">Project Name</label>
                             <input type="text" class="form-control @error('name') is-invalid @enderror name" name="name" value="{{old('name')}}" >
                             <span class="error invalid-feedback" id="error-name" style="font-weight: bold;"></span>

                              @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  
                           
                           <div class="form-group">
                             <label for="exampleInputPassword1">Code</label>
                             <input type="text" class="form-control @error('code') is-invalid @enderror code" name="code" value="{{old('code')}}" >
                             <span class="error invalid-feedback" id="error-code" style="font-weight: bold;"></span>

                              @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label>Description</label>
                             <textarea name="description" class="form-control @error('description') is-invalid @enderror description" >{{old('description')}}</textarea>
                             <span class="error invalid-feedback" id="error-description" style="font-weight: bold;"></span>

                             @error('description')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                             </span>
                             @enderror
                           </div>  
                                                      
                           <div class="form-group">
                             <label for="exampleInputPassword1">Image</label>
                             <input type="file" class="form-control @error('image') is-invalid @enderror image" name="image"  >
                             <span class="error invalid-feedback" id="error-image" style="font-weight: bold;"></span>

                             @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div> 

                           <div class="form-group">
                             <label for="exampleInputPassword1">Address</label>
                             <input type="text" class="form-control @error('address_line') is-invalid @enderror address_line" name="address_line" value="{{old('address_line')}}" >
                             <span class="error invalid-feedback" id="error-address_line" style="font-weight: bold;"></span>

                              @error('address_line')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">State</label>
                             <select class="form-control @error('state_id') is-invalid @enderror state state_id" name="state_id" >
                              <option value="">Please select a state</option>
                              @foreach(App\Models\State::all() as $state)
                              <option value="{{$state->id}}" {{ old('state_id') == $state->id ? 'selected' : '' }} >{{$state->name}}</option>
                              @endforeach
                               
                             </select>
                             <span class="error invalid-feedback" id="error-state_id" style="font-weight: bold;"></span>

                              @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror

                           </div>                           

                           <div class="form-group">
                             <label for="exampleInputPassword1">City</label>
                             <select class="form-control @error('city_id') is-invalid @enderror cities city_id" name="city_id" >
                              <option value="">Please select a city</option>
                               
                             </select>
                             <span class="error invalid-feedback" id="error-city_id" style="font-weight: bold;"></span>

                              @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>
                           

                           <div class="form-group">
                             <label for="exampleInputPassword1">Area</label>
                             <select class="form-control @error('area_id') is-invalid @enderror areas area_id" name="area_id" >
                              <option value="">Please select an area</option>
                               
                             </select>
                             <span class="error invalid-feedback" id="error-area_id" style="font-weight: bold;"></span>

                              @error('area_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Postal Code</label>
                             <input type="number" class="form-control @error('postal_code') is-invalid @enderror postal_code" name="postal_code" value="{{old('postal_code')}}" >
                             <span class="error invalid-feedback" id="error-postal_code" style="font-weight: bold;"></span>

                              @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label>Floors</label>
                             <input type="number" class="form-control @error('floors') is-invalid @enderror floors" name="floors" value="{{old('floors')}}" min="1">
                             <span class="error invalid-feedback" id="error-floors" style="font-weight: bold;"></span>

                              @error('floors')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Units</label>
                             <input type="number" class="form-control @error('units') is-invalid @enderror units" name="units" value="{{old('units')}}" min="1">
                             <span class="error invalid-feedback" id="error-units" style="font-weight: bold;"></span>
                             
                              @error('units')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Total Area(sqft)</label>
                             <input type="number" class="form-control @error('total_area_rounded_sqft') is-invalid @enderror total_area_rounded_sqft" name="total_area_rounded_sqft" value="{{old('total_area_rounded_sqft')}}" >
                             <span class="error invalid-feedback" id="error-total_area_rounded_sqft" style="font-weight: bold;"></span>

                              @error('total_area_rounded_sqft')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Total Building Area(sqft)</label>
                             <input type="number" class="form-control @error('total_building_area') is-invalid @enderror total_building_area" name="total_building_area" value="{{old('total_building_area')}}" >
                             <span class="error invalid-feedback" id="error-total_building_area" style="font-weight: bold;"></span>

                              @error('total_building_area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Common Area(sqft)</label>
                             <input type="number" class="form-control @error('common_area') is-invalid @enderror common_area" name="common_area" value="{{old('common_area')}}" >
                             <span class="error invalid-feedback" id="error-common_area" style="font-weight: bold;"></span>

                              @error('common_area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Net Area(sqft)</label>
                             <input type="number" class="form-control @error('net_area') is-invalid @enderror net_area" name="net_area" value="{{old('net_area')}}" >
                             <span class="error invalid-feedback" id="error-net_area" style="font-weight: bold;"></span>

                              @error('net_area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                           </div>

                           <div class="form-group">
                             <label>Contact No</label>
                             <input type="tel" class="form-control @error('contact') is-invalid @enderror contact" name="contact" value="{{old('contact')}}" >
                             <span class="error invalid-feedback" id="error-contact" style="font-weight: bold;"></span>

                              @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
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
                          <label>Features:</label><br>
                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="wifi" id="wifi" {{ in_array('wifi', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="wifi">WiFi</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="parking" id="parking" {{ in_array('parking', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="parking">Parking</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="swimming" id="swimming" {{ in_array('swimming', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="swimming">Swimming</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="gym" id="gym" {{ in_array('gym', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="gym">Gym</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="center" id="center" {{ in_array('center', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="center">Convention Center</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="elevator" id="elevator" {{ in_array('elevator', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="elevator">Elevator</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features" type="checkbox" name="features[]" value="generator" id="generator" {{ in_array('generator', old('features', [])) ? 'checked' : '' }}>
                              <label class="form-check-label" for="generator">Generator</label>
                          </div>
                          <span class="error invalid-feedback" id="error-features" style="font-weight: bold;"></span>

                          @error('features')
                              <div class="text-danger mt-1">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group mt-3">
                          <label>Availability</label><br>
                          <select class="form-control @error('is_sold_out') is-invalid @enderror is_sold_out" name="is_sold_out" >
                            <option value="">Please select availability</option>
                            <option {{old('is_sold_out' == 1 ? 'checked':'')}} value="1">Sold Out</option>
                            <option {{old('is_sold_out' == 0 ? 'checked':'')}} value="0">Available</option>
                          </select>
                          <span class="error invalid-feedback" id="error-is_sold_out" style="font-weight: bold;"></span>   

                          @error('is_sold_out')
                              <div class="text-danger mt-1">{{ $message }}</div>
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
                    <th>Name</th>
                    <th>Code</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Area</th>
                    <th>Postal Code</th>
                    <th>Floors</th>
                    <th>Units</th>
                    <th>Total Area(sqft)</th>
                    <th>Total Building Area(sqft)</th>
                    <th>Common Area(sqft)</th>
                    <th>Net Area(sqft)</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Features</th>
                    <th>Sold</th>


                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($projects as $project)
                    <tr>
                      <td>{{$project->id}}</td>
                        <td>{{$project->name}}</td>                      
                        <td>{{$project->code}}</td>
                                    @php

                                    $image = $project->image ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || (file_exists($image) && !is_dir($image));
                                        $src = $isValid ? URL::to($image) : asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp                                               
                        <td><img src="{{$src}}" style="width:200px; height:150px;"></td>   <td>{{$project->description}}</td>                                          
                        <td>{{$project->address_line}}</td>
                        <td>{{$project->state->name}}</td>                                          
                        <td>{{$project->city->name}}</td>                                          
                        <td>{{$project->area->name}}</td>                                          
                        <td>{{$project->postal_code}}</td>                                          
                        <td>{{$project->floors}}</td>                                          
                        <td>{{$project->units}}</td>                                          
                        <td>{{$project->total_area_rounded_sqft}}</td>                                         
                        <td>{{$project->total_building_area}}</td>                                         
                        <td>{{$project->common_area}}</td>                                         
                        <td>{{$project->net_area}}</td>                                         
                        <td>{{$project->contact}}</td>                                          
                        <td>{{$project->status}}</td>                                          
                        <td>
                          @foreach($project->features as $feature)
                          {{$feature}},
                          @endforeach
                        </td>
                        <td>@if($project->is_sold_out == 1) Sold out @else Available @endif</td>                                          
     

                      <td>
                  
<a class="btn btn-info" href="{{route('admin.project.floors',$project->id)}}">View Floors</a>
<a class="btn btn-info" href="{{route('admin.project.units',$project->id)}}">View Units</a>
<a data-toggle="modal" data-target="#modal-default1{{$project->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
                  <div class="modal fade" id="modal-default1{{$project->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myprojectupdateForm" action="{{route('admin.project.update',$project->id)}}" method="Post" enctype="multipart/form-data">
                          @csrf

                      <div class="form-group">
                          <label>Project Name</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror name{{$project->id}}" name="name"
                              value="{{ old('name', $project->name) }}" >
                           <span class="error{{$project->id}} invalid-feedback" id="error-name{{$project->id}}" style="font-weight: bold;"></span>   
                          @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Code</label>
                          <input type="text" class="form-control @error('code') is-invalid @enderror code{{$project->id}}" name="code"
                              value="{{ old('code', $project->code) }}" >
                          <span class="error{{$project->id}} invalid-feedback" id="error-code{{$project->id}}" style="font-weight: bold;"></span>    
                          @error('code')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror description{{$project->id}}" >{{ old('description', $project->description) }}</textarea>
                          <span class="error{{$project->id}} invalid-feedback" id="error-description{{$project->id}}" style="font-weight: bold;"></span>
                          @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group"> 
                          <label>Old image</label>
                          <img src="{{ URL::to($project->image) }}" style="width: 40px; height: 30px;">
                          <input type="hidden" name="old_image" value="{{ $project->image }}">
                      </div>

                      <div class="form-group">
                          <label>Image</label>
                          <input type="file" class="form-control @error('image') is-invalid @enderror image{{$project->id}}" name="image" >
                          <span class="error{{$project->id}} invalid-feedback" id="error-image{{$project->id}}" style="font-weight: bold;"></span>
                          @error('image')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control @error('address_line') is-invalid @enderror address_line{{$project->id}}" name="address_line"
                              value="{{ old('address_line', $project->address_line) }}"  readonly>
                          <span class="error{{$project->id}} invalid-feedback" id="error-address_line{{$project->id}}" style="font-weight: bold;"></span>
                          @error('address_line')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <input type="hidden" name="state_id" value="{{$project->state_id}}">
                          <label>State</label>
                          <select class="form-control @error('state_id') is-invalid @enderror state state_id{{$project->id}}" name="state_id"  disabled>
                              <option value="">Please select a state</option>
                              @foreach(App\Models\State::all() as $state)
                                  <option value="{{ $state->id }}" {{ old('state_id', $project->state_id) == $state->id ? 'selected' : '' }}>
                                      {{ $state->name }}
                                  </option>
                              @endforeach
                          </select>
                          <span class="error{{$project->id}} invalid-feedback" id="error-state_id{{$project->id}}" style="font-weight: bold;"></span>
                          @error('state_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                        <input type="hidden" name="city_id" value="{{$project->city_id}}">
                          <label>City</label>
                          <select class="form-control @error('city_id') is-invalid @enderror city_id{{$project->id}}" name=""  disabled>
                              <option value="">Please select a city</option>
                              <option value="{{ $project->city->id }}" {{ old('city_id', $project->city_id) == $project->city->id ? 'selected' : '' }}>{{ $project->city->name }}</option>
                          </select>
                          <span class="error{{$project->id}} invalid-feedback" id="error-city_id{{$project->id}}" style="font-weight: bold;"></span>
                          @error('city_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <input type="hidden" name="area_id" value="{{$project->area_id}}">
                          <label>Area</label>
                          <select class="form-control @error('area_id') is-invalid @enderror area_id{{$project->id}}" name=""  disabled>
                              <option value="">Please select an area</option>
                              <option value="{{ $project->area->id }}" {{ old('area_id', $project->area_id) == $project->area->id ? 'selected' : '' }}>{{ $project->area->name }}</option>
                          </select>
                          <span class="error{{$project->id}} invalid-feedback" id="error-area_id{{$project->id}}" style="font-weight: bold;"></span>
                          @error('area_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Postal Code</label>
                          <input type="number" class="form-control @error('postal_code') is-invalid @enderror postal_code{{$project->id}}" name="postal_code"
                              value="{{ old('postal_code', $project->postal_code) }}"  readonly>
                          <span class="error{{$project->id}} invalid-feedback" id="error-postal_code{{$project->id}}" style="font-weight: bold;"></span>
                          @error('postal_code')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Floors</label>
                          <input type="number" class="form-control @error('floors') is-invalid @enderror floors{{$project->id}}" name="floors"
                              value="{{ old('floors', $project->floors) }}"  >
                          <span class="error{{$project->id}} invalid-feedback" id="error-floors{{$project->id}}" style="font-weight: bold;"></span>
                          @error('floors')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Units</label>
                          <input type="number" class="form-control @error('units') is-invalid @enderror units{{$project->id}}" name="units"
                              value="{{ old('units', $project->units) }}" min="1" >
                          <span class="error{{$project->id}} invalid-feedback" id="error-units{{$project->id}}" style="font-weight: bold;"></span>
                          @error('units')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Total Area (sqft)</label>
                          <input type="number" class="form-control @error('total_area_rounded_sqft') is-invalid @enderror total_area_rounded_sqft{{$project->id}}" name="total_area_rounded_sqft"
                              value="{{ old('total_area_rounded_sqft', $project->total_area_rounded_sqft) }}"  readonly>
                          <span class="error{{$project->id}} invalid-feedback" id="error-total_area_rounded_sqft{{$project->id}}" style="font-weight: bold;"></span>
                          @error('total_area_rounded_sqft')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Total Building Area (sqft)</label>
                          <input type="number" class="form-control @error('total_building_area') is-invalid @enderror total_building_area{{$project->id}}" name="total_building_area"
                              value="{{ old('total_building_area', $project->total_building_area) }}" >
                          <span class="error{{$project->id}} invalid-feedback" id="error-total_building_area{{$project->id}}" style="font-weight: bold;"></span>
                          @error('total_building_area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Common Area (sqft)</label>
                          <input type="number" class="form-control @error('common_area') is-invalid @enderror common_area{{$project->id}}" name="common_area"
                              value="{{ old('common_area', $project->common_area) }}" readonly >
                          <span class="error{{$project->id}} invalid-feedback" id="error-common_area{{$project->id}}" style="font-weight: bold;"></span>
                          @error('common_area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Net Area (sqft)</label>
                          <input type="number" class="form-control @error('net_area') is-invalid @enderror net_area{{$project->id}}" name="net_area"
                              value="{{ old('net_area', $project->net_area) }}" readonly>
                          <span class="error{{$project->id}} invalid-feedback" id="error-net_area{{$project->id}}" style="font-weight: bold;"></span>
                          @error('net_area')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label>Contact No</label>
                          <input type="tel" class="form-control @error('contact') is-invalid @enderror contact{{$project->id}}" name="contact"
                              value="{{ old('contact', $project->contact) }}" >
                          <span class="error{{$project->id}} invalid-feedback" id="error-contact{{$project->id}}" style="font-weight: bold;"></span>
                          @error('contact')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      <div class="form-group">
                          <label for="status">Status</label>
                          <select name="status" class="form-control @error('status') is-invalid @enderror status{{$project->id}}" >
                              <option value="">Please enter the current status</option>  
                              <option value="complete" {{ old('status', $project->status) == 'complete' ? 'selected' : '' }}>Complete</option>
                              <option value="under_construction" {{ old('status', $project->status) == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                          </select>
                          <span class="error{{$project->id}} invalid-feedback" id="error-status{{$project->id}}" style="font-weight: bold;"></span>
                          @error('status')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                      </div>

                      @php
                          $oldFeatures = old('features');
                          $featuresToCheck = is_array($oldFeatures) ? $oldFeatures : ($project->features ?? []);
                      @endphp                           
                      <div class="form-group">
                          <label>Features:</label><br>
                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="wifi" id="wifi"  {{ in_array('wifi', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="wifi">WiFi</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="parking" id="parking" {{ in_array('parking', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="parking">Parking</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="swimming" id="swimming" {{ in_array('swimming', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="swimming">Swimming</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="gym" id="gym" {{ in_array('gym', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="gym">Gym</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="center" id="center" {{ in_array('center', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="center">Convention Center</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="elevator" id="elevator" {{ in_array('elevator', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="elevator">Elevator</label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input features{{$project->id}}" type="checkbox" name="features[]" value="generator" id="generator" {{ in_array('generator', $featuresToCheck) ? 'checked' : '' }}>
                              <label class="form-check-label" for="generator">Generator</label>
                          </div>
                          <span class="error{{$project->id}} invalid-feedback" id="error-features{{$project->id}}" style="font-weight: bold;"></span>
                          @error('features')
                              <div class="text-danger mt-1">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group mt-3">
                          <label>Availability</label><br>
                          <select class="form-control @error('is_sold_out') is-invalid @enderror is_sold_out{{$project->id}}" name="is_sold_out" >
                              <option value="">Please select availability</option>
                              <option value="1" {{ old('is_sold_out', $project->is_sold_out) == 1 ? 'selected' : '' }}>Sold Out</option>
                              <option value="0" {{ old('is_sold_out', $project->is_sold_out) == 0 ? 'selected' : '' }}>Available</option>
                          </select>
                          <span class="error{{$project->id}} invalid-feedback" id="error-is_sold_out{{$project->id}}" style="font-weight: bold;"></span> 
                          @error('is_sold_out')
                              <div class="text-danger mt-1">{{ $message }}</div>
                          @enderror
                      </div>



                           <button type="submit" class="btn btn-success btn-block" data-id="{{$project->id}}">Update</button>
                         </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
<a id="delete" href="{{route('admin.project.delete',$project->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                <a id="delete" class="btn btn-danger" href="{{route('admin.projects.delete')}}">Delete all projects.</a>
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