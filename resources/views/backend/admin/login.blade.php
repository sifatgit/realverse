<!doctype html>
<html lang="en">
  <head>
  	<title>Realverse | Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('backend/admin_login_assets/css/style.css')}}">
        <!-- Site Icons -->
        <link rel="shortcut icon" href="{{asset('frontend/assets/img/Realverse_main_logo.png')}}" type="image/x-icon" sizes="180x180">
        <link rel="apple-touch-icon" href="{{asset('frontend/assets/img/Realverse_main_logo.png')}}">  
	</head>
	<body class="img js-fullheight" style="background-image: url(<?php echo asset('backend/admin_login_assets/images/istockphoto-1295808919-612x612.jpg'); ?>);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"><img src="{{asset('backend/admin_login_assets/images/1834348036766227.png')}}"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Admin login</h3>
		      	<form class="myadminloginForm" action="{{route('admin.login')}}" class="signin-form" method="POST">
		      		@csrf
		      		<div class="form-group">
		      			<input type="email" class="form-control email" placeholder="email" name="email" >
		      			<span class="error invalid-feedback bg-white" id="error-email" style="font-weight: bold;"></span>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control password" placeholder="Password" name="password" >
	              <span class="error invalid-feedback bg-white" id="error-password" style="font-weight: bold;"></span>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Log In</button>
	            </div>
	          
	          </form>
	          
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('backend/admin_login_assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('backend/admin_login_assets/js/popper.js')}}"></script>
  <script src="{{asset('backend/admin_login_assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('backend/admin_login_assets/js/main.js')}}"></script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '.myadminloginForm', function(e) {
        e.preventDefault();

        let form = this;
        $('.error').text(''); // Clear previous error messages
        $('.is-invalid').removeClass('is-invalid'); // Remove any existing 'is-invalid' classes

        // Create FormData object to handle both text and file data
        let formData = new FormData(form);

        $.ajax({
            url: form.action,
            method: form.method,
            data: formData,
            processData: false, // Don't let jQuery try to process the form data
            contentType: false, // Let FormData handle content-type (multipart/form-data)
            success: function(response) {
                if(response.redirect) {
                    // Only submit the form if the response is successful
                    window.location.href=response.redirect;
                } else {
                    // Handle error: display error messages
                    alert("There was an issue with form submission.");
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // Dynamically update error messages
                        $('#error-' + key).text(value[0]);

                        // Add the 'is-invalid' class to the input field
                        $('.' + key + '').addClass('is-invalid');

                    });
                }
            }
        });
    });
</script>

	</body>
</html>

