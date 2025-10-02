                            <div class="row comment">
                                <div class="col-sm-3 col-md-2 text-center-xs">
                                    <p>
                                        @auth
                                        @if(Auth::user()->image)
                                        <img src="{{URL::to(Auth::user()->image)}}" class="img-responsive img-circle" alt="">
                                        @else
                                        <img src="{{asset('frontend/assets/img/profile-1.png')}}" class="img-responsive img-circle" alt="">
                                        @endif

                                        @else
                                        <img src="{{asset('frontend/assets/img/profile-1.png')}}" class="img-responsive img-circle" alt="">                                        
                                        @endauth
                                    </p>
                                </div>
                                <div class="col-sm-9 col-md-10">
                                    <h5 class="text-uppercase">{{$comment->name}}</h5>
                                    <p class="posted"><i class="fa fa-clock-o"></i> {{date_format($comment->created_at, 'F j, Y, g:i a')}}</p>
                                    <p>{{$comment->comment}}</p>
                                    
                                </div>
                            </div>