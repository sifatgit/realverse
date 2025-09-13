@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers Table</h3><br>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>


                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                        <td>{{$user->first_name.' '.$user->last_name}}</td>
                        <td>{{$user->email}}</td>                      
                        <td>{{$user->phone}}</td>                      
                                           
                                                                   
     

                      <td>
                  


<a id="delete" href="{{route('admin.user.delete',$user->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
 <a data-toggle="modal" data-target="#modal-default{{$user->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--product view modal-->
      <div class="modal fade" id="modal-default{{$user->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>Customer Details</h2></div>
                 <div class="card-body">
        <div id="carouselExampleControls{{$user->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            
            <div class="carousel-item active">
            	@if($user->image)
              <img class="d-block w-100" src="{{URL::to($user->image)}}" style="width:88px; height:500px;" alt="First slide">
              @else
              <img class="d-block w-100" src="{{asset('public/frontend/assets/img/profile-1.png')}}" style="width:88px; height:500px;" alt="First slide">
              @endif

            </div>
           
         
          </div>
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
                <ul>
                  <li><strong>Name: </strong>{{$user->first_name.' '.$user->last_name}}</li>
                  <li><strong>Username: </strong>{{$user->username}}</li>
                  <li><strong>Email: </strong>{{$user->email}} </li>
                  <li><strong>Phone: </strong>{{$user->phone}} </li>
                  <li><strong>Facebook: </strong>{{$user->facebook ? $user->facebook : 'N/A'}} </li>
                  <li><strong>Mail: </strong>{{$user->mail ? $user->mail : 'N/A'}} </li>
                  <li><strong>Twitter: </strong>{{$user->twitter ? $user->twitter : 'N/A'}} </li>
                  <li><strong>Linkedin: </strong>{{$user->linkedin ? $user->linkedin : 'N/A'}} </li>
                  <li><strong>Website: </strong>{{$user->website ? $user->website : 'N/A'}} </li>
                  <li><strong>Fax: </strong>{{$user->fax ? $user->fax : 'N/A'}} </li>
                  
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
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                {{$users->links()}}
                <a id="delete" class="btn btn-danger" href="{{route('admin.users.delete')}}">Delete all projects.</a>
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