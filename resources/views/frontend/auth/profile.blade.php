@extends('frontend.index')
@section('homeContent')
        <div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Hello : <span class="orange strong">{{$user->username}}</span></h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header --> 

        <!-- property area -->
        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <form class="myprofileupdateform" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="profiel-header">
                                <h3>
                                    <b>Complete</b> YOUR PROFILE <br>
                                    <small>This information will let us know more about you.</small>
                                </h3>
                                <hr>
                            </div>

                            <div class="clear">
                                <div class="col-sm-3 col-sm-offset-1">
                                    <div class="picture-container">
                                        <div class="picture">
                                            @if($user->image)
                                            <img src="{{URL::to($user->image)}}" class="picture-src" id="wizardPicturePreview" title=""/>
                                            @else
                                            <img src="assets/img/avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>                                            
                                            @endif
                                            <input class="@error('image') is-invalid @enderror image" type="file" id="wizard-picture" name="image">
                                             <span class="error invalid-feedback" id="error-image" style="font-weight: bold;"></span>

                                             @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                            
                                        </div>
                                        <h6>{{$user->image ? 'Change profile picture' : 'Choose profile picture'}}</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3 padding-top-25">

                                    <div class="form-group">
                                        <label>Username <small></small></label>
                                        <input name="username" type="text" class="form-control username @error('username') is-invalid @enderror" placeholder="Andrew..."  value="{{ old('username' , $user->username)}}">
                                        <span class="error invalid-feedback" id="error-username" style="font-weight: bold;"></span>
                                  @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>First Name <small></small></label>
                                        <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror first_name" placeholder="Andrew..."  value="{{ old('first_name' , $user->first_name)}}">
                                        <span class="error invalid-feedback" id="error-first_name" style="font-weight: bold;"></span>

                                  @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label>Phone <small></small></label>
                                        <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror phone" placeholder="+18851514236" value="{{ old('phone', $user->phone)}}">
                                        <span class="error invalid-feedback" id="error-phone" style="font-weight: bold;"></span>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror                                         
                                    </div>                                                                         

                                </div>
                                <div class="col-sm-3 padding-top-25">
                                    <div class="form-group">
                                        <label>Email <small></small></label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror email" placeholder="andrew@email@email.com.com" value="{{ old('email', $user->email)}}">
                                        <span class="error invalid-feedback" id="error-email" style="font-weight: bold;"></span>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name <small></small></label>
                                        <input name="last_name" type="text" class="form-control  @error('last_name') is-invalid @enderror last_name" placeholder="Smith..." value="{{ old('last_name', $user->last_name)}}">
                                        <span class="error invalid-feedback" id="error-last_name" style="font-weight: bold;"></span>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                    </div>                                                                        
                                    <div class="form-group">
                                        <label></label><br>
                                        <a class="btn btn-finish btn-primary pull-right" href="{{route('password.confirm')}}">Change Password</a>
                                    </div>                                                                        
                                    
                                </div>  

                            </div>

                            <div class="clear">
                                <br>
                                <hr>
                                <br>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Facebook :</label>
                                        <input name="facebook" type="url" class="form-control facebook" placeholder="https://facebook.com/user" value="{{ old('facebook', $user->facebook)}}">
                                        <span class="error invalid-feedback" id="error-facebook" style="font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter :</label>
                                        <input name="twitter" type="url" class="form-control twitter" placeholder="https://Twitter.com/@user" value="{{ old('twitter', $user->twitter)}}">
                                        <span class="error invalid-feedback" id="error-twitter" style="font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Linkedin :</label>
                                        <input name="linkedin" type="url" class="form-control linkedin" placeholder="https://yoursite.com/" value="{{ old('linkedin', $user->linkedin)}}">
                                        <span class="error invalid-feedback" id="error-linkedin" style="font-weight: bold;"></span>
                                    </div>
                                </div>  

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Public email :</label>
                                        <input name="mail" type="email" class="form-control mail" placeholder="email@rmail.com">
                                        <span class="error invalid-feedback" id="error-mail" style="font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Website :</label>
                                        <input name="website" type="url" class="form-control website" placeholder="+1 9090909090">
                                        <span class="error invalid-feedback" id="error-website" style="font-weight: bold;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>FAX :</label>
                                        <input name="fax" type="text" class="form-control fax" placeholder="+1 9090909090">
                                        <span class="error invalid-feedback" id="error-fax" style="font-weight: bold;"></span>
                                    </div>
                                </div>
 
                            </div>
                    
                            <div class="col-sm-5 col-sm-offset-1">
                                <br>
                                <input type='submit' class='btn btn-finish btn-primary' name='finish' value='Finish' />
                            </div>
                            <br>
                    </form>

                </div>
            </div><!-- end row -->

        </div>
        </div>
@endsection