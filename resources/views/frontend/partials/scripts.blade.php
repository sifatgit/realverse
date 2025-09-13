        <script src="{{asset('public/frontend/assets/js/modernizr-2.6.2.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/jquery-1.10.2.min.js')}}"></script>

        <script src="{{asset('public/frontend/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/bootstrap-hover-dropdown.js')}}"></script>

        <script src="{{asset('public/frontend/assets/js/easypiechart.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/jquery.easypiechart.min.js')}}"></script>

        <script src="{{asset('public/frontend/assets/js/owl.carousel.min.js')}}"></script> 


        <script src="{{asset('public/frontend/assets/js/wow.js')}}"></script>

        <script src="{{asset('public/frontend/assets/js/icheck.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/price-range.js')}}"></script>
        <script src="{{ asset('public/frontend/assets/js/lightslider.min.js') }}"></script>
        <script src="{{asset('public/frontend/assets/js/main.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/frontend/assets/js/jquery.validate.min.js')}}"></script>
        <script src="{{ asset('public/frontend/assets/js/wizard.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script src="{{asset('public/frontend/assets/js/gmaps.js')}}"></script>        
        <script src="{{asset('public/frontend/assets/js/gmaps.init.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @if(isset($properties) && $customers && $branches && $cities)
        <script type="text/javascript">
            let properties ={{ count($properties)}};
            let users = {{count($customers)}};
            let branches = {{$branches}};
            let cities = {{count($cities)}};
        </script>
        @else
        <script type="text/javascript">
            let properties = 5000;
            let users = 1008;
            let branches = 108;
            let cities = 25;
        </script>        
        @endif
        @if($setting &&  $setting->latitude && $setting->longitude)
        <script>
        const locationData = {
            lat: {{ $setting->latitude }},
            lng: {{ $setting->longitude }},
            name: "{{ $setting->location_name }}"
        };
        </script>
        @endif


        <script>
            

                $('#image-gallery').lightSlider({
                    gallery: true,
                    item: 1,
                    thumbItem: 9,
                    slideMargin: 0,
                    speed: 500,
                    auto: true,
                    loop: true,
                    onSliderLoad: function () {
                        $('#image-gallery').removeClass('cS-hidden');
                    }
                });
            
        </script>        
<!--live pagination using jquery-->
<script>
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');
    fetchPaginationData(url);
});

function fetchPaginationData(url) {
    $.ajax({
        url: url,
        success: function (response) {
            // Replace the content with the new data
            $('#list-type').html(response.units_html);
            
            //if(response.price_pagination_links){
            //    $('#pagination_links_price').html(response.price_pagination_links);
            //}
            if(response.units_pagination_links){
                $('#pagination_links').html(response.units_pagination_links);
            }
            
            const urlParams = new URLSearchParams(url.split('?')[1]);
            const currentPage = urlParams.get('page') || 1; // default to 1 if not present

            // Set the current page in hidden input
            $('#currentPage').val(currentPage);            
            //let productIds = JSON.stringify(response.product_ids);
           // $('#sortForm input[name="products"]').val(productIds);
           //         // Set the value to 'nothing'
           // $('#sortOption').val('nothing').selectpicker('refresh').trigger('change');           
        },
        error: function () {
            alert('Error fetching data');
            
        }
    });
}

function fetchorderbyPaginationData(url) {
    $.ajax({
        url: url,
        success: function (response) {
            // Replace the content with the new data
            $('#list-type').html(response.units_html);
            
            //if(response.price_pagination_links){
            //    $('#pagination_links_price').html(response.price_pagination_links);
            //}
            if(response.units_pagination_links){
                $('#pagination_links').html(response.units_pagination_links);
            }

            const urlParams = new URLSearchParams(url.split('?')[1]);
            const currentPage = urlParams.get('page') || 1; // default to 1 if not present

            $('#currentPage').val(currentPage); 

            if(response.order_by === 'created_at'){
                let $sortBtn = $('.order_by_date');
                let currentOrder = $sortBtn.attr('data-current-order');
                let nextOrder = currentOrder === 'asc' ? 'desc' : 'asc';

                $sortBtn.attr('data-current-order', nextOrder); // Update attribute
                $sortBtn.attr('data-order', nextOrder === 'desc' ? 'asc' : 'desc'); // Update attribute
                $sortBtn.find('i').removeClass('fa-sort-amount-asc fa-sort-amount-desc')
                    .addClass(nextOrder === 'asc' ? 'fa-sort-amount-asc' : 'fa-sort-amount-desc');

            }
            if(response.order_by === 'price'){
                let $sortBtn = $('.order_by_price');
                let currentOrder = $sortBtn.attr('data-current-order');
                let nextOrder = currentOrder === 'asc' ? 'desc' : 'asc';

                $sortBtn.attr('data-current-order', nextOrder); // Update attribute
                $sortBtn.attr('data-order', nextOrder === 'desc' ? 'asc' : 'desc'); // Update attribute
                $sortBtn.find('i').removeClass('fa-sort-numeric-asc fa-sort-numeric-desc')
                    .addClass(nextOrder === 'asc' ? 'fa-sort-numeric-asc' : 'fa-sort-numeric-desc');                
            }
            // Toggle the sort order on the button

            
            
            //let productIds = JSON.stringify(response.product_ids);
           // $('#sortForm input[name="products"]').val(productIds);
           //         // Set the value to 'nothing'
           // $('#sortOption').val('nothing').selectpicker('refresh').trigger('change');           
        },
        error: function () {
            alert('Error fetching data');
        }
    });
}
function fetchsuborderbyPaginationData(url) {
    $.ajax({
        url: url,
        success: function (response) {
            // Replace the content with the new data
            $('#list-type').html(response.units_html);
            
            //if(response.price_pagination_links){
            //    $('#pagination_links_price').html(response.price_pagination_links);
            //}
            if(response.units_pagination_links){
                $('#pagination_links').html(response.units_pagination_links);
            }

            const urlParams = new URLSearchParams(url.split('?')[1]);
            const currentPage = urlParams.get('page') || 1; // default to 1 if not present

            $('#currentPage').val(currentPage); 

            if(response.order_by === 'created_at'){
                let $sortBtn = $('.sub_order_by_date');
                let currentOrder = $sortBtn.attr('data-current-order');
                let nextOrder = currentOrder === 'asc' ? 'desc' : 'asc';

                $sortBtn.attr('data-current-order', nextOrder); // Update attribute
                $sortBtn.attr('data-order', nextOrder === 'desc' ? 'asc' : 'desc'); // Update attribute
                $sortBtn.find('i').removeClass('fa-sort-amount-asc fa-sort-amount-desc')
                    .addClass(nextOrder === 'asc' ? 'fa-sort-amount-asc' : 'fa-sort-amount-desc');

            }
            if(response.order_by === 'price'){
                let $sortBtn = $('.sub_order_by_price');
                let currentOrder = $sortBtn.attr('data-current-order');
                let nextOrder = currentOrder === 'asc' ? 'desc' : 'asc';

                $sortBtn.attr('data-current-order', nextOrder); // Update attribute
                $sortBtn.attr('data-order', nextOrder === 'desc' ? 'asc' : 'desc'); // Update attribute
                $sortBtn.find('i').removeClass('fa-sort-numeric-asc fa-sort-numeric-desc')
                    .addClass(nextOrder === 'asc' ? 'fa-sort-numeric-asc' : 'fa-sort-numeric-desc');                
            }
            // Toggle the sort order on the button

            
            
            //let productIds = JSON.stringify(response.product_ids);
           // $('#sortForm input[name="products"]').val(productIds);
           //         // Set the value to 'nothing'
           // $('#sortOption').val('nothing').selectpicker('refresh').trigger('change');           
        },
        error: function () {
            alert('Error fetching data');
        }
    });
}


</script>
<script>

    //pricerange slider
    // Initialize the slider
    $('#price-range , #property-geo , #min-baths , #min-bed').slider();

    // On slide, capture and update values in real time
    $('#price-range , #property-geo , #min-baths , #min-bed').on('slide', function (event) {
        const min = event.value[0];
        const max = event.value[1];

        // Update the input's JS value and attribute
        $(this)
            .val([min, max])
            .attr('value', `[${min},${max}]`);
        $(this).attr('data-slider-value',`[${min},${max}]`);

        // Update the visible text output
        //$('#price-output').text(`${min.toLocaleString()} - ${max.toLocaleString()}`);

        // Optional: force update the tooltip (if needed)
        $(this).closest('.sliderrange').find('.tooltip-inner')
            .text(`${min.toLocaleString()} : ${max.toLocaleString()}`);
    });

    // Optional: also do it on slideStop for extra safety
    $('#price-range , #property-geo , #min-baths , #min-bed').on('slideStop', function (event) {
        const min = event.value[0];
        const max = event.value[1];

        $(this)
            .val([min, max])
            .attr('value', `[${min},${max}]`);
        $(this).attr('data-slider-value',`[${min},${max}]`);    

        //$('#price-output').text(`${min.toLocaleString()} - ${max.toLocaleString()}`);
        $(this).closest('.sliderrange').find('.tooltip-inner')
            .text(`${min.toLocaleString()} : ${max.toLocaleString()}`);
    });
    //pricerange slider end




</script>





<!--smart-search-query-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(document).on('submit', '.smart_search', function (e) {
    e.preventDefault();

    // Get slider values
    let priceRange = $('#price-range').data('slider').getValue();  // If you're using Bootstrap Slider // This is an array, e.g., [1, 20]
    let propertyGeo = $('#property-geo').data('slider').getValue();  // This is also an array, e.g., [1, 2000]
    let minBaths = $('#min-baths').data('slider').getValue();  // This is a single value
    let minBed = $('#min-bed').data('slider').getValue();  // This is a single value

    // Prepare AJAX form data
    var formData = {
        name: $("input[name='name']").val(),
        city_id: $("select[name='city_id']").val(),
        status: $("select[name='status']").val(),
        price: priceRange,       // Directly use the array for price
        area_sqft: propertyGeo,  // Directly use the array for area_sqft
        bathrooms: minBaths,                     // Single value for bathrooms
        bedrooms: minBed,                        // Single value for bedrooms
        features: $("input[name='features[]']:checked").map(function () {
            return this.value;
        }).get(),  // Collect checked features
        per_page: $('#items_per_page').val(),
        _token: $("input[name='_token']").val()  // CSRF token
    };

    $.ajax({
        url: '{{ route("units.smart-search") }}',
        method: 'GET',
        data: formData,
        success: function (response) {
            //console.log(response.allrequest);
            //console.log('Price Range:', priceRange);
            if(response.units.data.length > 0){
                console.log('success');
                $('#list-type').html(response.units_html);
                $('#pagination_links').html(response.units_pagination_links);
                let unitIds = response.actual_units.map(unit => unit.id).join('|');
                $('#unitIds').val(unitIds);
                $('.order_by_date , .order_by_price').removeClass('disabled');
            }
            else{

                console.log('no properties found');
                $('#list-type').html('<h2 class="text-danger">No apartments found</h2>');
                $('#pagination_links').empty();
                $('#unitIds').empty();
                $('.order_by_date , .order_by_price').addClass('disabled');
            }
        },
        error: function (xhr) {
            console.log('Error:', xhr);
        }
    });
});



</script>
<!--orderby_filter_units-->
<script type="text/javascript">
    $(document).on('click', '.order_by_date , .order_by_price ', function (e) {
    e.preventDefault();

    let order = $(this).attr('data-order'); // asc or desc
    let orderby = $(this).data('orderby'); // column name (e.g. created_at)

    let url = '{{ route("units.orderby") }}';
    let separator = url.includes('?') ? '&' : '?';
    let unitIds = $('#unitIds').attr('value');
    let items = $('#items_per_page').val();
    url += separator + 'orderby=' + orderby + '&order=' + order + '&unitIds=' + unitIds + '&items=' + items;

    fetchorderbyPaginationData(url);
});
    $(document).on('click', '.sub_order_by_date , .sub_order_by_price ', function (e) {
    e.preventDefault();

    let order = $(this).attr('data-order'); // asc or desc
    let orderby = $(this).data('orderby'); // column name (e.g. created_at)

    let url = '{{ route("user.units") }}';
    let separator = url.includes('?') ? '&' : '?';
    let unitIds = $('#unitIds').attr('value');
    let items = $('.items_per_page').val();
    url += separator + 'orderby=' + orderby + '&order=' + order + '&unitIds=' + unitIds + '&items=' + items;

    fetchsuborderbyPaginationData(url);
});

</script>
<!--units-per-page-->
<script type="text/javascript">
    
        $(document).on('change' ,'#items_per_page' , function(e){
            e.preventDefault();

            let items = $(this).val();
            let current_page = $('#currentPage').val();
            let unitIds = $('#unitIds').val();

            $.ajax({
                url: '{{ url("/units/per-page")}}?items='+ items + '&page=' + current_page + '&unitIds=' + unitIds ,
                method: 'GET',
                success: function(response){
                    console.log('success');
                    if(response.units.data.length > 0){
                        $('#list-type').html(response.units_html);
                    }
                    if(response.units_pagination_links !== null){
                        $('#pagination_links').html(response.units_pagination_links);
                    }
                    else{
                        $('#pagination_links').empty();
                    }
                    if (response.corrected_page) {
                        $('#currentPage').val(response.corrected_page);
                    }                    
                },
                error: function(xhr){
                    console.log('Errors:', xhr);
                }
            })

        });
$(document).on('change', '.items_per_page', function(e){
    e.preventDefault();

    let items = $(this).val();
    let current_page = $('#currentPage').val();
    let unitIds = $('#unitIds').val();

    $.ajax({
        url: '{{ url("/myunits/per-page")}}?items=' + items + '&page=' + current_page + '&unitIds=' + unitIds,
        method: 'GET',
        success: function(response){
            if(response.units.data.length > 0){
                $('#list-type').html(response.units_html);
            }
            if(response.units_pagination_links){
                $('#pagination_links').html(response.units_pagination_links);
            }
            else{
                $('#pagination_links').empty();
            }            
            // ✅ Update current page input to corrected one
            if (response.corrected_page) {
                $('#currentPage').val(response.corrected_page);
            }
        },
        error: function(xhr){
            console.log('Errors:', xhr);
        }
    });
});
        
   
</script>
<!--project,floor,unit-store-validation-query-->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '.myregisterform , .myloginform , .myprofileupdateform, .mypasswordupdateform, .mycommentform, .mymessageform, .mysubscribeform ', function(e) {
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
                    //console.log('success');
                } 
                if(response.redirect){
                    if (response.message) {
                        sessionStorage.setItem('flash_message', response.message);
                    }                    
                    window.location.href = response.redirect;



                }
                if(response.comment_html){

                    $('#comments').prepend(response.comment_html);
                    $('.mycommentform')[0].reset();
                    $('#comments_counter').html('<i class="fa fa-comment-o"></i> ' + response.comments_counter + ' comments');
                    $('#comment_counter').remove();
                    $('#comments').prepend('<h4 id="comment_counter" class="text-uppercase wow fadeInLeft animated">'+response.comments_counter +' comments</h4>');
                    
                }
                if(response.message){

                    $('.mymessageform').remove();
                    $('#json_message').addClass('text-success');
                    $('#json_message').text(response.message);
                }
                if(response.warning){
                    $('#json_message').addClass('text-warning');
                    $('#json_message').text(response.warning);
                    
                }

                if(response.status == 'success'){

                toastr.success('Thanks for subscribing!');    
                }
                if(response.status == 'warning'){

                toastr.warning('You are already subscribed!');
                }
                if(response.status == 'password'){

                    swal('Password updated successfully, Please login!');
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
<!--City Finder -->
<script type="text/javascript">
    // Setup for CSRF Token (optional for GET, but included if needed for security)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(document).on('change','#states',function(){

    var state_id = $(this).val();

            if (state_id) {
                $.ajax({
                    url: "{{ url('city/find/') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        //console.log('okay');
                        //console.log(response); // If you want to see the full response
                      $('#cities').html(response.cities_html).selectpicker('refresh');
                      //console.log('After update:', $('#cities').html());
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error:", error);
                    }
                }); // ✅ Properly closed here
            } else {
                $('#cities').html('<option value="">Please select a city</option>').selectpicker('refresh');
                $('#areas').html('<option value="">Please select an area</option>').selectpicker('refresh');
                console.log('No state selected');
            }

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


        $(document).on('change', '#cities', function() {
            var city_id = $(this).val();

            if (city_id) {
                $.ajax({
                    url: "{{ url('area/find/') }}/" + city_id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        //console.log('okay');
                        //console.log(response); // If you want to see the full response
                      $('#areas').html(response.areas_html).selectpicker('refresh');
                        console.log($('#areas').html());
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error:", error);
                    }
                }); // ✅ Properly closed here
            } else {
                $('#areas').html('<option value="">Please select a city first</option>').selectpicker('refresh');
                console.log('No city selected');
            }
        });

</script>
<!--delete-user-unit-->
<script type="text/javascript">
    $(document).on('click','.delete_user_car',function(e){
        e.preventDefault();

        let url = $(this).attr('href');
        var unit_id = $(this).data('id');
        let items = $('.items_per_page').val();
        let page = $('#currentPage').val();

        if(unit_id){
            $.ajax({
                url: url,
                type: 'GET',
                data:{items:items,page:page},
                success: function(response){
                    $('#list-type').html(response.units_html);
                    $('#pagination_links').html(response.units_pagination_links);
                    $('#currentPage').val(response.corrected_page);
                    
                    toastr.success('Your property deleted successfully!');                    
                    console.log('success');

                    
                    $('#' + unit_id).remove();
                },
                error: function(xhr, status, error){
                    console.log("AJAX error:", error);
                }

            });
        }
        else{

            console.log('nothing to delete');
        }
    });
</script>
<!--load-more-comments--->
<script type="text/javascript">

    $(document).on('click','#load_more',function(){
        $('#load_more').text('loading...');

        let blog_id = $('.blog_id').val();
        let last_comment_id = $(this).data('id');

        $.ajax({
            url: "{{route('load.comments')}}",
            type: "GET",
            data: {blog_id:blog_id,last_comment_id:last_comment_id},
            success:function(response){

                if(response.last_comment_id == null){
                    $('#load_more').text('No more comments').prop('disabled',true).addClass('text-info');
                }
                else{
                    $('#comments').append(response.comments_html);
                    $('#load_more').data('id',response.last_comment_id);
                    $('#load_more').text('load more comments');
                }

            }
        });

    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const flashMessage = sessionStorage.getItem('flash_message');
if (flashMessage && window.location.href.includes("/login")) {
        swal("Success", flashMessage, "success");
        sessionStorage.removeItem('flash_message'); // Clear it after showing
    }
});
</script>
@if (session('login_throttle'))
    <div class="alert alert-warning">
        {{ session('login_throttle') }}
    </div>
@endif

<script>


    let termsChecked = false;
    let termsClickCount = 0;


$('a[href="#step3"]').on('shown.bs.tab', function () {

    $('#photo-error').remove(); // Remove previous errors if any
});

    $('#property-images').on('change', function () {
        if (this.files.length > 0) {
            $('#photo-error').remove(); // Remove error message if present
        }
    });

    // STEP 4
    $('a[href="#step4"]').on('shown.bs.tab', function () {
        termsChecked = false;
        termsClickCount = 0;
        var isChecked = $('#checkbox').prop('checked'); // true or false

        $('#checkbox').prop('checked', false);
        $('#terms-error').hide();
        $('#finish-step').addClass('inactive').addClass('finish-button');

        $('#checkbox').on('ifChecked', function () {
            
                termsChecked = true;
                $('#finish-step').removeClass('inactive');
                $('#terms-error').hide();
        });

        $('#checkbox').on('ifUnchecked' , function(){

                termsChecked = false;
                $('#finish-step').addClass('inactive');
        });

        if(isChecked){
            termsChecked = true;
            $('#finish-step').removeClass('inactive');
            
        }        
   
        
    });

    $(document).on('click', '.finish-button', function (e) {
        if (!termsChecked) {
            termsClickCount++;
            if (termsClickCount > 0) {
                $('#terms-error').show();
            }
            e.preventDefault();
        }


    });

    // Reset on going back
    $('#prev-step').on('click', function () {
        $('#terms-error').hide();


        $('#finish-step').addClass('inactive').removeClass('finish-button');
        $('#next-step').removeClass('inactive');
    });



</script>

@if(Auth::check())
<script type="text/javascript">
$(document).on('click', '#rate', function(e){
    e.preventDefault();

    let url = $(this).attr('href');

    $.ajax({
        url : url,
        success: function(response){
            if(response.success){
                toastr.success('Thank you for rating this property!');
                $('#rate').css('color', '#83CFE5');
                $('#rate').css('border', '2px solid #83CFE5');
                $('#rate').find('i.fa-star-o').css('color', '#83CFE5');
            } else {
                $('#rate').css('color', '#fff');
                $('#rate').css('border', '2px solid #fff');
                $('#rate').find('i.fa-star-o').css('color', '#fff');                
            }
        },
        error: function(xhr, status, error){
            console.log("AJAX error:", error);
            toastr.error('Something went wrong!');
        }
    });
});

</script>
@else
<script type="text/javascript">
$(document).on('click', '#rate', function(e){
    e.preventDefault();


    toastr.warning('Please log in first!');
});

</script>
@endif



