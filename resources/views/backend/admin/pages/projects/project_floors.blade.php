@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Project Floors Table {{count($floors)}} total records showing.</h3><br><button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>
                <!--slider store modal-->
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add New Floor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myfloorForm" action="{{route('admin.floor.store')}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                             <select name="project_id" class="form-control @error('project_id') is-invalid @enderror project_select project_id" >
                                <option value="">Please select a project</option> 
                               <option {{ old('project_id') == $project->id ? 'selected' : ''}} value="{{$project->id}}">{{$project->name}}</option>
                               
                             </select>
                             <span class="error invalid-feedback" id="error-project_id" style="font-weight: bold;"></span>

                              @error('project_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                           <div class="form-group">
                             <label for="exampleInputPassword1">Floor</label>
                             <input type="number" class="form-control @error('floor') is-invalid @enderror floormax floor" name="floor" value="{{old('floor')}}" >
                             <span class="error invalid-feedback" id="error-floor" style="font-weight: bold;"></span>

                              @error('floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                            <label>Enter a label</label>
                             <input type="text" class="form-control @error('label') is-invalid @enderror label" name="label" value="{{ old('label')}}">
                             <span class="error invalid-feedback" id="error-label" style="font-weight: bold;"></span>

                              @error('label')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Units</label>
                             <input type="number" class="form-control @error('units') is-invalid @enderror unitmax units" name="units" value="{{old('units')}}" min="1">
                             <span class="error invalid-feedback" id="error-units" style="font-weight: bold;"></span>

                              @error('units')
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
              @php $units_count = 0; @endphp
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Floor</th>
                    <th>Label</th>
                    <th>Units</th>
                    <th>Units in use</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($floors as $floor)
          @php $units_count+= count($floor->unitslist) @endphp
                    <tr>
                      <td>{{$floor->id}}</td>
                        <td>{{$floor->project->name}}</td>                      
                        <td>{{$floor->floor}}</td>                                           
                        <td>{{$floor->label}}</td>                                           
                        <td>{{$floor->units}}</td>                                                                                    
                        <td>{{count($floor->unitslist)}}</td>                                                                                    
     

                      <td>
                  

<a class="btn btn-info" href="{{route('admin.floor.units',$floor->id)}}">View units</a>
<a data-toggle="modal" data-target="#modal-default1{{$floor->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
                <!--project floor update modal-->
                <div class="modal fade" id="modal-default1{{$floor->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Floor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myupdatefloorForm" action="{{route('admin.floor.update',$floor->id)}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                            <input type="hidden" name="project_id" value="{{$floor->project_id}}">
                             <select name="" class="form-control @error('project_id') is-invalid @enderror project_select project_id{{$floor->id}}" disabled >
                               <option value="">Please select a project</option>
                               @foreach(App\Models\Project::all() as $project)
                               <option {{ old('project_id',$floor->project_id) == $project->id ? 'selected' : ''}} value="{{$project->id}}">{{$project->name}}</option>
                               @endforeach
                             </select>
                             <span class="error invalid-feedback" id="error-project_id{{$floor->id}}" style="font-weight: bold;"></span>

                              @error('project_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                           <div class="form-group">
                             <label for="exampleInputPassword1">Floor</label>
                             <input type="number" class="form-control @error('floor') is-invalid @enderror  floor{{$floor->id}}" name="floor" value="{{old('floor', $floor->floor)}}" readonly>
                             <span class="error invalid-feedback" id="error-floor{{$floor->id}}" style="font-weight: bold;"></span>

                              @error('floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                            <label>Enter a label</label>
                             <input type="text" class="form-control @error('label') is-invalid @enderror label{{$floor->id}}" name="label" value="{{ old('label')}}">
                             <span class="error invalid-feedback" id="error-label{{$floor->id}}" style="font-weight: bold;"></span>

                              @error('label')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Units</label>
                             <input type="number" class="form-control @error('units') is-invalid @enderror  units{{$floor->id}}" name="units" value="{{old('units', $floor->units)}}" max="{{$floor->project->units}}" >
                             <span class="error invalid-feedback" id="error-units{{$floor->id}}" style="font-weight: bold;"></span>

                              @error('units')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>                           

                           <button type="submit" class="btn btn-success btn-block" data-id="{{$floor->id}}">Add</button>
                         </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
@if($loop->first)
<a id="delete" href="{{route('admin.floor.delete',$floor->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
@endif
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                {{$units_count}} total units in this project.
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