@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">States Table</h3><br><button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Register New agent</button>
                <!--slider store modal-->
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New State</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myagentForm" action="{{route('admin.agent.register')}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                             <label for="exampleInputPassword1">Agent Name</label>
                             <input type="text" class="form-control @error('name') is-invalid @enderror name" name="name" value="{{old('name')}}" >
                             <span class="error invalid-feedback" id="error-name" style="font-weight: bold;"></span>

                              @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Email</label>
                             <input type="email" class="form-control @error('email') is-invalid @enderror email" name="email" value="{{old('email')}}" >
                             <span class="error invalid-feedback" id="error-email" style="font-weight: bold;"></span>

                              @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                           <div class="form-group">
                             <label for="exampleInputPassword1">Phone no</label>
                             <input type="tel" class="form-control @error('phone') is-invalid @enderror phone" name="phone" value="{{old('phone')}}" >
                             <span class="error invalid-feedback" id="error-phone" style="font-weight: bold;"></span>


                              @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">License no</label>
                             <input type="text" class="form-control @error('license_number') is-invalid @enderror license_number" name="license_number" value="{{old('license_number')}}" >
                             <span class="error invalid-feedback" id="error-license_number" style="font-weight: bold;"></span>


                              @error('license_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Profile photo</label>
                             <input type="file" class="form-control @error('profile_photo') is-invalid @enderror profile_photo" name="profile_photo"  >
                             <span class="error invalid-feedback" id="error-profile_photo" style="font-weight: bold;"></span>

                             @error('profile_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div> 

                           <div class="form-group">
                             <label for="exampleInputPassword1">Designation</label>
                             <input type="text" class="form-control @error('designation') is-invalid @enderror designation" name="designation" value="{{old('designation')}}" >
                             <span class="error invalid-feedback" id="error-designation" style="font-weight: bold;"></span>


                              @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label>Bio</label>
                             <textarea name="bio" class="form-control @error('bio') is-invalid @enderror bio" >{{old('bio')}}</textarea>
                             <span class="error invalid-feedback" id="error-bio" style="font-weight: bold;"></span>

                             @error('bio')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                             </span>
                             @enderror
                           </div>



                            <div class="form-group mt-3">
                                <label>Active Status</label><br>
                                <select class="form-control @error('is_active') is-invalid @enderror is_active" name="is_active" >
                                  <option value="">Please select availability</option>
                                  <option value="1" {{ old('is_active') === '1' ? 'selected' : '' }}>Active</option>
                                  <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span class="error invalid-feedback" id="error-is_active" style="font-weight: bold;"></span>   

                                @error('is_active')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                           <button type="submit" class="btn btn-success btn-block">Register</button>
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
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($agents as $agent)
                    <tr>
                      <td>{{$agent->id}}</td>
                        <td>{{$agent->name}}</td>                                                               
     

                      <td>
                  

 <a data-toggle="modal" data-target="#modal-default{{$agent->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--product view modal-->
      <div class="modal fade" id="modal-default{{$agent->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Agent</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>Agent Details</h2></div>
                 <div class="card-body">
        <div id="carouselExampleControls{{$agent->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{(file_exists($agent->profile_photo) || filter_var($agent->profile_photo,FILTER_VALIDATE_URL)) ? URL::to($agent->profile_photo) : asset('public/frontend/assets/img/profile-1.png')}}" style="width:700px; height:700px;" alt="First slide">
            </div>
           
         
          </div>
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
                <ul>
                  <li><strong>Name: </strong>{{$agent->name}}</li>
                  <li><strong>Email: </strong>{{$agent->email}} </li>
                  <li><strong>Phone: </strong>{{$agent->phone}} </li>
                  <li><strong>License Number: </strong>{{$agent->license_number}} </li>
                  <li><strong>Designation: </strong>{{$agent->designation}} </li>
                  <li><strong>Availability: </strong>@if($agent->is_active == 1)Active@else<p class="bg-danger">Inactive</p>@endif</li>
                  
                </ul>
              </div>
            </div>
          </div>
              <h4><strong>Bio</strong></h4>
                   <p class="card-footer">{{$agent->bio}}</p>
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
<a id="delete" href="{{route('admin.agent.remove',$agent->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                <a id="delete" class="btn btn-danger" href="{{route('admin.agents.remove')}}">Delete all projects.</a>
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