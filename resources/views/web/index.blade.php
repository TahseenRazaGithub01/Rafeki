@extends('web.layout')
@section('content')
       <!-- End Header Content -->

       <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
      <!-- END NOTIFICATION CONTENT -->

       <!-- Carousel Content -->
       <?php  echo $final_theme['carousel']; ?>
       <!-- Fixed Carousel Content -->

      <!-- Banners Content -->
      <!-- Products content -->

  <!-- Content
    ============================================= -->
    <section id="content">
      <div class="content-wrap">
        <div class="container clearfix">
          @include('web.rafeki-product-sections.bestselling');   
          <div class="clear"></div>

          <!-- Brands
          ============================================= -->
		  @if( !empty( $result['home_page_show_vendors'] ) )
          <div class="line"></div>
          <div class="row mt-5">
            <div class="col-12">
              <h2 class="titular-title font-weight-bold center ">{{ trans('website.PetProductSupplier') }}</h2>
            <p class="titular-sub-title center mb-5">{{ trans('website.PetProductSupplierDetail') }}</p>
            

              <ul class="clients-grid grid-2 grid-sm-3 grid-md-6 grid-lg-8 mb-0">
				@foreach($result['home_page_show_vendors'] as $record)
					<?php
					if($record->vendor_logo != NULL){
					$get_vendor_logo = DB::table('image_categories')->select('image_id','path')->where('image_id', $record->vendor_logo)->first();
					?>
					<li class="grid-item">
            
            <a href="{{ route('store', $record->user_name) }}"><img src="{{asset($get_vendor_logo->path) }}" alt="Clients"></a>
          </li>
					<?php } ?>
					
				@endforeach               
			
                

               
              </ul>
            </div>
          </div>
		  @endif
          
          <!-- Pet Services
          ============================================= -->
          <div class="line"></div>
          <div class="container topmargin clearfix">
                <h2 class="titular-title font-weight-bold center ">Pet Services</h2>
            <p class="titular-sub-title center mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit voluptas.</p>
            
        
          <div class="row col-mb-50">
            <div class="col-lg-2 col-md-4 col-6 offset-lg-1">
              <div class="feature-box fbox-center">
                
                <div class="fbox-image imagescalein">
                  <a href="#"><img width="150px" src="{{asset('rafekiweb/assets/demos/ecommerce/images/ser1.png')}}" alt="Image"></a>
                </div>
                <div class="fbox-content">
                  <h3 class="font-weight-bold ls1">Food Suppliment</h3>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
              <div class="feature-box fbox-center">
                
                <div class="fbox-image imagescalein">
                  <a href="#"><img width="150px" src="{{asset('rafekiweb/assets/demos/ecommerce/images/ser1.png')}}" alt="Image"></a>
                </div>
                <div class="fbox-content">
                  <h3 class="font-weight-bold ls1">Doctor</h3>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
              <div class="feature-box fbox-center">
                <div class="fbox-image imagescalein">
                  <a href="#"><img width="150px" src="{{asset('rafekiweb/assets/demos/ecommerce/images/ser1.png')}}" alt="Image"></a>
                </div>
                <div class="fbox-content">
                  <h3 class="font-weight-bold ls1">Service</h3>
                </div>
                
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
              <div class="feature-box fbox-center">
                
                <div class="fbox-image imagescalein">
                  <a href="#"><img width="150px" src="{{asset('rafekiweb/assets/demos/ecommerce/images/ser1.png')}}" alt="Image"></a>
                </div>
                <div class="fbox-content">
                  <h3 class="font-weight-bold ls1">Hair Cutting</h3>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6">
              <div class="feature-box fbox-center">
                
                <div class="fbox-image imagescalein">
                  <a href="#"><img width="150px" src="{{asset('rafekiweb/assets/demos/ecommerce/images/ser1.png')}}" alt="Image"></a>
                </div>
                <div class="fbox-content">
                  <h3 class="font-weight-bold ls1">Vaccine</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
          
          <div class="container topmargin clearfix">
          

          
        </div>
          
        

          

          

        </div>



        

        <!-- Pick & Drop
        ============================================= -->
            
      
      <div class="section my-4 py-5">
          <div class="container">
            <h2 class="titular-title font-weight-bold center ">Pet Transport</h2>
            <p class="titular-sub-title center mb-5">Lorem ipsum dolor sit amet, consectetur.</p>
              
            <div class="row">
              <div class="col-md-12">
                <div class="row align-items-stretch align-items-center">
                  <div class="col-md-7 min-vh-50" style="background: url('public/rafekiweb/assets/demos/shop/images/sections/3.jpg') center center no-repeat; background-size: cover;">
                    <div class="vertical-middle pl-5">
                      <h2 class="pl-5"><strong>Pick & Drop</strong> for<br>Your Pets</h2>
                    </div>
                  </div>
                  <div class="col-md-5 bg-white">
                    <div class="card border-0 py-2">
                      <div class="card-body">
                        <h3 class="card-title mb-4 ls0">Get your Pet safely transit with us.</h3>
                        <ul class="iconlist ml-3">
                          <li><i class="icon-circle-blank text-black-50"></i> Verified Drivers</li>
                          <li><i class="icon-circle-blank text-black-50"></i> Organized for Pets</li>
                          <li><i class="icon-circle-blank text-black-50"></i> Cash on Delivery Accepted</li>
                        </ul>
                        <a href="#" class="button button-rounded ls0 font-weight-semibold ml-0 mb-2 nott px-4">Book Now</a><br>
                        <small class="font-italic text-black-50">Don't worry, it's totally safe.</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container">

          <!-- Features
          ============================================= -->
          <div class="row col-mb-50 mb-0 mt-5">
            <div class="col-lg-7">
              <div class="row mt-3">
                <div class="col-sm-6">
                  <div class="feature-box fbox-sm fbox-plain">
                    <div class="fbox-icon">
                      <a href="#"><i class="icon-line2-present text-dark text-dark"></i></a>
                    </div>
                    <div class="fbox-content">
                      <h3 class="font-weight-normal">100% Original</h3>
                      <p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 mt-4 mt-sm-0">
                  <div class="feature-box fbox-sm fbox-plain">
                    <div class="fbox-icon">
                      <a href="#"><i class="icon-line2-globe text-dark"></i></a>
                    </div>
                    <div class="fbox-content">
                      <h3 class="font-weight-normal">Free Shipping</h3>
                      <p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 mt-4">
                  <div class="feature-box fbox-sm fbox-plain">
                    <div class="fbox-icon">
                      <a href="#"><i class="icon-line2-reload text-dark"></i></a>
                    </div>
                    <div class="fbox-content">
                      <h3 class="font-weight-normal">30-Days Returns</h3>
                      <p>You have complete easy control on each &amp; every element that provides endless customization possibilities.</p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 mt-4">
                  <div class="feature-box fbox-sm fbox-plain">
                    <div class="fbox-icon">
                      <a href="#"><i class="icon-line2-wallet text-dark"></i></a>
                    </div>
                    <div class="fbox-content">
                      <h3 class="font-weight-normal">Payment Options</h3>
                      <p>We accept Visa, MasterCard and American Express. And We also Deliver by COD(only in US)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="accordion clearfix">

                <div class="accordion-header">
                  <div class="accordion-icon">
                    <i class="accordion-closed icon-ok-circle"></i>
                    <i class="accordion-open icon-remove-circle"></i>
                  </div>
                  <div class="accordion-title">
                    Our Mission
                  </div>
                </div>
                <div class="accordion-content">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

                <div class="accordion-header">
                  <div class="accordion-icon">
                    <i class="accordion-closed icon-ok-circle"></i>
                    <i class="accordion-open icon-remove-circle"></i>
                  </div>
                  <div class="accordion-title">
                    What we Do?
                  </div>
                </div>
                <div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

                <div class="accordion-header">
                  <div class="accordion-icon">
                    <i class="accordion-closed icon-ok-circle"></i>
                    <i class="accordion-open icon-remove-circle"></i>
                  </div>
                  <div class="accordion-title">
                    Our Company's Values
                  </div>
                </div>
                <div class="accordion-content">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

                <div class="accordion-header">
                  <div class="accordion-icon">
                    <i class="accordion-closed icon-ok-circle"></i>
                    <i class="accordion-open icon-remove-circle"></i>
                  </div>
                  <div class="accordion-title">
                    Our Return Policy
                  </div>
                </div>
                <div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

              </div>
            </div>

          </div>

          
        </div>

        <div class="clear"></div>

        <!-- App Buttons
        ============================================= -->
        <div class="section pb-0 mb-0" style="background-color: #e0dace">
          <div class="container">
            <div class="row">
              <div class="col-md-6 offset-1 bottommargin-lg d-flex flex-column align-self-center">
                <h3 class="card-title font-weight-normal ls0">Explore. Shop. Book.<br>Your Pet's Rafeki in pocket.</h3>
                <span>Apps enable more Benefits.</span>
                <div class="mt-3">
                  <a href="#" class="button inline-block button-small button-rounded button-desc font-weight-normal ls1 clearfix"><i class="icon-apple"></i><div><span>Download Rafeki</span>App Store</div></a>
                  <a href="#" class="button inline-block button-small button-rounded button-desc button-light text-dark font-weight-normal ls1 bg-white border clearfix"><i class="icon-googleplay"></i><div><span>Download Rafeki</span>Google Play</div></a>
                </div>
              </div>
              <div class="col-md-4 d-none d-md-flex align-items-end">
                <img src="{{asset('rafekiweb/assets/demos/shop/images/sections/app.png')}}" alt="Image" class="mb-0">
              </div>
            </div>
          </div>
        </div>

        <!-- Last Section
        ============================================= -->
        <div class="section footer-stick bg-white m-0 py-3 border-bottom">
          <div class="container clearfix">

            <div class="row clearfix">
              <div class="col-lg-4 col-md-6">
                <div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-globe-alt"></i><h5 class="inline-block mb-0 ml-2 font-weight-semibold"><a href="#">Free Shipping</a><span class="font-weight-normal text-muted"> &amp; Easy Returns</span></h5></div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-notebook"></i><h5 class="inline-block mb-0 ml-2"><a href="#">Geniune Products</a><span class="font-weight-normal text-muted"> Guaranteed</span></h5></div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-lock"></i><h5 class="inline-block mb-0 ml-2"><a href="#">Online</a> <span class="font-weight-normal text-muted">Secured Checkouts</span></h5></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section><!-- #content end -->
@include('web.common.scripts.addToCompare')
@include('web.common.scripts.Like')
@endsection
