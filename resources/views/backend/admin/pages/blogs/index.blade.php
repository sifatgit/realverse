@extends('backend.admin.index')
@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Blogs Table</h3><br><button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>
                <!--slider store modal-->
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Write New Blog</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                         <form class="myblogForm" action="{{route('admin.blog.store')}}" method="Post" enctype="multipart/form-data">
                          @csrf

                           <div class="form-group">
                             <label for="exampleInputPassword1">Blog topic</label>
                             <input type="text" class="form-control @error('topic') is-invalid @enderror topic" name="topic" value="{{old('topic')}}" >
                                <span class="error invalid-feedback" id="error-topic" style="font-weight: bold;"></span>

                              @error('topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>  

                           <div class="form-group">
                             <label for="exampleInputPassword1">Blog title</label>
                             <input type="text" class="form-control @error('title') is-invalid @enderror title" name="title" value="{{old('title')}}" >
                                <span class="error invalid-feedback" id="error-title" style="font-weight: bold;"></span>

                              @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
                             <label>Details</label>
                             <textarea name="details" class="form-control @error('details') is-invalid @enderror details" >{{old('details')}}</textarea>
                             <span class="error invalid-feedback" id="error-details" style="font-weight: bold;"></span>

                             @error('details')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                             </span>
                             @enderror
                           </div>

                           <div class="form-group">
                             <label for="exampleInputPassword1">Author</label>
                             <input type="text" class="form-control @error('author') is-invalid @enderror author" name="author" value="{{old('author')}}" >
                                <span class="error invalid-feedback" id="error-author" style="font-weight: bold;"></span>

                              @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>

                           <button type="submit" class="btn btn-success btn-block">post</button>
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
                    <th>Blog topic</th>
                    <th>Blog image</th>


                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($blogs as $blog)
                    <tr>
                      <td>{{$blog->id}}</td>
                        <td>{{$blog->topic}}</td>
                        <td> <img src="{{URL::to($blog->image)}}" style="width: 200px; height: 150px;"> </td>                                                                
     

                      <td>
                  

 <a data-toggle="modal" data-target="#modal-default{{$blog->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--product view modal-->
      <div class="modal fade" id="modal-default{{$blog->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View {{$blog->topic}} Blog</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2> {{$blog->topic}} blog Details</h2></div>
                 <div class="card-body">
        <div id="carouselExampleControls{{$blog->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{URL::to($blog->image)}}" style="width:700px; height:700px;" alt="First slide">
            </div>
           
         
          </div>
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
                <ul>
                  <li><strong>Title: </strong>{{$blog->title}} </li>
                  <li><strong>Details: </strong><p>{{$blog->details}}</p> </li>
                  <li><strong>Author: </strong>{{$blog->author}} </li>
                  
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
<a id="delete" href="{{route('admin.blog.delete',$blog->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
<a class="btn btn-info" href="{{route('admin.blog.comments',$blog->id)}}">View Comments</a>
</td>
                    </tr>
                    @endforeach                 
                  </tbody>
                  
                </table>
<a id="delete" class="btn btn-danger" href="{{route('admin.blogs.delete')}}">Delete all blogs.</a>                
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