@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rated Units Table</h3><br>
                <!--slider store modal-->
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Unit Project name</th>
                    <th>Unit Floor number</th>
                    <th>Unit number</th>
                    <th>Unit image</th>
                    <th>Full area</th>
                    <th>Sell status</th>
                    <th>Construction status</th>
                    <th>Price</th>



                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($units as $unit)
                    <tr>
                      <td>{{$unit->id}}</td>
                        <td>{{$unit->unit->project->name}}</td>
                        <td>{{$unit->unit->floor->floor}}</td>
                        <td>{{$unit->unit->number}}</td>
                                    @php
                                    $images = explode(",",$unit->unit->image_path);
                                    $image = $images[0] ?? '';
                                        $isValid = filter_var($image, FILTER_VALIDATE_URL) || file_exists($image) && !is_dir($image);
                                        $src = $isValid ? URL::to($image) : asset('public/frontend/images/submittedunits/invalid_images/No_image_available.svg.png');                                    
                                    @endphp                         
                        <td> <img src="{{$src}}" style="width: 200px; height: 150px;"> </td>                                                                
     					<td>{{$unit->unit->area_sqft + $unit->unit->project->common_area}} sqft</td>
     					<td>{{$unit->is_sold ? 'Sold' : 'Available'}}</td>
     					<td>{{$unit->under_construction ? 'Under Construction' : 'Complete'}}</td>
     					<td>${{number_format($unit->unit->price)}}</td>

                      <td>
                  

 <a data-toggle="modal" data-target="#modal-default{{$unit->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--product view modal-->
      <div class="modal fade" id="modal-default{{$unit->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View {{$unit->unit->project->name.' '.$unit->unit->number}} unit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2> Unit Details</h2></div>
                 <div class="card-body">
        <div id="carouselExampleControls{{$unit->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{$src}}" style="width:400; height:350px;" alt="First slide">
            </div>
           
         
          </div>
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
              	<h3>Amenities</h3>
                <ul>
                  <li><strong>Living room: </strong>{{$unit->unit->living_room}} </li>
                  <li><strong>Dining room: </strong>{{$unit->unit->dining_room}} </li>
                  <li><strong>Bedrooms: </strong>{{$unit->unit->bedrooms}} </li>
                  <li><strong>Bathrooms: </strong>{{$unit->unit->bathrooms}} </li>
                  <li><strong>Balconies: </strong>{{$unit->unit->balconies}} </li>
                  <li><strong>Net Area: </strong>{{$unit->unit->area_sqft}} sqft </li>
                  <li><strong>Common Area: </strong>{{$unit->unit->project->common_area}} sqft</li>
                  <li><strong>View: </strong>{{$unit->unit->view}}</li>
                  <li><strong>Direction: </strong>{{strtoupper($unit->unit->direction)}}</li>
                  
                </ul>
              </div>
            </div>
          </div>
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
<a id="delete" href="{{route('admin.ratedunit.delete',$unit->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
<a id="delete" class="btn btn-danger" href="{{route('admin.ratedunits.delete')}}">Delete all rated units.</a>                
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
@endsection