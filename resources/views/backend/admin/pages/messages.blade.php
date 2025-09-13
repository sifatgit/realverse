@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Messages Table</h3><br>
                <!--slider store modal-->
               
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>


                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($messages as $message)
                    <tr>
                      <td>{{$message->id}}</td>
                        <td>{{$message->firstname. ' '. $message->lastname}}</td>                      
                        <td>{{$message->email}}</td>                                                                                    
                        <td>{{$message->subject}}</td>                                                                                    
                        <td>{{$message->message}}</td>
                        <td>Replied <br>

                        <select class="form-control messagestatus" data-id="{{$message->id}}">
                        	<option value="">Select one</option>
                        	<option  value="1">Yes</option>
                        	<option  value="0">No</option>
                        </select>

                    	</td>                                                                                  
     

                      <td>
                  


<a id="delete" href="{{route('admin.message.delete',$message->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                <a id="delete" class="btn btn-danger" href="{{route('admin.messages.delete')}}">Delete all messages.</a>
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