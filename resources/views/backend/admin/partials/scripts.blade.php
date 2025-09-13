<!-- jQuery -->
<script src="{{asset('public/backend/admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/backend/admin_assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend/admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('public/backend/admin_assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('public/backend/admin_assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('public/backend/admin_assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('public/backend/admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/backend/admin_assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('public/backend/admin_assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('public/backend/admin_assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/backend/admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('public/backend/admin_assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend/admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/admin_assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backend/admin_assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backend/admin_assets/dist/js/pages/dashboard.js')}}"></script>


<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--project,floor,unit-store-validation-query-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '.myagentForm, .myslidersform, .site_settings_form, .mystateForm, .mycityForm, .myareaForm, .myprojectForm, .myfloorForm, .myunitForm , .myblogForm', function(e) {
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
                if(response.success) {
                    // Only submit the form if the response is successful
                    form.submit();
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


<!--project,unit-update-validation-query-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '.site_settings_update_form, .myprojectupdateForm, .myupdatefloorForm, .myunitupdateform', function(e) {
        e.preventDefault();

        let dataId = $(document.activeElement).data('id');

        let form = this;
        $('.error' + dataId).text(''); // Clear previous error messages
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
                if(response.success) {
                    // Only submit the form if the response is successful
                    form.submit();
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
                        $('#error-' + key + dataId).text(value[0]);

                        // Add the 'is-invalid' class to the input field
                        $('.'+key+dataId).addClass('is-invalid');

                    });
                }
            }
        });
    });
</script>
<!--Sweetalert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>

<!--delete-sweetalert-->
<script>
$(document).on("click", "#delete", function(e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        } else {
            Swal.fire("Cancelled", "Your data is safe :)", "error");
        }
    });
});
</script>
@if(Session::has('success'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ Session::get('success') }}",
            icon: "success"
        });
    </script>
    @endif
@if(Session::has('error'))
    <script>
        Swal.fire({
            title: "Error!",
            text: "{{ Session::get('error') }}",
            icon: "error"
        });
    </script>
    @endif
@if(Session::has('warning'))
    <script>
        Swal.fire({
            title: "Warning!",
            text: "{{ Session::get('warning') }}",
            icon: "warning"
        });
    </script>
@endif

<!--City Finder -->
<script type="text/javascript">
    // Setup for CSRF Token (optional for GET, but included if needed for security)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(document).on('change', '.state', function() {
            var state_id = $(this).val();

            if (state_id) {
                $.ajax({
                    url: "{{ url('admin/project/city/find/') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        //console.log('okay');
                        //console.log(response); // If you want to see the full response
                      $('.cities').html(response.cities_html);
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error:", error);
                    }
                }); // ✅ Properly closed here
            } else {
                $('.cities').html('<option value="">Please select a city</option>');
                $('.areas').html('<option value="">Please select an area</option>');
                console.log('No state selected');
            }
        });
    });
</script>
<!--Area Finder -->
<script type="text/javascript">
    // Setup for CSRF Token (optional for GET, but included if needed for security)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(document).on('change', '.cities', function() {
            var city_id = $(this).val();

            if (city_id) {
                $.ajax({
                    url: "{{ url('admin/project/area/find/') }}/" + city_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        //console.log('okay');
                        //console.log(response); // If you want to see the full response
                      $('.areas').html(response.areas_html);
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error:", error);
                    }
                }); // ✅ Properly closed here
            } else {
                $('.areas').html('<option value="">Please select an area</option>');
                console.log('No city selected');
            }
        });
    });
</script>
<!--Floor finder-->
<script type="text/javascript">
     // Setup for CSRF Token (optional for GET, but included if needed for security)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(document).on('change', '.projects', function() {
            var project_id = $(this).val();

            if (project_id) {
                $.ajax({
                    url: "{{ url('admin/floor/find/') }}/" + project_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        //console.log('okay');
                        //console.log(response); // If you want to see the full response
                      $('.floors').html(response.floors_html);

                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error:", error);
                    }
                }); // ✅ Properly closed here
            } else {
                $('.floors').html('<option value="">Please select a floor</option>');
                console.log('No project selected');
            }
        });
    });

    //Area finder
    $(document).ready(function(){
        $(document).on('change', '.floors', function(){
            var floor_id = $(this).val();

            if(floor_id){
                $.ajax({
                    url: "{{ url('admin/maxarea/find/')}}/" + floor_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {

                      $('.area_sqft').attr('disabled',false);
                      $('.area_sqft').attr('max',response.maxarea);  
                      $('.area_sqft').attr('min',response.minarea);  
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error:", error);
                    }
                });
            } else {
                    $('.area_sqft').attr('disabled',true);
                    $('.area_sqft').attr('max',''); 
                    $('.area_sqft').attr('min',''); 
                    console.log('no floor selected');  
            }
        });
    });   
</script>
<!--Project floor limiter-->
<script type="text/javascript">
         // Setup for CSRF Token (optional for GET, but included if needed for security)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        $(document).on('change','.project_select',function(){
            var project_select_id = $(this).val();

            if(project_select_id){

                $.ajax({
                    url: "{{ url('admin/project/maxfloor/find/') }}/" + project_select_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('.floormax').attr('max',response.project.floors);
                        $('.unitmax').attr('max',response.project.units);
                    },
                    error: function(xhr, status, error){
                        console.log("AJAX error:", error);
                    }
                });

            } else{
                console.log('no project selected')
            }            
        });


    });
</script>
<!--message-status-->
<script type="text/javascript">
    $(document).on('change','.messagestatus',function(){
        let status = $(this).val();
        let message_id = $(this).data('id');

        if(status){
                $.ajax({
                    url: "{{ url('admin/message/status/update/') }}/" + message_id,
                    data: {status:status},
                    success: function(response) {
                        console.log('success');
                    },
                    error: function(xhr, status, error){
                        console.log("AJAX error:", error);
                    }
                });

        }
        else{

            console.log('nothing selected');
        }
    });
</script>