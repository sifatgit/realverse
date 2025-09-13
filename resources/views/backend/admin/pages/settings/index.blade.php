@extends('backend.admin.index')
@section('content')
<h2>Admin Settings</h2>

@if(is_null($data))
<form class="site_settings_form" action="{{route('admin.settings.store')}}" enctype="multipart/form-data" method="POST">
	@csrf
 <!--begin::Body-->
    <div class="card-body">

        <div class="mb-3"> 
        	<label for="exampleInputtitle" class="form-label">Site Title</label> 
        	<input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror title" id="exampleInputtitle" aria-describedby="titlehelp">
          <span class="error invalid-feedback" id="error-title" style="font-weight: bold;"></span>

          @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>

        <div class="input-group mb-3">
            <label for="exampleInputtitle" class="form-label">Site Logo</label>  
        	<input name="logo" type="file" class="form-control @error('logo') is-invalid @enderror logo" id="inputGroupFile02"> 
        	<label class="input-group-text" for="inputGroupFile02">Upload</label>
          <span class="error invalid-feedback" id="error-logo" style="font-weight: bold;"></span>

        	@error('logo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>

        <div class="mb-3">
          <label>Slider Title</label>
          <input type="text" name="slider_title" value="{{old('slider_title')}}" class="form-control @error('slider_title') is-invalid @enderror slider_title" >
          <span class="error invalid-feedback" id="error-slider_title" style="font-weight: bold;"></span>

          @error('slider_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror          
        </div>

        <div class="mb-3">
          <label>Slider Decription</label>
          <textarea name="slider_description"  class="form-control @error('slider_description') is-invalid @enderror slider_description" >{{old('slider_description')}} </textarea>
          <span class="error invalid-feedback" id="error-slider_description" style="font-weight: bold;"></span>

          @error('slider_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror          
        </div>

        <div class="mb-3">
          <label for="examplephoneno">Phone No</label>
          <input type="tel" name="phone_no" value="{{old('phone_no')}}" class="form-control @error('phone_no') is-invalid @enderror phone_no" >
           <span class="error invalid-feedback" id="error-phone_no" style="font-weight: bold;"></span>       

          @error('phone_no')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

          </div>

        <div class="mb-3">
          <label for="examplephoneno">Email</label>
          <input type="email" name="email" value="{{old('email')}}"  class="form-control @error('email') is-invalid @enderror email" >
          <span class="error invalid-feedback" id="error-email" style="font-weight: bold;"></span>        

          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

          </div>

          <div class="mb-3">
          <label>Address</label>
          <textarea name="address" class="form-control @error('address') is-invalid @enderror address" id="exampleInputEmail1" placeholder="Enter Address" >{{old('address')}}</textarea>
          <span class="error invalid-feedback" id="error-address" style="font-weight: bold;"></span>

          @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
             </span>
           @enderror          	
          </div>

        <div class="mb-3">
                          <label>Google location Name</label>
                          <input type="text" name="location_name" value="{{old('location_name')}}" class="form-control @error('location_name') is-invalid @enderror location_name" >
                          <span class="error invalid-feedback" id="error-location_name" style="font-weight: bold;"></span>

                          @error('location_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror          
        </div>

        <div class="mb-3">
          <label>Google location Latitude</label>
          <input type="text" name="latitude" value="{{old('latitude')}}" class="form-control @error('latitude') is-invalid @enderror latitude" >
          <span class="error invalid-feedback" id="error-latitude" style="font-weight: bold;"></span>

          @error('latitude')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror          
        </div>

        <div class="mb-3">
                  <label>Google location Longitude</label>
                  <input type="text" name="longitude" value="{{old('longitude')}}" class="form-control @error('longitude') is-invalid @enderror longitude" >
                  <span class="error invalid-feedback" id="error-longitude" style="font-weight: bold;"></span>

                  @error('longitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror          
        </div>

          <div class="mb-3"> 
           <label for="exampleInputEmail1">Google Plus link</label>
           <input type="url" name="googleplus_address" value="{{old('googleplus_address')}}" class="form-control @error('googleplus_address') is-invalid @enderror googleplus_address" id="exampleInputemail1" placeholder="Enter googleplus link" >
           <span class="error invalid-feedback" id="error-googleplus_address" style="font-weight: bold;"></span>

           @error('googleplus_address')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
          </div>
          <div class="mb-3">
           <label for="exampleInputEmail1">Facebook Address</label>
           <input type="url" name="facebook_address" value="{{old('facebook_address')}}" class="form-control @error('facebook_address') is-invalid @enderror facebook_address" id="exampleInputemail1" placeholder="Enter facebook address" >
           <span class="error invalid-feedback" id="error-facebook_address" style="font-weight: bold;"></span>

           @error('facebook_address')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror          	
          </div>
          <div class="mb-3">
                    <label for="exampleInputEmail1">Instagram address</label>
                    <input type="url" name="instagram_address" value="{{old('instagram_address')}}" class="form-control @error('instagram_address') is-invalid @enderror instagram_address" id="exampleInputemail1" placeholder="Enter instagram address" >
                    <span class="error invalid-feedback" id="error-instagram_address" style="font-weight: bold;"></span>

                    @error('instagram_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>
          <div class="mb-3">
                    <label for="exampleInputEmail1">Linkedin address</label>
                    <input type="url" name="linkedin_address" value="{{old('linkedin_address')}}" class="form-control @error('linkedin_address') is-invalid @enderror linkedin_address" id="exampleInputemail1" placeholder="Enter linkedin address" >
                    <span class="error invalid-feedback" id="error-linkedin_address" style="font-weight: bold;"></span>

                    @error('linkedin_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>          
          <div class="mb-3">
                    <label for="exampleInputEmail1">Twitter address</label>
                    <input type="url" name="twitter_address" value="{{old('twitter_address')}}" class="form-control @error('twitter_address') is-invalid @enderror twitter_address" id="exampleInputemail1" placeholder="Enter twitter address" >
                    <span class="error invalid-feedback" id="error-twitter_address" style="font-weight: bold;"></span>

                    @error('twitter_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>

          <div class="mb-3">
                    <label for="exampleInputEmail1">Pinterest address</label>
                    <input type="url" name="pinterest_address" value="{{old('pinterest_address')}}" class="form-control @error('pinterest_address') is-invalid @enderror pinterest_address" id="exampleInputemail1" placeholder="Enter pinterest address" >
                    <span class="error invalid-feedback" id="error-pinterest_address" style="font-weight: bold;"></span>

                    @error('pinterest_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>          
          <div class="mb-3">
                    <label for="exampleInputEmail1">Whatsapp address</label>
                    <input type="url" name="whatsapp_address" value="{{old('whatsapp_address')}}" class="form-control @error('whatsapp_address') is-invalid @enderror whatsapp_address" id="exampleInputemail1" placeholder="Enter whatsapp address" >
                    <span class="error invalid-feedback" id="error-whatsapp_address" style="font-weight: bold;"></span>

                    @error('whatsapp_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>
			<div class="mb-3">
                    <label for="exampleInputEmail1">About us headline</label>
                    <input type="text" name="about_us_headline" value="{{old('about_us_headline')}}"  class="form-control @error('about_us_headline') is-invalid @enderror about_us_headline" id="exampleInputEmail1" placeholder="Enter about us headline" >
                    <span class="error invalid-feedback" id="error-about_us_headline" style="font-weight: bold;"></span>

                    @error('about_us_headline')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror				
			</div>			
                  <div class="form-group">
                    <label for="exampleInputFile">About us image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        <input type="file" name="about_us_image" class="custom-file-input @error('about_us_image') is-invalid @enderror about_us_image" id="exampleInputFile">

                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <span class="error invalid-feedback" id="error-about_us_image" style="font-weight: bold;"></span>

                        @error('about_us_image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1">About us description</label>
                    <textarea name="about_us_description" class="form-control @error('about_us_description') is-invalid @enderror about_us_description" id="exampleInputEmail1" placeholder="Enter about us description" >{{old('about_us_description')}}</textarea>
                    <span class="error invalid-feedback" id="error-about_us_description" style="font-weight: bold;"></span>

                    @error('about_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                  	
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact us description</label>
                    <textarea name="contact_us_description" class="form-control @error('contact_us_description') is-invalid @enderror contact_us_description" id="exampleInputEmail1" placeholder="Enter contact us" >{{old('contact_us_description')}}</textarea>
                    <span class="error invalid-feedback" id="error-contact_us_description" style="font-weight: bold;"></span>

                    @error('contact_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

   					<div class="mb-3">
                       <label>Terms & Conditions</label>
                    <textarea name="terms_conditions" class="form-control @error('terms_conditions') is-invalid @enderror terms_conditions" id="exampleInputEmail1" placeholder="Enter terms & conditions" >{{old('terms_conditions')}}</textarea>
                    <span class="error invalid-feedback" id="error-terms_conditions" style="font-weight: bold;"></span>

                    @error('terms_conditions')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror  						
   					</div>
   					<div class="mb-3">
                      <label>Privacy Policy</label>
                    <textarea name="privacy_policy" class="form-control @error('privacy_policy') is-invalid @enderror privacy_policy" id="exampleInputEmail1" placeholder="Enter privacy policy" >{{old('privacy_policy')}}</textarea>
                    <span class="error invalid-feedback" id="error-privacy_policy" style="font-weight: bold;"></span>

                    @error('privacy_policy')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror   						
   					</div>
            <div class="mb-3">
                      <label>Ad Link</label>
                    <input type="url" name="ad_link" class="form-control @error('ad_link') is-invalid @enderror ad_link" id="exampleInputEmail1" placeholder="Enter privacy policy" value="{{ old('ad_link')}}">
                    <span class="error invalid-feedback" id="error-ad_link" style="font-weight: bold;"></span>
                    @error('ad_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror               
            </div> 
            <div class="mb-3">
                      <label>Ad Image</label>
                    <input type="file" name="ad_image" class="form-control @error('ad_image') is-invalid @enderror ad_image" id="exampleInputEmail1" placeholder="Enter privacy policy" value="{{ old('ad_image')}}">
                    <span class="error invalid-feedback" id="error-ad_image" style="font-weight: bold;"></span>
                    @error('ad_image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror               
            </div>                                              			                    

    </div> <!--end::Body--> <!--begin::Footer-->
    <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div> <!--end::Footer-->
</form> <!--end::Form-->
@else
<form class="site_settings_update_form" action="{{route('admin.settings.update')}}" enctype="multipart/form-data" method="POST">
	@csrf
 <!--begin::Body-->
    <div class="card-body">

        <div class="mb-3"> 
        	<label for="exampleInputtitle" class="form-label">Site Title</label> 
        	<input type="text" name="title" value="{{ old('title',$data->title) }}" class="form-control @error('title') is-invalid @enderror title{{$setting->id}}" id="exampleInputtitle" aria-describedby="titlehelp">
          <span class="error invalid-feedback" id="error-title{{$setting->id}}" style="font-weight: bold;"></span>          
          
          @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>

        <div class="mb-3">
         <label for="exampleInputFile">Current Logo</label><br>
         <img src="{{URL::to($data->logo ?? '')}}" style="width: 60px; height: 50px;">
         <input type="hidden" name="old_photo" value="{{$data->logo ?? ''}}">        	
        </div>

        <div class="input-group mb-3">
            <label for="exampleInputtitle" class="form-label">Site Logo</label>  
        	<input name="logo" type="file" class="form-control @error('logo') is-invalid @enderror logo{{$setting->id}}" id="inputGroupFile02"> 
        	<label class="input-group-text" for="inputGroupFile02">Upload</label>
          <span class="error invalid-feedback" id="error-logo{{$setting->id}}" style="font-weight: bold;"></span>
        	
          @error('logo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>

        <div class="mb-3">
          <label>Slider Title</label>
          <input type="text" name="slider_title" value="{{ old('slider_title', $data->slider_title)}}" class="form-control @error('slider_title') is-invalid @enderror slider_title{{$setting->id}}" >
           <span class="error invalid-feedback" id="error-slider_title{{$setting->id}}" style="font-weight: bold;"></span>
          
          @error('slider_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror          
        </div>

        <div class="mb-3">
          <label>Slider Decription</label>
          <textarea name="slider_description" class="form-control @error('slider_description') is-invalid @enderror slider_description{{$setting->id}}" >{{old('slider_description', $data->slider_description)}}</textarea>
          <span class="error invalid-feedback" id="error-slider_description{{$setting->id}}" style="font-weight: bold;"></span>
          
          @error('slider_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror          
        </div>        

        <div class="mb-3">
          <label for="examplephoneno">Phone No</label>
          <input type="tel" name="phone_no" value="{{old('phone_no',$data->phone_no)}}" class="form-control @error('phone_no') is-invalid @enderror phone_no{{$setting->id}}" >
                    <span class="error invalid-feedback" id="error-phone_no{{$setting->id}}" style="font-weight: bold;"></span>                  

          @error('phone_no')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

          </div>

        <div class="mb-3">
          <label for="examplephoneno">Email</label>
          <input type="email" name="email" value="{{ old('email', $data->email)}}" class="form-control @error('email') is-invalid @enderror email{{$setting->id}}" >
          <span class="error invalid-feedback" id="error-email{{$setting->id}}" style="font-weight: bold;"></span>                 

          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

          </div>

          <div class="mb-3">
          <label>Address</label>
          <textarea name="address" class="form-control @error('address') is-invalid @enderror address{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter Address" >{{ old('address', $data->address)}}</textarea>
                    <span class="error invalid-feedback" id="error-address{{$setting->id}}" style="font-weight: bold;"></span>
          
          @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
             </span>
           @enderror          	
          </div>

        <div class="mb-3">
                          <label>Google location Name</label>
                          <input type="text" name="location_name" value="{{old('location_name',$data->location_name)}}" class="form-control @error('location_name') is-invalid @enderror location_name" >
                          <span class="error invalid-feedback" id="error-location_name" style="font-weight: bold;"></span>

                          @error('location_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror          
        </div>

        <div class="mb-3">
          <label>Google location Latitude</label>
          <input type="text" name="latitude" value="{{old('latitude',$data->latitude)}}" class="form-control @error('latitude') is-invalid @enderror latitude" >
          <span class="error invalid-feedback" id="error-latitude" style="font-weight: bold;"></span>

          @error('latitude')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror          
        </div>

        <div class="mb-3">
                  <label>Google location Longitude</label>
                  <input type="text" name="longitude" value="{{old('longitude', $data->longitude)}}" class="form-control @error('longitude') is-invalid @enderror longitude" >
                  <span class="error invalid-feedback" id="error-longitude" style="font-weight: bold;"></span>

                  @error('longitude')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror          
        </div>

          <div class="mb-3"> 
           <label for="exampleInputEmail1">Google Plus link</label>
           <input type="url" name="googleplus_address" class="form-control @error('googleplus_address') is-invalid @enderror googleplus_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter googleplus link" value="{{ old('googleplus_address' ,$data->googleplus_address)}}">
                    <span class="error invalid-feedback" id="error-googleplus_address{{$setting->id}}" style="font-weight: bold;"></span>
           
           @error('googleplus_address')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
          </div>
          <div class="mb-3">
           <label for="exampleInputEmail1">Facebook Address</label>
           <input type="url" name="facebook_address" class="form-control @error('facebook_address') is-invalid @enderror facebook_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter facebook address" value="{{ old('facebook_address',$data->facebook_address)}}">
                    <span class="error invalid-feedback" id="error-facebook_address{{$setting->id}}" style="font-weight: bold;"></span>
          
           @error('facebook_address')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror          	
          </div>
          <div class="mb-3">
                    <label for="exampleInputEmail1">Instagram address</label>
                    <input type="url" name="instagram_address" class="form-control @error('instagram_address') is-invalid @enderror instagram_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter instagram address" value="{{old('instagram_address',$data->instagram_address)}}">
                    <span class="error invalid-feedback" id="error-instagram_address{{$setting->id}}" style="font-weight: bold;"></span>
                   
                    @error('instagram_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>
          <div class="mb-3">
                    <label for="exampleInputEmail1">Linkedin address</label>
                    <input type="url" name="linkedin_address" class="form-control @error('linkedin_address') is-invalid @enderror linkedin_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter linkedin address" value="{{ old('linkedin_address',$data->linkedin_address) }}">
                    <span class="error invalid-feedback" id="error-linkedin_address{{$setting->id}}" style="font-weight: bold;"></span>
                    
                    @error('linkedin_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>          
          <div class="mb-3">
                    <label for="exampleInputEmail1">Twitter address</label>
                    <input type="url" name="twitter_address" class="form-control @error('twitter_address') is-invalid @enderror twitter_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter twitter address" value="{{ old('twitter_address',$data->twitter_address)}}">
                    <span class="error invalid-feedback" id="error-twitter_address{{$setting->id}}" style="font-weight: bold;"></span>
                    
                    @error('twitter_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>

          <div class="mb-3">
                    <label for="exampleInputEmail1">Pinterest address</label>
                    <input type="url" name="pinterest_address" class="form-control @error('pinterest_address') is-invalid @enderror pinterest_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter pinterest address" value="{{ old('pinterest_address',$data->pinterest_address)}}">
                    <span class="error invalid-feedback" id="error-pinterest_address{{$setting->id}}" style="font-weight: bold;"></span>
                    
                    @error('pinterest_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>          
          <div class="mb-3">
                    <label for="exampleInputEmail1">Whatsapp address</label>
                    <input type="url" name="whatsapp_address" class="form-control @error('whatsapp_address') is-invalid @enderror whatsapp_address{{$setting->id}}" id="exampleInputemail1" placeholder="Enter whatsapp address" value="{{ old('whatsapp_address',$data->whatsapp_address)}}">
                    <span class="error invalid-feedback" id="error-whatsapp_address{{$setting->id}}" style="font-weight: bold;"></span>
                    
                    @error('whatsapp_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror          	
          </div>
			<div class="mb-3">
                    <label for="exampleInputEmail1">About us headline</label>
                    <input type="text" name="about_us_headline" value="{{ old('about_us_headline',$data->about_us_headline)}}" class="form-control @error('about_us_headline') is-invalid @enderror about_us_headline{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter about us headline" >                    
                    <span class="error invalid-feedback" id="error-about_us_headline{{$setting->id}}" style="font-weight: bold;"></span>
                    
                    @error('about_us_headline')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror				
			</div>
        <div class="mb-3">
         <label for="exampleInputFile">Current About us image</label><br>
         <img src="{{URL::to($data->about_us_image ?? '')}}" style="width: 60px; height: 50px;">
         <input type="hidden" name="old_about_us_image" value="{{$data->about_us_image ?? ''}}">        	
        </div>			
                  <div class="form-group">
                    <label for="exampleInputFile">About us image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        <input type="file" name="about_us_image" class="custom-file-input @error('about_us_image') is-invalid @enderror about_us_image{{$setting->id}}" id="exampleInputFile">

                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    <span class="error invalid-feedback" id="error-about_us_image{{$setting->id}}" style="font-weight: bold;"></span>
                        @error('about_us_image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1">About us description</label>
                    <textarea name="about_us_description" class="form-control @error('about_us_description') is-invalid @enderror about_us_description{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter about us description" >{{ old('about_us_description',$data->about_us_description)}}</textarea>
                    <span class="error invalid-feedback" id="error-about_us_description{{$setting->id}}" style="font-weight: bold;"></span>
                    @error('about_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                  	
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact us description</label>
                    <textarea name="contact_us_description" class="form-control @error('contact_us_description') is-invalid @enderror contact_us_description{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter contact us" >{{ old('contact_us_description',$data->contact_us_description) }}</textarea>
                    <span class="error invalid-feedback" id="error-contact_us_description{{$setting->id}}" style="font-weight: bold;"></span>
                    @error('contact_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
   					<div class="mb-3">
                       <label>Terms & Conditions</label>
                    <textarea name="terms_conditions" class="form-control @error('terms_conditions') is-invalid @enderror terms_conditions{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter terms & conditions" >{{ old('terms_conditions',$data->terms_conditions)}}</textarea>
                    <span class="error invalid-feedback" id="error-terms_conditions{{$setting->id}}" style="font-weight: bold;"></span>
                    @error('terms_conditions')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror  						
   					</div>
   					<div class="mb-3">
                      <label>Privacy Policy</label>
                    <textarea name="privacy_policy" class="form-control @error('privacy_policy') is-invalid @enderror privacy_policy{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter privacy policy" >{{ old('privacy_policy',$data->privacy_policy)}}</textarea>
                    <span class="error invalid-feedback" id="error-privacy_policy{{$setting->id}}" style="font-weight: bold;"></span>
                    @error('privacy_policy')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror   						
   					</div>
            <div class="mb-3">
                      <label>Ad Link</label>
                    <input type="url" name="ad_link" class="form-control @error('ad_link') is-invalid @enderror ad_link{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter privacy policy" value="{{ old('ad_link',$data->ad_link)}}">
                    <span class="error invalid-feedback" id="error-ad_link{{$setting->id}}" style="font-weight: bold;"></span>
                    @error('ad_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror               
            </div> 
        <div class="mb-3">
         <label for="exampleInputFile">Current Ad image</label><br>
         <img src="{{URL::to($data->ad_image ?? '')}}" style="width: 60px; height: 50px;">
       
        </div>            
            <div class="mb-3">
                      <label>Ad Image</label>
                    <input type="file" name="ad_image" class="form-control @error('ad_image') is-invalid @enderror ad_image{{$setting->id}}" id="exampleInputEmail1" placeholder="Enter privacy policy" value="{{ old('ad_image',$data->ad_image)}}">
                    <span class="error invalid-feedback" id="error-ad_image{{$setting->id}}" style="font-weight: bold;"></span>
                    @error('ad_image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror               
            </div>                                  			                    

    </div> <!--end::Body--> <!--begin::Footer-->
    <div class="card-footer"> <button type="submit" class="btn btn-primary" data-id="{{$setting->id}}">Submit</button> </div> <!--end::Footer-->
</form> <!--end::Form-->
@endif
@endsection