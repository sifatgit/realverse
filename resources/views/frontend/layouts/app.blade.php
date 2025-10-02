<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Realverse</title>
        <meta name="description" content="GARO is a real-estate template">
        <meta name="author" content="Kimarotec">
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        @include('frontend.partials.styles')
        
    </head>
    <body>

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <!-- Body content -->


        <div class="header-connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8  col-xs-12">
                        <div class="header-half header-call">
                            <p> 
                                @if($setting && $setting->phone_no)
                                <span><i class="pe-7s-call"></i> {{$setting->phone_no}}</span>
                                @else
                                <span><i class="pe-7s-call"></i> +1 000 589 874</span>
                                @endif
                                @if($setting && $setting->email)
                                <span><i class="pe-7s-mail"></i> {{$setting->email}}</span>
                                @else
                                <span><i class="pe-7s-mail"></i> your@email.com</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-14">
                        <div class="header-half header-social">
                            <ul class="list-inline">
                                @if($setting && $setting->facebook_address)
                                <li><a href="{{$setting->facebook_address}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                @else
                                <li><a href="#" ><i class="fa fa-facebook"></i></a></li>
                                @endif

                                @if($setting && $setting->instagram_address)
                                <li><a href="{{$setting->instagram_address}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                @else
                                <li><a href="#" ><i class="fa fa-instagram"></i></a></li>
                                @endif

                                @if($setting && $setting->whatsapp_address)
                                <li><a href="{{$setting->whatsapp_address}}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                @else                                
                                <li><a href="#" ><i class="fa fa-whatsapp"></i></a></li>
                                @endif

                                @if($setting && $setting->googleplus_address)
                                <li><a href="{{$setting->googleplus_address}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                @else
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                @endif

                                @if($setting && $setting->twitter_address)
                                <li><a href="{{$setting->twitter_address}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                @else
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                @endif

                                @if($setting && $setting->linkedin_address)
                                <li><a href="{{$setting->linkedin_address}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                @else
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                @endif




                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>         
        <!--End top header -->

        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if($setting && $setting->logo)
                    <a class="navbar-brand" href="{{url('/')}}"><img width="195.8378" height="48" src="{{URL::to($setting->logo)}}" alt=""></a>
                    @else
                    <a class="navbar-brand" href="{{url('/')}}"><img style="width: 195.8378 px; height: 48 px;" src="{{asset('frontend/assets/img/logo.png')}}" alt=""></a>
                    @endif
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation">
                    <div class="button navbar-right">
                        @guest
                        <button class="navbar-btn nav-button wow bounceInRight login " onclick=" window.location.href='{{url('/login')}}'" data-wow-delay="0.4s">Login</button>
                        @endguest
                        @auth
                        <div class="profile-dropdown-wrapper">
                            <!-- Profile Dropdown -->
                            <div class="dropdown">
                                <button class="navbar-btn nav-button wow bounceInRight login dropdown-toggle">
                                    Profile <b class="caret"></b>
                                </button>
                                <form id="logout-form" style="display: none;" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <ul>
                                                        <li><a href="{{ route('user.units') }}">My Properties</a></li>
                                                        <li><a href="{{ route('profile.edit') }}">My Profile</a></li>
                                                        <li><a href="{{ route('password.confirm') }}">Change Password</a></li>
                                                        <li>
                                                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Submit button outside dropdown -->
                            <button class="navbar-btn nav-button wow fadeInRight {{ request()->routeIs('unit.form') ? 'submit' : '' }}" onclick="window.location.href='{{ route('unit.form') }}'" data-wow-delay="0.5s">Submit</button>
                        </div>

                                               
                        @endauth

                    </div>
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                            <a href="{{url('/')}}" class="{{ request()->is('/') ? 'active' : '' }}" >Home </a>
                            
                        </li>
                        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                            <a href="{{route('units')}}" class="{{ request()->routeIs('units') ? 'active' : '' }}">Properties </a>
                            
                        </li>
                        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                            <a href="{{route('blogs')}}" class="{{ request()->routeIs('blogs') ? 'active' : '' }}" >Blogs </a>
                            
                        </li>
                        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                            <a href="{{route('contact')}}" class="{{ request()->routeIs('contact') ? 'active' : '' }}" >Contact </a>
                            
                        </li>
                        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                            <a href="{{route('about_us')}}" class="{{ request()->routeIs('about_us') ? 'active' : '' }}" >About Us </a>
                            
                        </li>

                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->

        @yield('content')


          <!-- Footer area-->
        <div class="footer-area">

            <div class=" footer">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>About us </h4>
                                <div class="footer-title-line"></div>

                                @if($setting && $setting->logo)
                                <img src="{{URL::to($setting->logo)}}" alt="" class="wow pulse" data-wow-delay="1s">
                                @endif
                                @if($setting && $setting->about_us_headline)
                                <p>{{$setting->about_us_headline}}</p>
                                @endif
                                <ul class="footer-adress">
                                    @if($setting && $setting->address)
                                    <li><i class="pe-7s-map-marker strong"> </i> {{$setting->address}}</li>
                                    @endif
                                    @if($setting && $setting->email)
                                    <li><i class="pe-7s-mail strong"> </i> {{$setting->email}}</li>
                                    @endif
                                    @if($setting && $setting->phone_no)
                                    <li><i class="pe-7s-call strong"> </i> {{$setting->phone_no}}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Quick links </h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-menu">
                                    <li><a href="{{route('units')}}">Properties</a>  </li> 
                                     
                                    <li><a href="{{route('unit.form')}}">Submit property </a></li>
                                    <li><a href="{{route('contact')}}">Contact us</a></li>                                  <li><a href="{{route('about_us')}}">About us</a></li>  
                                    <li><a href="{{url('/terms-conditions')}}">Terms & Conditions</a>  </li> 
                                    <li><a href="{{url('/privacy-policy')}}">Privacy Policy </a>  </li> 
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Latest blogs</h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-blog">
                                    @foreach($latest_blogs as $blog)
                                    <li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="{{route('blog.show',$blog->id)}}">
                                                <img style="width: 66px; height: 60px;" src="{{URL::to($blog->image)}}">
                                            </a>
                                            <span class="blg-date">{{$blog->created_at->format('d m Y')}}</span>

                                        </div>
                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="{{route('blog.show',$blog->id)}}">{{$blog->topic}} </a></h6> 
                                            <p style="line-height: 17px; padding: 8px 2px;">{{\Illuminate\Support\Str::words($blog->details, 5)}} ...</p>
                                        </div>
                                    </li> 
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer news-letter">
                                <h4>Stay in touch</h4>
                                <div class="footer-title-line"></div>
                                <p>You can always contact us via various medias. You can also subscribe to our newsletter to get all the latest updates in real-estate universe.</p>

                                <form class="mysubscribeform" action="{{route('subscribe')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="E-mail ... " name="email" required>
                                        <span class="input-group-btn">
                                            <button  class="btn subscribe" style="background-color: #83CFE5;" type="submit"><i class="pe-7s-paper-plane pe-2x"></i></button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </form> 

                                <div class="social pull-right"> 
                                    <ul>

                                        @if($setting && $setting->facebook_address)
                                        <li><a class="wow fadeInUp animated" href="{{$setting->facebook_address}}" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                                        @else
                                        <li><a class="wow fadeInUp animated" href="#" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                                        @endif
                                                                                
                                        @if($setting && $setting->twitter_address)
                                        <li><a class="wow fadeInUp animated" href="{{$setting->twitter_address}}"><i class="fa fa-twitter"></i></a></li>
                                        @else
                                        <li><a class="wow fadeInUp animated" href="#"><i class="fa fa-twitter"></i></a></li>
                                        @endif

                                        @if($setting && $setting->googleplus_address)
                                        <li><a class="wow fadeInUp animated" href="{{$setting->googleplus_address}}" data-wow-delay="0.3s"><i class="fa fa-google-plus"></i></a></li>
                                        @else
                                        <li><a class="wow fadeInUp animated" href="#" data-wow-delay="0.3s"><i class="fa fa-google-plus"></i></a></li>
                                        @endif

                                        @if($setting && $setting->instagram_address)
                                        <li><a class="wow fadeInUp animated" href="{{$settin->instagram_address}}" data-wow-delay="0.4s"><i class="fa fa-instagram"></i></a></li>
                                        @else
                                        <li><a class="wow fadeInUp animated" href="#" data-wow-delay="0.4s"><i class="fa fa-instagram"></i></a></li>
                                        @endif

                                        @if($setting && $setting->pinterest_address)
                                        <li><a class="wow fadeInUp animated" href="{{$setting->pinterest_address}}" data-wow-delay="0.4s"><i class="fa fa-pinterest-p"></i></a></li>
                                        @else
                                        <li><a class="wow fadeInUp animated" href="#" data-wow-delay="0.4s"><i class="fa fa-pinterest-p"></i></a></li>                                        
                                        @endif

                                    </ul> 
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-copy text-center">
                <div class="container">
                    <div class="row">
                        <div class="pull-left">
                            <span> (C) <a href="http://www.KimaroTec.com">KimaroTheme</a> , All rights reserved 2016  </span> 
                        </div> 
                        <div class="bottom-menu pull-right"> 
                            <ul> 
                                <li><a class="wow fadeInUp animated" href="{{url('/')}}" data-wow-delay="0.2s">Home</a></li>
                                <li><a class="wow fadeInUp animated" href="{{route('units')}}" data-wow-delay="0.3s">Properies</a></li>
                                <li><a class="wow fadeInUp animated" href="{{route('contact')}}" data-wow-delay="0.6s">Contact</a></li>
                                <li><a class="wow fadeInUp animated" href="{{route('about_us')}}" data-wow-delay="0.6s">About Us</a></li>                                
                                <li><a class="wow fadeInUp animated" href="{{url('/terms-conditions')}}" data-wow-delay="0.4s">Terms & Conditions</a></li>
                                <li><a class="wow fadeInUp animated" href="{{url('/privacy-policy')}}" data-wow-delay="0.4s">Privacy Policy</a></li>

                            </ul> 
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('frontend.partials.scripts')

             
    </body>
</html>