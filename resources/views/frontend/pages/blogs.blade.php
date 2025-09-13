@extends('frontend.index')
@section('homeContent')
        <div class="content-area blog-page padding-top-40" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">   
                <div class="row">
                    <div class="blog-lst col-md-12 pl0">
                        @foreach($blogs as $blog)
                        @php $count_comments = count(App\Models\Comment::where('blog_id',$blog->id)->get()) @endphp
                        <section class="post">
                            <div class="text-center padding-b-50">
                                <h2 class="wow fadeInLeft animated">{{$blog->title}}</h2>
                                <div class="title-line wow fadeInRight animated"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="author-category">
                                        By <a href="#">{{$blog->author}}</a>
                                        in <a href="#">{{$blog->topic}}</a>
                                    </p>
                                </div>
                                <div class="col-sm-6 right" >
                                    <p class="date-comments">
                                        <a href="#"><i class="fa fa-calendar-o"></i> {{date_format($blog->created_at, 'd M Y')}}</a>
                                        <a href="#"><i class="fa fa-comment-o"></i> {{$count_comments}} Comments</a>
                                    </p>
                                </div>
                            </div>
                            <div class="image wow fadeInLeft animated">
                                <a href="{{route('blog.show',$blog->id)}}">
                                    <img src="{{URL::to($blog->image)}}" class="img-responsive" alt="Example blog post alt">
                                </a>
                            </div>
                            <p class="intro">{{Str::limit($blog->details,200)}}</p>
                            <p class="read-more">
                                <a href="{{route('blog.show',$blog->id)}}" class="btn btn-default btn-border">Continue reading</a>
                            </p>
                        </section>
                        @endforeach   

                    </div>  
                </div>

            </div>
        </div>
@endsection