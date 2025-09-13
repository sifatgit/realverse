@extends('frontend.index')
@section('homeContent')

        <!-- register-area -->
        <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

                <div class="col-md-6">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 register-blocks">
                            <h2>New account : </h2> 
                            <form class="myregisterform" action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control first_name" id="first_name" name="first_name" value="{{ old('first_name')}}">
                                    <span class="error invalid-feedback" id="error-first_name" style="font-weight: bold;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control last_name" id="last_name" name="last_name" value="{{ old('last_name')}}">
                                    <span class="error invalid-feedback" id="error-last_name" style="font-weight: bold;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control username" id="username" name="username" value="{{ old('username')}}">
                                    <span class="error invalid-feedback" id="error-username" style="font-weight: bold;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control email" id="email" name="email" value="{{ old('email')}}">
                                    <span class="error invalid-feedback" id="error-email" style="font-weight: bold;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control phone" id="phone" name="phone" value="{{ old('phone')}}">
                                    <span class="error invalid-feedback" id="error-phone" style="font-weight: bold;"></span>
                                </div>                                
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control password" id="password" name="password">
                                    <span class="error invalid-feedback" id="error-password" style="font-weight: bold;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm password</label>
                                    <input type="password" class="form-control password_confirmation" id="password_confirmation" name="password_confirmation">
                                    <span class="error invalid-feedback" id="error-password_confirmation" style="font-weight: bold;"></span>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-for overflow">                         
                        <div class="col-md-12 col-xs-12 login-blocks">
                            <h2>Login : </h2><br>
                            @if(Session::has('message')) 
                            <span class="text-white bg-success">{{Session::get('message')}}</span>
                            @endif
                            <form class="myloginform" action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="login">Usernam/Email</label>
                                    <input type="login" class="form-control login" id="login" name="login" value="{{ old('login')}}">
                                    <span class="error invalid-feedback" id="error-login" style="font-weight: bold;"></span>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control password_log" id="password_log" name="password_log" >
                                    <span class="error invalid-feedback" id="error-password_log" style="font-weight: bold;"></span>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default"> Log in</button>
                                </div>
                            </form>
                            <br>
                            
                            <h2>Social login :  </h2> 
                            
                            <p>
                            <a class="login-social" href="{{route('auth.facebook')}}"><i class="fa fa-facebook"></i>&nbsp;Facebook</a> 
                            <a class="login-social" href="{{route('google.login')}}"><i class="fa fa-google-plus"></i>&nbsp;Gmail</a> 
                             
                            </p> 
                        </div>
                        
                    </div>
                </div>

            </div>
        </div> 
@endsection