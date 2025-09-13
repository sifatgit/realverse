@extends('frontend.index')
@section('homeContent')
        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">    

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>About Us </h2>
                        <h4>{{($setting && $setting->about_us_headline) ? $setting->about_us_headline : ''}}</h4>
                        <br>
                    </div>
                </div>

                <div class="row row-feat"> 
                    <div class="col-md-12">
 
                        <div class="col-sm-8 col-sm-offset-2 text-center feat-list">

                            <div class="panel-group">
                                <div class="panel panel-default">
                                    @if($setting && $setting->about_us_image)
                                    <img class="post-content" src="{{URL::to($setting->about_us_image)}}">
                                    @endif
                                </div>
                            </div>
                            
                            
                        </div>
                        

                    </div>
                </div>                
                <div class="row row-feat"> 
                    <div class="col-md-12">
 
                        <div class="col-sm-8 col-sm-offset-2 text-center feat-list">

                            <div class="panel-group">
                                <div class="panel panel-default">
                                    @if($setting && $setting->about_us_description)
                                    {{$setting->about_us_description}}
                                    @endif
                                </div>
                            </div>
                            
                            
                        </div>
                        

                    </div>
                </div>
                
            </div>
        </div>
@endsection