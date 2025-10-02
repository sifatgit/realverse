@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Units Table (Showing 
{{ $units->count() }} records of {{ $units->total() }}
 

              from the database) </h3><br>

              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Unit no.</th>
                    <th>Image</th>
                    <th>Video</th>
                    <th>Area</th>
                    <th>Type</th>
                    <th>Condition</th>
                    <th>Price</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($units as $unit)
                    <tr>
                      <td>{{$unit->id}}</td>                                          
                        <td>{{$unit->number}}</td>
                                    @php
                                    $images = explode(",",$unit->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                        $src = $isValid ? URL::to($image) : asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp
                        <td><img src="{{ $src }}" style="width:200px; height:150px;">
                        </td>
                        <td>
                          {{$unit->video_path}}

                        Your browser does not support the video tag.
                    </video>

                      </td>                 
                        <td>{{number_format($unit->area_sqft)}} sqft</td>                                          
                        <td>{{ucfirst($unit->type)}}</td>                                          
                        <td>{{ucfirst($unit->condition)}}</td>  
                        <td>{{number_format($unit->price)}} TK</td>            
     

                      <td>

 <a data-toggle="modal" data-target="#modal-default{{$unit->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--unit view modal-->
      <div class="modal fade" id="modal-default{{$unit->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Unit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>Unit Details</h2></div>
                 <div class="card-body">
        <div id="carouselExampleControls{{$unit->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            
    @foreach(explode("|",$unit->image_path) as $image)
    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      @if(file_exists($image))
      <img class="d-block w-100 img-responsive" src="{{URL::to($image)}}" style="width:700px; height:700px;" alt="First slide">
      @else
      <img class="d-block w-100 img-responsive" src="{{asset('frontend/images/submittedunits/invalid_images/No_image_available.svg.png')}}" style="width:700px; height:700px;" alt="First slide">      
      @endif
    </div>
    @endforeach
           
         
          </div>
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
                <img class="profile-pic" src="{{file_exists($unit->user_photo) ? URL::to($unit->user_photo) : asset('frontend/assets/img/profile-1.png') }}">
                <h2>Submitted By: {{$unit->user->first_name.' '.$unit->user->last_name}} </h2>
                <ul>
                  <li><strong>Floor: </strong>{{$unit->floor}}</li>
                  <li><strong>Bedrooms: </strong>{{$unit->bedrooms}} </li>
                  <li><strong>Bbathrooms: </strong>{{$unit->bathrooms}} </li>
                  <li><strong>Balconies: </strong>{{$unit->bathrooms}} </li>
                  <li><strong>Build Date: </strong>{{$unit->build_date->format('d M Y')}} </li>
                  
                  
                </ul>
              </div>
            </div>
          </div>
              <h4><strong>Description</strong></h4>
                   <p class="card-footer">{{$unit->description}}</p>
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>                   
                  
<a id="delete" href="{{route('admin.userunit.delete',$unit->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                {{$units->links()}}<a id="delete" class="btn btn-danger" href="{{route('admin.userunits.delete')}}">Delete all customer units.</a>
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