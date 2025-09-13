@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">States Table</h3><br><button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>
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
                         <form class="mystateForm" action="{{route('admin.state.store')}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                             <label for="exampleInputPassword1">State Name</label>
                             <input type="text" class="form-control @error('name') is-invalid @enderror name" name="name" value="{{old('name')}}" >
                             <span class="error invalid-feedback" id="error-name" style="font-weight: bold;"></span>

                              @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                           <div class="form-group">
                             <label for="exampleInputPassword1">Slug</label>
                             <input type="text" class="form-control @error('slug') is-invalid @enderror slug" name="slug" value="{{old('slug')}}" >
                             <span class="error invalid-feedback" id="error-slug" style="font-weight: bold;"></span>

                              @error('slug')
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
                             <label for="exampleInputPassword1">SEO Title</label>
                             <input type="text" class="form-control @error('seo_title') is-invalid @enderror seo_title" name="seo_title" value="{{old('seo_title')}}" >
                             <span class="error invalid-feedback" id="error-seo_title" style="font-weight: bold;"></span>

                              @error('seo_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">SEO Keywords</label>
                             <input type="text" class="form-control @error('seo_keywords') is-invalid @enderror seo_keywords" name="seo_keywords" value="{{old('seo_keywords')}}" >
                             <span class="error invalid-feedback" id="error-seo_keywords" style="font-weight: bold;"></span>

                              @error('seo_keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label>SEO Description</label>
                             <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror seo_description" >{{old('seo_description')}}</textarea>
                             <span class="error invalid-feedback" id="error-seo_description" style="font-weight: bold;"></span>

                             @error('seo_description')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                             </span>
                             @enderror
                           </div>

                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" step="0.0000001" name="latitude" class="form-control @error('latitude') is-invalid @enderror latitude" value="{{ old('latitude') }}">
                                <span class="error invalid-feedback" id="error-latitude" style="font-weight: bold;"></span>

                                @error('latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="longitude">Longitude:</label>
                                <input type="text" step="0.0000001" name="longitude" class="form-control @error('longitude') is-invalid @enderror longitude" value="{{ old('longitude') }}">
                                <span class="error invalid-feedback" id="error-longitude" style="font-weight: bold;"></span>

                                @error('longitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                           <div class="form-group">
                             <label>Google Map Location</label>
                             <textarea name="google_map_location" class="form-control @error('google_map_location') is-invalid @enderror google_map_location" >{{old('google_map_location')}}</textarea>
                             <span class="error invalid-feedback" id="error-google_map_location" style="font-weight: bold;"></span>

                             @error('google_map_location')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                             </span>
                             @enderror
                           </div>

                           <div class="form-group">
                             <label>Priority</label>
                             <input type="number" class="form-control @error('priority') is-invalid @enderror priority" name="priority" value="{{old('priority')}}" >
                             <span class="error invalid-feedback" id="error-priority" style="font-weight: bold;"></span>

                            @error('priority')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
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
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Seo Title</th>
                    <th>Seo Keywords</th>
                    <th>Seo Description</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Google map link</th>
                    <th>Priority</th>

                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($states as $state)
                    <tr>
                      <td>{{$state->id}}</td>
                        <td>{{$state->name}}</td>                      
                        <td>{{$state->slug}}</td>                                           
                        <td>{{$state->code}}</td>                                           
                        <td>{{$state->description}}</td>                                           
                        <td>{{$state->seo_title}}</td>                                          
                        <td>
                        @foreach($state->seo_keywords as $word)
                        {{$word}},
                        @endforeach
                      </td>                                           
                        <td>{{$state->seo_description}}</td>                                           
                        <td>{{$state->latitude}}</td>                                           
                        <td>{{$state->longitude}}</td>                                           
                        <td><iframe src="{{$state->google_map_location}}" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td>                                           
                        <td>{{$state->priority}}</td>                                           
     

                      <td>
                  


<a id="delete" href="{{route('admin.state.delete',$state->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
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