@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Comments Table</h3><br>
                <!--slider store modal-->
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Blog Title</th>
                    <th>Blog Image</th>
                    <th>Commenter name</th>
                    <th>Commenter Image</th>
                    <th>Email</th>


                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($comments as $comment)
                    <tr>
                      <td>{{$comment->id}}</td>
                        <td>{{$comment->blog->title}}</td>
                        <td><img src="{{URL::to($comment->blog->image)}}" style="width: 200px; height: 150px;"></td>
                        <td>{{$comment->name}}</td>
                        @if($comment->user)
                        <td> <img src="{{file_exists($comment->user->image) ? URL::to($comment->user->image) : asset('public/frontend/assets/img/profile-1.png')}}" style="width: 200px; height: 150px;"> </td>
                        @else
                        <td> <img src="{{asset('public/frontend/assets/img/profile-1.png')}}" style="width: 200px; height: 150px;"> </td>                        
                        @endif
                        <td>{{$comment->email}}</td>                                                                
     

                      <td>
                
<a id="delete" href="{{route('admin.blog.comment.delete',$comment->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>

</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
                {{$comments->links()}}
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