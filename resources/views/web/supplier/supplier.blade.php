@extends('web.layout')
@section('content')
		@if(!empty($result['vendor_map_record']))
		<?php
		$get_vendor_banner = DB::table('image_categories')->select('image_id','path')->where('image_id', $result['vendor_map_record']->vendor_banner_image )->first();
		?>
		<section id="page-title" class="page-title-parallax page-title-dark" style="background-image: url({{asset($get_vendor_banner->path) }}); background-size: cover; padding: 75px 0;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">
		@else
		<section id="page-title" class="page-title-parallax page-title-dark" style="background-image: url('http://localhost/rf/public/images/supplier/banner/8.jpg'); background-size: cover; padding: 75px 0;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">
		@endif
		
      <div class="container clearfix">
        <ul class="clients-grid grid-2 grid-sm-3 grid-md-6 grid-lg-8 mb-0">
		@if(!empty($result['vendor_map_record']))
		<?php
		$get_vendor_logo = DB::table('image_categories')->select('image_id','path')->where('image_id', $result['vendor_map_record']->vendor_logo)->first();
		?>
          <li class="grid-item" style="background: white;"><a href="#"><img src="{{asset( $get_vendor_logo->path )}}" alt="Clients"></a></li>
        @else
		  <li class="grid-item" style="background: white;"><a href="#"><img src="{{asset('public/images/supplier/1.png')}}" alt="Clients"></a></li>
		@endif  
        </ul>
        <div class="text-center">
		@if(!empty($result['get_user_information_from_users']))
          <h1>{{ $result['get_user_information_from_users']->first_name }} {{ $result['get_user_information_from_users']->last_name }}</h1>
          <span></span>
		@else
		    <h1>ABC Supplier Est.</h1>
          <span>An Naeem, Jeddah. Saudi Arabia</span>
		@endif
        </div>
        
        
      </div>

    </section><!-- #page-title end -->

		


<section id="content">
      <div class="content-wrap">
        <div class="container clearfix">

 


          <div class="row gutter-40 col-mb-80">
            <!-- Post Content
            ============================================= -->
            <div class="postcontent col-lg-9 order-lg-last">
            <div class="top-bar">
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
              
            </div> 
            <div class="col-12 col-lg-6">
              

              <form class="form-inline justify-content-end" id="load_products_form">
                <input type="hidden" value="1" name="page_number" id="page_number">
                @if(!empty(app('request')->input('search')))
                 <input type="hidden"  name="search" value="{{ app('request')->input('search') }}">
                @endif
                @if(!empty(app('request')->input('category')))
                 <input type="hidden"  name="category" value="@if(app('request')->input('category')!='all'){{ app('request')->input('category') }} @endif">
                @endif
                 <input type="hidden"  name="load_products" value="1">

                 <input type="hidden"  name="products_style" id="products_style" value="grid">

                
                <div class="form-group">
                    <label>@lang('website.Sort')</label>
                    <div class="select-control">
                    <select name="type" id="sortbytype" class="form-control">
                      <option value="desc" @if(app('request')->input('type')=='desc') selected @endif>@lang('website.Newest')</option>
                      <option value="atoz" @if(app('request')->input('type')=='atoz') selected @endif>@lang('website.A - Z')</option>
                      <option value="ztoa" @if(app('request')->input('type')=='ztoa') selected @endif>@lang('website.Z - A')</option>
                      <option value="hightolow" @if(app('request')->input('type')=='hightolow') selected @endif>@lang('website.Price: High To Low')</option>
                      <option value="lowtohigh" @if(app('request')->input('type')=='lowtohigh') selected @endif>@lang('website.Price: Low To High')</option>
                      <option value="topseller" @if(app('request')->input('type')=='topseller') selected @endif>@lang('website.Top Seller')</option>
                      <option value="special" @if(app('request')->input('type')=='special') selected @endif>@lang('website.Special Products')</option>
                      <option value="mostliked" @if(app('request')->input('type')=='mostliked') selected @endif>@lang('website.Most Liked')</option>
                    </select>
                    </div>
                  </div>


                  
                  <div class="form-group">
                    <label>@lang('website.Limit')</label>
                    <div class="select-control">
                      <select class="form-control"name="limit"id="sortbylimit">
                        <option value="15" @if(app('request')->input('limit')=='15') selected @endif>15</option>
                        <option value="30" @if(app('request')->input('limit')=='30') selected @endif>30</option>
                        <option value="60" @if(app('request')->input('limit')=='60') selected @endif>60</option>
                      </select>
                      </div>
                    </div>

                      @include('web.common.scripts.shop_page_load_products')
                  </div>
        </div>
      
    </div>
</div>
</div>

              <!-- Shop
              ============================================= -->
              <div id="shop" class="shop row grid-container gutter-20" data-layout="fitRows">




           
                @include('web.supplier.supplier_product')

                

                

              </div><!-- #shop end -->

            </div><!-- .postcontent end -->

            <!-- Sidebar
            ============================================= -->
            <div class="sidebar col-lg-3">
            <form id="formName" action="" method="get">
           
              <div class="sidebar-widgets-wrap">

                @if(!empty($result['vendor_categories']))
                <div class="widget widget-filter-links">

                  <h4>Select Category</h4>
                  <ul class="custom-filter pl-2" data-container="#shop" data-active-class="active-filter">
                    
                    <!-- <input type="hidden" name="_token" value="{{ Session::token() }}"> -->

                    @foreach($result['vendor_categories']  as $key => $cat)
                    
                    <li class="">
                      <a href="{{ url('/',$cat->categories_slug) }}">
                      {{$cat->categories_name}}
                      </a>
                      <input type="checkbox"  class="category_slug" name="category_slug[]" value="{{ $cat->categories_slug }}" {{request('category_slug')? (in_array($cat->categories_slug , request('category_slug'))? 'checked' : '') : ''}}  onChange="this.form.submit()">
                    </li>
                    @endforeach
                  </ul>

                </div>
                @endif

                <!-- <div class="widget widget-filter-links">

                  <h4>Sort By</h4>
                  <ul class="shop-sorting pl-2">
                    <li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a></li>
                    <li><a href="#" data-sort-by="name">Name</a></li>
                    <li><a href="#" data-sort-by="price_lh">Price: Low to High</a></li>
                    <li><a href="#" data-sort-by="price_hl">Price: High to Low</a></li>
                  </ul>

                </div> -->
                
                    <div class="widget widget-filter-links">
					
					  @if(!empty($result['vendor_name_detail']))
						  <h4>{{ $result['vendor_name_detail']->entry_firstname }}</h4>
						  <p>{{ $result['vendor_name_detail']->entry_street_address }}</p>
						  
						  <!-- vendor map address -->
						<input type="hidden" name="address" id="address-input" value="{{ $result['vendor_map_record']->location }}"  class="required form-control map-input" />
							<input type="hidden" name="address_latitude" id="address-latitude" value="{{ $result['vendor_map_record']->latitude }}" />
							<input type="hidden" name="address_longitude" id="address-longitude" value="{{ $result['vendor_map_record']->longitude }}" />
							<div id="address-map-container" style="width:100%;height:400px; "/>
						<div style="width: 100%; height: 100%" id="address-map"></div>
					
					  @endif
			
					  
					    
																		

                    </div>



              </div>
            </form>
            </div><!-- .sidebar end -->
          </div>

        </div>
        
        
      </div>
    </section><!-- #content end -->

<!--     <script src="http://localhost/rafeki/js/jquery.js"></script>
    <script src="http://localhost/rafeki/js/plugins.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBY-ypuZnxoYlWLhUVBoTk7knFoHReguJw"></script>
    <script src="http://localhost/rafeki/js/functions.js"></script> -->

    <!-- script>


    jQuery(document).ready( function($){
      $(window).on( 'pluginIsotopeReady', function(){
        $('#shop').isotope({
          transitionDuration: '0.65s',
          getSortData: {
            name: '.product-title',
            price_lh: function( itemElem ) {
              if( $(itemElem).find('.product-price').find('ins').length > 0 ) {
                var price = $(itemElem).find('.product-price ins').text();
              } else {
                var price = $(itemElem).find('.product-price').text();
              }

              priceNum = price.split("$");

              return parseFloat( priceNum[1] );
            },
            price_hl: function( itemElem ) {
              if( $(itemElem).find('.product-price').find('ins').length > 0 ) {
                var price = $(itemElem).find('.product-price ins').text();
              } else {
                var price = $(itemElem).find('.product-price').text();
              }

              priceNum = price.split("$");

              return parseFloat( priceNum[1] );
            }
          },
          sortAscending: {
            name: true,
            price_lh: true,
            price_hl: false
          }
        });

        $('.custom-filter:not(.no-count)').children('li:not(.widget-filter-reset)').each( function(){
          var element = $(this),
            elementFilter = element.children('a').attr('data-filter'),
            elementFilterContainer = element.parents('.custom-filter').attr('data-container');

          elementFilterCount = Number( jQuery(elementFilterContainer).find( elementFilter ).length );

          element.append('<span>'+ elementFilterCount +'</span>');

        });

        $('.shop-sorting li').click( function() {
          $('.shop-sorting').find('li').removeClass( 'active-filter' );
          $(this).addClass( 'active-filter' );
          var sortByValue = $(this).find('a').attr('data-sort-by');
          $('#shop').isotope({ sortBy: sortByValue });
          return false;
        });
      });
    });
  </script> -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" >
  
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" id="products-detail">
          <div class="modal-body">
              
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
      </div>
    </div>
</div>

<script>


$(".category_slug").click(function(){
 if($(this).is(":checked")) {

    var arr=[];

    $("input:checkbox[name*=category_slug]:checked").each(function(){
         arr.push($(this).val());
    });

    var category_slug_values = $('input.category_slug').serializeArray();
    //console.log(p);
    //console.log(arr);








      

      var checkboxValue = [ $(this).val() ];

      var vendorName = "<?php echo $vendorName; ?>";

      $("#formname").on("change", "input:checkbox", function(){
        $("#formname").submit();
        });
      

      // $.ajaxSetup({
      //    headers: {
      //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //    }
      // });


    // $.ajax({
    //    type: 'GET',
    //    url: '{{url("supplier-product/vendor")}}' + '/' + vendorName,
    //    data: { category_slug:category_slug_values,  vendor_name:vendorName},

    //     success: function(data) {

    //          // $('#sp').load('/supplier_product');
    //          // $('#sp').html(data);
    //          $('.filter_data').html(data);
    //        if (data.success == true) {
    //         // location.reload();
    //          // $("#iname").value = data.info;
    //          // console.log(data);
    //        } else {
    //          // alert('Cannot find info');
    //          }

             
    //      }
       
    //  });

     }





});




</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBx2nsVcjGWuokaW5qCHWTxCL4CXiGdz2Q&libraries=places&callback=initialize" async defer></script>

<script type="text/javascript">
	function initialize() {

    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    const locationInputs = document.getElementsByClassName("map-input");

    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;
    for (let i = 0; i < locationInputs.length; i++) {

        const input = locationInputs[i];
        const fieldKey = input.id.replace("-input", "");
        const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

        const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
        const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

        const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 13
        });
        const marker = new google.maps.Marker({
            map: map,
            position: {lat: latitude, lng: longitude},
        });

        marker.setVisible(isEdit);

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.key = fieldKey;
        autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
    }

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            marker.setVisible(false);
            const place = autocomplete.getPlace();

            geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();
                    setLocationCoordinates(autocomplete.key, lat, lng);
                }
            });

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                input.value = "";
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

        });
    }
}

function setLocationCoordinates(key, lat, lng) {
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
}
</script>



@endsection