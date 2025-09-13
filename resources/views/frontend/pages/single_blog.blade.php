@extends('frontend.index')
@section('homeContent')
@php $count_comments = count(App\Models\Comment::where('blog_id',$blog->id)->get()) @endphp
        <div class="content-area blog-page padding-top-40" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">
                <div class="row">
                    <div class="blog-lst col-md-12 pl0">
                        <section id="id-100" class="post single">

                            <div class="post-header single">
                                <div class="">
                                    <h2 class="wow fadeInLeft animated">{{$blog->title}}</h2>
                                    <div class="title-line wow fadeInRight animated"></div>
                                </div>
                                <div class="row wow fadeInRight animated">
                                    <div class="col-sm-6">
                                        <p class="author-category">
                                            By <a href="#">{{$blog->author}}</a>
                                            in <a href="#">{{$blog->topic}}</a>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 right" >
                                        <p class="date-comments">
                                            <a href="#"><i class="fa fa-calendar-o"></i> {{$blog->created_at->format('d M Y')}}</a>
                                            <a id="comments_counter" href="#"><i class="fa fa-comment-o"></i> {{$count_comments}} Comments</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="image wow fadeInRight animated"> 
                                    <img src="{{URL::to($blog->image)}}" class="img-responsive" alt="Example blog post alt">
                                </div>
                            </div> 

                            <div id="post-content" class="post-body single wow fadeInLeft animated">
                                <p>
                                    {{$blog->details}}</p>

                            </div>   

                        </section> 

                        <section class="about-autor">

                        </section>
                        @php
                        if(Auth::check()){
                        $name = Auth::user()->first_name.' '.Auth::user()->last_name;
                        $email = Auth::user()->email;                            
                        }

                        

                        else{

                        $name = '';
                        $email = '';

                        }


                        @endphp

                        <section id="comment-form" class="add-comments">
                            <h4 class="text-uppercase wow fadeInLeft animated">Leave comment</h4>
                            <form class="mycommentform" action="{{route('comment.post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">
                                <input class="blog_id" type="hidden" name="blog_id" value="{{$blog->id}}">

                                <div class="row wow fadeInLeft animated">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name <span class="required">*</span>
                                            </label>
                                            <input class="form-control name" id="name" name="name" type="text" value="{{$name}}" {{Auth::check() ? 'readonly' : ''}}>
                                            <span class="error invalid-feedback" id="error-name" style="font-weight: bold;"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row wow fadeInLeft animated">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="required">*</span>
                                            </label>
                                            <input class="form-control email" id="email" name="email" type="text" value="{{$email}}" {{Auth::check() ? 'readonly' : ''}}>
                                            <span class="error invalid-feedback" id="error-email" style="font-weight: bold;"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row wow fadeInLeft animated">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="comment">Comment <span class="required">*</span>
                                            </label>
                                            <textarea class="form-control comment" id="comment" name="comment" rows="4"></textarea>
                                            <span class="error invalid-feedback" id="error-comment" style="font-weight: bold;"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row wow fadeInLeft animated">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-comment-o"></i> Post comment</button>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section id="comments" class="comments wow fadeInRight animated"> 
                            <h4 id="comment_counter" class="text-uppercase wow fadeInLeft animated">{{$count_comments}} comments</h4>

                            @foreach($comments as $comment)
                            <div class="row comment">
                                <div class="col-sm-3 col-md-2 text-center-xs">
                                    <p> @auth
                                        @if(Auth::user()->image)
                                        <img src="{{URL::to(Auth::user()->image)}}" class="img-responsive img-circle" alt="">
                                        @else
                                        <img src="{{asset('public/frontend/assets/img/profile-1.png')}}" class="img-responsive img-circle" alt="">
                                        @endif

                                        @else
                                        <img src="{{asset('public/frontend/assets/img/profile-1.png')}}" class="img-responsive img-circle" alt="">                                        
                                        @endauth
                                    </p>
                                </div>
                                <div class="col-sm-9 col-md-10">
                                    <h5 class="text-uppercase">{{$comment->name}}</h5>
                                    <p class="posted"><i class="fa fa-clock-o"></i> {{date_format($comment->created_at, 'F j, Y, g:i a')}}</p>
                                    <p>{{$comment->comment}}</p>
                                    
                                </div>
                            </div>
                            @endforeach


                            <!-- /.comment -->
                        </section>
                        <section >
                            

                            <button id="load_more" data-id="{{ $comments->last()->id ?? null }}" class="btn btn-primary" type="button">Load more comments</button>
                        </section>


                    </div>                                 
                </div>

            </div>
        </div>
@endsection