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
                        <form class="mypasswordupdateform" action="{{route('password.update')}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="profiel-header">
                                <h3>
                                    <b>UPDATE</b> YOUR PASSWORD <br>
                                    <small>All change will send to your e-mail.</small>
                                </h3>
                                <hr>
                            </div>

                            <div class="clear">

                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Current Password <small>(required)</small></label>
                                        <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror current_password">
                                        <span class="error invalid-feedback" id="error-current_password" style="font-weight: bold;"></span>                                        
                                  @error('current_password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror                                        
                                    </div>
                                    <div class="form-group">
                                        <label>New password : <small>(required)</small></label>
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror password">
                                        <span class="error invalid-feedback" id="error-password" style="font-weight: bold;"></span> 
                                  @error('password' , 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror                                          
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm password : <small>(required)</small></label>
                                        <input name="password_confirmation" type="password" class="form-control">
                                    </div> 
                                </div>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type='submit' class='btn btn-finish btn-primary pull-right' >Update</button>
                                </div>
                                
                            </div>
 
                    
                            
                            
                    </form>

                </div>
            </div><!-- end row -->

        </div>
    </div>
@endsection