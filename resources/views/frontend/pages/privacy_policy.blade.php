@extends('frontend.index')
@section('homeContent')
        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">    

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>Privacy Policy</h2>
                        <br>
                    </div>
                </div>

                <div class="row row-feat"> 
                    <div class="col-md-12">
 
<div class="col-sm-8 col-sm-offset-2 text-center feat-list">

                            <div class="panel-group">
                                <div class="panel panel-default">
                                    @if($setting && $setting->privacy_policy)
                                    {{$setting->privacy_policy}}
                                    @endif
                                </div>
                            </div>
                            
                            
                        </div>
                        

                    </div>
                </div>
                
            </div>
        </div>
@endsection