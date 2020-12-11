<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
@include('web.common.meta')

<link rel="stylesheet" href="{{asset('rafekiweb/assets/style.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/dark.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/swiper.css')}}" type="text/css" />

  <!-- shop Demo Specific Stylesheet -->
  <link rel="stylesheet" href="{{asset('rafekiweb/assets/demos/shop/shop.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/fonts.css')}}" type="text/css" />
  <!-- / -->

  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/font-icons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/animate.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/magnific-popup.css')}}" type="text/css" />

  <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/custom.css')}}" type="text/css" />

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link rel="stylesheet" href="{{asset('rafekiweb/assets/css/colors.php?color=ff7110')}}" type="text/css" />
  @if(!empty($result['commonContent']['setting'][86]->value))
  <link rel="icon" type="image/png" href="{{asset('').$result['commonContent']['setting'][86]->value}}">
  @endif

    <meta name="DC.title"  content="<?=stripslashes($result['commonContent']['setting'][73]->value)?>"/>
    <meta name="description" content="<?=stripslashes($result['commonContent']['setting'][75]->value)?>"/>
    <meta name="keywords" content="<?=stripslashes($result['commonContent']['setting'][74]->value)?>"/>

    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  </head>
  <div id="wrapper" class="clearfix">
    <!-- dir="rtl" -->
     <body class="stretched animation-s<?php  echo $final_theme['transitions']; if(!empty(session('direction')) and session('direction')=='rtl') print ' bodyrtl';?> " id="app">
      
      <div class="se-pre-con" id="loader" style="display: block">
        <div class="pre-loader">
          <div class="la-line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <p>@lang('website.Loading')..</p>
        </div>
      </div>

      <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')

       <!-- On LOad Modal -->
    <div class="modal1 mfp-hide subscribe-widget mx-auto" id="myModal1" style="max-width: 750px;">
      <div class="row justify-content-center bg-white align-items-center" style="min-height: 380px;">
        <div class="col-md-5 p-0">
          <div style="background: url('') no-repeat center right; background-size: cover;  min-height: 380px;"></div>
        </div>
        <div class="col-md-7 bg-white p-4">
          <div class="heading-block border-bottom-0 mb-3">
            <h3 class="font-secondary nott ">Join Our Newsletter &amp; Get <span class="text-danger">40%</span> Off your First Order</h3>
            <span>Get Latest Fashion Updates &amp; Offers</span>
          </div>
          <div class="widget-subscribe-form-result"></div>
          <form class="widget-subscribe-form2 mb-2" action="include/subscribe.php" method="post">
            <input type="email" id="widget-subscribe-form2-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email Address..">
            <div class="d-flex justify-content-between align-items-center mt-1">
              <button class="button button-dark  bg-dark text-white ml-0" type="submit">Subscribe</button>
              <a href="#" class="btn-link" onClick="$.magnificPopup.close();return false;">Don't Show me</a>
            </div>
          </form>
          <small class="mb-0 font-italic text-black-50">*We also hate Spam &amp; Junk Emails.</small>
        </div>
      </div>
    </div>

    <!-- Login Modal -->
    <div class="modal1 mfp-hide" id="modal-register">
      <div class="card mx-auto" style="max-width: 540px;">
        <div class="card-header py-3 bg-transparent center">
          <h3 class="mb-0 font-weight-normal">Hello, Welcome Back</h3>
        </div>
        <div class="card-body mx-auto py-5" style="max-width: 70%;">

          <a href="#" class="button button-large btn-block si-colored si-facebook nott font-weight-normal ls0 center"><i class="icon-facebook-sign"></i> Log in with Facebook</a>
          
          <a href="#" class="button button-large btn-block si-colored si-google nott font-weight-normal ls0 center"><i class="icon-google"></i> Log in with Google</a>

          <div class="divider divider-center"><span class="position-relative" style="top: -2px">OR</span></div>

          <form id="login-form" name="login-form" class="mb-0 row" action="#" method="post">

            <div class="col-12">
              <input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" placeholder="Username" />
            </div>

            <div class="col-12 mt-4">
              <input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" placeholder="Password" />
            </div>

            <div class="col-12">
              <a href="#" class="float-right text-dark font-weight-light mt-2">Forgot Password?</a>
            </div>

            <div class="col-12 mt-4">
              <button class="button btn-block m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
            </div>
          </form>
        </div>
        <div class="card-footer py-4 center">
          <p class="mb-0">Don't have an account? <a href="#"><u>Sign up</u></a></p>
        </div>
      </div>
    </div>


      @if (count($errors) > 0)
          @if($errors->any())
           <script>swal("Congrates!", "Thanks For Shopping!", "success");</script>
          @endif
      @endif
      
      <div id="top-bar" class="dark" style="background-color: #c5beb1;">
  <div class="container">

    <div class="row justify-content-between align-items-center">

      <div class="col-12 col-lg-auto">
        <p class="mb-0 d-flex justify-content-center justify-content-lg-start py-3 py-lg-0"><strong>
         @php echo stripslashes($result['commonContent']['top_offers']->top_offers_text); @endphp</strong></p>
      </div>



      <div class="col-12 col-lg-auto d-none d-lg-flex">

        <!-- Top Links
        ============================================= -->
        <div class="top-links">
          <ul class="top-links-container">
            <li class="top-links-item"><a href="#">About</a></li>
            <li class="top-links-item"><a href="#">FAQS</a></li>

            <li class="top-links-item"><a href="#">
             @if(count($languages) > 1)
              {{  session('language_name')}}</a>
             
              <ul class="top-links-sub-menu">
                 @foreach($languages as $language)
                <li class="top-links-item"><a href="#" onclick="myFunction1({{$language->languages_id}})">{{$language->name}}</a></li>
                 @endforeach    
              </ul>
               @include('web.common.scripts.changeLanguage')
            </li>
             @endif
             <div class="navbar-lang">
        
        </div>

          </ul>
        </div><!-- .top-links end -->

        <!-- Top Social
        ============================================= -->
        <ul id="top-social">
          <li><a href="{{$result['commonContent']['setting'][50]->value}}" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
          <li><a href="{{$result['commonContent']['setting'][53]->value}}" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
          <li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">{{$result['commonContent']['setting'][11]->value}}</span></a></li>
          <li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">{{$result['commonContent']['setting'][3]->value}}</span></a></li>
        </ul><!-- #top-social end -->

      </div>
    </div>

  </div>
</div>

<header id="stickyHeader" class="full-header header-size-lg">
  <div id="header-wrap" style="background-color: #e0dace;">
    <div class="container">
      <div class="header-row justify-content-lg-between">

        <!-- Logo
        ============================================= -->
       <!--  <div id="logo" class="mr-lg-4">
          <a href="index.php" class="standard-logo"><img src="{{asset('rafekiweb/assets/images/logo.png')}}" alt="Canvas Logo"></a>
          <a href="index.php" class="retina-logo"><img src="{{asset('rafekiweb/assets/images/logo@2x.png')}}" alt="Canvas Logo"></a>
        </div> -->

      
              <div id="logo" class="mr-lg-4">
                <a href="{{ URL::to('/')}}" class="logo standard-logo" data-toggle="tooltip" data-placement="bottom" title="@lang('website.logo')">
                  @if($result['commonContent']['settings']['sitename_logo']=='name')
                  <?=stripslashes($result['commonContent']['settings']['website_name'])?>
                  @endif
              
                  @if($result['commonContent']['settings']['sitename_logo']=='logo')
                  <img class="img-fluid" src="{{asset('').$result['commonContent']['settings']['website_logo']}}" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
                  @endif
                  </a>

                </div>
       

        <!-- #logo end -->

        <div class="header-misc">

          <!-- Top Search
          ============================================= -->
         <!--  <div id="top-account">
            <a href="#modal-register" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium">Login</span></a>
          </div> --><!-- #top-search end -->

           <div class="col-12 col-md-8">
          <ul class="link-list">
            <li class="">
              <div class="link-item">
                <div class="avatar">
                  
                <?php
                    if(auth()->guard('customer')->check()){
                      echo substr(auth()->guard('customer')->user()->first_name, 0, 1);
                    }
                ?> 

                </div>
                <span><?php if(auth()->guard('customer')->check()){ ?>@lang('website.Welcome') {{auth()->guard('customer')->user()->first_name}} &nbsp;! <?php }?> </span>
              </div>
            </li>

            <?php if(auth()->guard('customer')->check()){ ?>
            <li class="link-item"> <a href="{{url('profile')}}" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>@lang('website.Profile')</a> </li>
           <!--  <li class="link-item"> <a href="{{url('wishlist')}}" >@lang('website.Wishlist') <span class="total_wishlist"> ({{$result['commonContent']['total_wishlist']}})</span></a> </li>
            <li class="link-item"> <a href="{{url('compare')}}" >@lang('website.Compare')&nbsp;(<span id="compare"></span>)</a> </li>
            <li class="link-item"> <a href="{{url('orders')}}" >@lang('website.Orders')</a> </li>
            <li class="link-item"> <a href="{{url('shipping-address')}}" >@lang('website.Shipping Address')</a> </li>-->
            <li class="link-item"> <a href="{{url('logout')}}">@lang('website.Logout')</a> </li> 
            
          </ul> 
            <?php }else{ ?>
          <div id="top-account">
             <li class="link-item"> <a href="{{ URL::to('/login')}}"><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>@lang('website.Login')</a> </li>
          </div>

            <?php } ?>
        </div>


          <!-- Top Cart
          ============================================= -->

            <?php $qunatity=0; ?>
        @foreach($result['commonContent']['cart'] as $cart_data)
          <?php $qunatity += $cart_data->customers_basket_quantity; ?>
        @endforeach
            
            <div id="top-cart" class="header-misc-icon d-none d-sm-block">
            <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">{{$qunatity}}</span></a>
            <div class="top-cart-content">
              <div class="top-cart-title">
                <h4>Shopping Cart</h4>
              </div>
              <div class="top-cart-items">
                <?php
                    $total_amount=0;
                    $qunatity=0;
                ?>
                @if(count($result['commonContent']['cart'])>0)
                
                 @foreach($result['commonContent']['cart'] as $cart_data)
          <?php
          $total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
          $qunatity     += $cart_data->customers_basket_quantity; 
          ?>
                  <div class="top-cart-item">
                    <div class="top-cart-item-image">
                      <a href="#"><img src="{{asset('').$cart_data->image}}" alt="{{$cart_data->products_name}}" /></a>
                    </div>
                    <div class="top-cart-item-desc">
                      <div class="top-cart-item-desc-title">
                        <a href="#">{{$cart_data->products_name}}</a>
                        <span class="top-cart-item-price d-block">{{Session::get('symbol_left')}}{{$cart_data->final_price*session('currency_value')}}{{Session::get('symbol_right')}}</span>
                      </div>
                      <div class="top-cart-item-quantity"> {{$cart_data->customers_basket_quantity}} x</div>
                       <a href="{{ URL::to('/deleteCart?id='.$cart_data->customers_basket_id)}}" class="icon" ><i class="fas fa-trash"></i></a>
                    </div>
                  </div>
                 @endforeach
                @endif
              </div>
              <div class="top-cart-action">
                <span class="top-checkout-price">{{Session::get('symbol_left')}}{{ $total_amount*session('currency_value') }}{{Session::get('symbol_right')}}</span>
                <a href="{{ URL::to('/viewcart')}}" class="button button-3d button-small m-0">@lang('website.View Cart')</a>
              </div>
            </div>
          </div>

          <!-- #top-cart end -->

          <!-- Top Wishlist
          ============================================= -->
          <div id="" class="header-misc-icon">
            <a href="#" id=""><i class="icon-line-heart"></i></a>
          </div>
          
          <!-- Top Search
          ============================================= -->
          <div id="top-search" class="header-misc-icon">
            <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
          </div><!-- #top-search end -->
          

        </div>

        <div id="primary-menu-trigger">
          <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
        </div>

        <!-- Primary Navigation
        ============================================= -->
        <nav class="primary-menu with-arrows mr-lg-auto">

          <ul class="menu-container">
           <!--  <li class="menu-item current"><a class="menu-link" href="index.php"><div>Home</div></a></li> -->
            <li class="mega-menu menu-item"><a class="menu-link" href="#"><div>Shop by Pet</div></a>
              <!-- Mega Menu Content
              ============================================= -->
              <div class="mega-menu-content mega-menu-style-2 pl-lg-0">
                <div class="container">
                  <div class="row">
                    <!-- Mega Menu Nav Link
                    ============================================= -->
                    <ul class="sub-menu-container mega-menu-column col-lg-2 p-lg-0">
                      <li class="menu-item">
                        <div class="widget">
                          <div class="list-group list-group-flush" id="side-tabs" role="tablist" aria-orientation="vertical">

                            <?php 
                               $categories = recursivecategories();
                               ?>
                                  @if($categories)
                                  @php $parent_id = 0;
                                  $option = ''; @endphp


                                    @foreach($categories as $key => $parents)

                                      @if($parents->slug==app('request')->input('category'))
                                       @php $selected = "active"; @endphp
                                      @else 
                                         @php $selected = ""; @endphp
                                      @endif
                                    

                                      <a class="list-group-item border-default {{ $key == 0 ? "active" : "a" }} {{$selected}}" data-toggle="tab" href="#mega-menu-tab-{{$key}}" role="tab" aria-controls="mega-menu-tab-{{$key}}" aria-selected="true"><img width="40px" src="{{ asset($parents->path) }}" alt="Image" class="rounded-circle">{{$parents->categories_name}}</a>
                                      

                                       


                                    @endforeach
                                    @endif
                             

                           <!--  <a class="list-group-item border-default active" data-toggle="tab" href="#mega-menu-tab-dog" role="tab" aria-controls="mega-menu-tab-dog" aria-selected="true"><img width="40px" src="{{asset('rafekiweb/assets/demos/shop/images/dog-icon.png')}}" alt="Image" class="rounded-circle">Dog</a>
                            <a class="list-group-item border-default" data-toggle="tab" href="#mega-menu-tab-cat" role="tab" aria-controls="mega-menu-tab-cat" aria-selected="false"><img width="40px" src="{{asset('rafekiweb/assets/demos/shop/images/dog-icon.png')}}" alt="Image" class="rounded-circle">Cat</a>
                            <a class="list-group-item border-default" data-toggle="tab" href="#mega-menu-tab-bird" role="tab" aria-controls="mega-menu-tab-bird" aria-selected="false"><img width="40px" src="{{asset('rafekiweb/assets/demos/shop/images/dog-icon.png')}}" alt="Image" class="rounded-circle">Bird</a>
                            <a class="list-group-item border-default" data-toggle="tab" href="#mega-menu-tab-fish" role="tab" aria-controls="mega-menu-tab-fish" aria-selected="false"><img width="40px" src="{{asset('rafekiweb/assets/demos/shop/images/dog-icon.png')}}" alt="Image" class="rounded-circle">Fish</a> -->
                          </div>
                        </div>
                      </li>
                    </ul>
                    <!-- Mega Menu Nav Content
                    ============================================= -->
                    <ul class="sub-menu-container mega-menu-column col-lg">
                      <li class="menu-item">
                        <div class="widget">
                          <div class="tab-content">
                          @foreach($categories as $key=> $parents)
                       
                            <div class="tab-pane pt-4 pt-md-0 show {{ $key == 0 ? "active" : "a" }} {{$selected}}" id="mega-menu-tab-{{$key}}" role="tabpanel" aria-labelledby="mega-menu-tab-{{$key}}">
                              <div class="row col-mb-30">
                                @if(isset($parents->childs))
                                @foreach($parents->childs as $sub)
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="{{url('/'.$sub->slug)}}"><div>{{$sub->categories_name}}</div></a>
                                      @if(isset($sub->childs))
                                      @foreach($sub->childs as $s)
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="{{url('/'.$s->slug)}}"><div>{{$s->categories_name}}</div></a></li>
                                      </ul>
                                      @endforeach
                                      @endif
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                @endforeach
                                @endif
                               <!--  <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Dog Products</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Beg</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Towel</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Chains</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Dog Accessories</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Rings</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Tags</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div> -->
                                
                              </div>
                            </div>
                            <div class="tab-pane pt-4 pt-md-0" id="mega-menu-tab-cat" role="tabpanel" aria-labelledby="mega-menu-tab-cat">
                              <div class="row col-mb-30">
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Cat Food</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Cat Food</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Dry Food</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Food Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Cat Products</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Beg</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Towel</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Chains</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Cat Accessories</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Rings</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Tags</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                
                              </div>
                            </div>
                            <!-- <div class="tab-pane pt-4 pt-md-0" id="mega-menu-tab-bird" role="tabpanel" aria-labelledby="mega-menu-tab-bird">
                              <div class="row col-mb-30">
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Bird Food</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Can Food</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Dry Food</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Food Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Bird Products</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Beg</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Towel</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Chains</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Bird Accessories</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Rings</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Tags</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                
                              </div>
                            </div> -->
                           <!--  <div class="tab-pane pt-4 pt-md-0" id="mega-menu-tab-fish" role="tabpanel" aria-labelledby="mega-menu-tab-fish">
                              <div class="row col-mb-30">
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Fish Food</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Can Food</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Dry Food</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Food Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>FIsh Products</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Beg</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Towel</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Chains</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                <div class="col-md-4 entry mb-0">
                                  <ul class="sub-menu-container mega-menu-column border-left-0 col-12">
                                    <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>FIsh Accessories</div></a>
                                      <ul class="sub-menu-container">
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Rings</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Tags</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Toppers</div></a></li>
                                        <li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
                                      </ul>
                                    </li>
                                    
                                  </ul>
                                  
                                </div>
                                
                              </div>
                            </div> -->
                          @endforeach
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
          <!--   <li class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#"><div>Shop by Supplier</div></a>
              <div class="mega-menu-content mega-menu-style-2">
                <div class="container">
                  <div class="row">
                    <ul class="sub-menu-container mega-menu-column col-lg-12">
                      <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Our Suppliers</div></a>
                        <ul class="sub-menu-container">
                          <li class="menu-item"><a class="menu-link" href="supplier-product.php"><div>ABC Supplier Est.</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Pet Shop Name</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Supplier Name</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Supplier Name</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Supplier Name</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Explore all <i class="icon-angle-right"></i></div></a></li>
                        </ul>
                      </li>
                    </ul>
                    
                  </div>
                </div>
              </div>
            </li>
            <li class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#"><div>Pet Services</div></a>
              <div class="mega-menu-content mega-menu-style-2">
                <div class="container">
                  <div class="row">
                    <ul class="sub-menu-container mega-menu-column col-lg-12">
                      <li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Explore Service Providers</div></a>
                        <ul class="sub-menu-container">
                          <li class="menu-item"><a class="menu-link" href="supplier-services.php"><div>ABC Vet Store Est.</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Pet Clinic Inc.</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Az Cats Center</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="#"><div>Explore all <i class="icon-angle-right"></i></div></a></li>
                        </ul>
                      </li>
      
                    </ul>
                    
                  </div>
                </div>
              </div>
            </li>
            <li class="menu-item"><a class="menu-link" href="#"><div>Pick & Drop</div></a></li>
            <li class="menu-item"><a class="menu-link" href="#"><div>Ads</div></a></li>
            <li class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#"><div>Page Links (Testing)</div></a>
              <div class="mega-menu-content mega-menu-style-2">
                <div class="container">
                  <div class="row">
                    
                        <ul class="sub-menu-container">
                          <li class="menu-item"><a class="menu-link" href="index.php"><div>Home</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="product-list.php"><div>Products in Category</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="supplier-product.php"><div>Products Supplier</div></a></li>
                          
                          <li class="menu-item"><a class="menu-link" href="supplier-services.php"><div>Services Suplier</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="product-detail.php"><div>Single Product Detail</div></a></li>
                          
                          <li class="menu-item"><a class="menu-link" href="cart.php"><div>Cart</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="checkout.php"><div>Checkout</div></a></li>
                          <li class="menu-item"><a class="menu-link" href="checkout.php"><div>Checkout</div></a></li>
                          
                        </ul>

                    
                  </div>
                </div>
              </div>
            </li> -->
            {!! $result['commonContent']["menusRecursive"] !!}
          </ul>

        </nav><!-- #primary-menu end -->

          <form class="top-search-form" action="{{ URL::to('/search')}}" method="get">
          <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
        </form>

      </div>
    </div>
  </div>
  <div class="header-wrap-clone"></div>
</header><!-- #header end -->


    
      
       
      <!-- END NOTIFICATION CONTENT -->
         @yield('content')
         <div class="notifications" id="notificationWishlist"></div>
         

 <!-- Footer
    ============================================= -->
   <footer id="footer" class=" border-0">
<img src="{{asset('rafekiweb/assets/images/footertop.png')}}" alt="">
      <div class="container clearfix">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap pb-3 clearfix">

          <div class="row">
<div class="col-lg-2 col-md-3 col-6">
              <div class="widget clearfix">
<a href="demo-shop.html" class="standard-logo"><img height="160" src="{{asset('rafekiweb/assets/images/logo.png')}}" alt="Canvas Logo"></a>

              </div>
  <div class="widget clearfix">

                <a href="#" class="social-icon si-small si-rounded si-facebook">
                  <i class="icon-facebook"></i>
                  <i class="icon-facebook"></i>
                </a>

                <a href="#" class="social-icon si-small si-rounded si-twitter">
                  <i class="icon-twitter"></i>
                  <i class="icon-twitter"></i>
                </a>

                <a href="#" class="social-icon si-small si-rounded si-gplus">
                  <i class="icon-gplus"></i>
                  <i class="icon-gplus"></i>
                </a>

                <a href="#" class="social-icon si-small si-rounded si-pinterest">
                  <i class="icon-pinterest"></i>
                  <i class="icon-pinterest"></i>
                </a>

                



              </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mt-3">
              <div class="widget clearfix">
                <h4 class="ls0 mb-3 nott">Pet's Rafeki</h4>

                <ul class="list-unstyled iconlist ml-0">
                  <li><a href="#">Pet Suppliers</a></li>
                  <li><a href="#">Pet Products</a></li>
                  <li><a href="#">Pet Services</a></li>
                  <li><a href="#">Pick & Drop</a></li>
                  <li><a href="#">Public Ads</a></li>
                  
                </ul>

              </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mt-3">
              <div class="widget clearfix">

                <h4 class="ls0 mb-3 nott">Quick Links</h4>

                <ul class="list-unstyled iconlist ml-0">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Support</a></li>
                  <li><a href="#">Contact</a></li>
                  <li><a href="#">Become a Supplier</a></li>
                </ul>

              </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mt-3">
              <div class="widget clearfix">

                <h4 class="ls0 mb-3 nott">Featured Suppliers</h4>

                <ul class="list-unstyled iconlist ml-0">
                  <li><a href="#">ABC Name</a></li>
                  <li><a href="#">BB Pets Ltd</a></li>
                  <li><a href="#">AtoZ Pet Hive</a></li>
                  <li><a href="#">Falcon Shop</a></li>
                  <li><a href="#">Fish & Fish Shop</a></li>
                </ul>

              </div>
            </div>
            
            <div class="col-lg-4 col-md-8 mt-3">
              <div class="widget clearfix">

                <h4 class="ls0 mb-3 nott">Subscribe Now</h4>
                <div class="widget subscribe-widget mt-2 clearfix">
                  <p class="mb-4"><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</p>
                  <div class="widget-subscribe-form-result"></div>
                  <form id="widget-subscribe-form" action="include/subscribe.php" method="post" class="mt-1 mb-0 d-flex">
                    <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control border-0 sm-form-control required email" placeholder="Enter your Email Address">

                    <button class="button nott font-weight-normal ml-1 my-0" type="submit">Subscribe Now</button>
                  </form>
                </div>

              </div>
            </div>

          </div>

        </div><!-- .footer-widgets-wrap end -->

      </div>




    






      <!-- Copyrights
      ============================================= -->
      <div id="copyrights" class="bg-transparent">

        <div class="container clearfix">

          <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
              Copyrights &copy; 2020 All Rights Reserved by Rafeki Inc.<br>
              <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
            </div>

            <div class="col-md-6 d-md-flex flex-md-column align-items-md-end mt-4 mt-md-0">
              <div class="copyrights-menu copyright-links clearfix">
                <a href="#">About</a>/<a href="#">Support</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>
              </div>
            </div>
          </div>

        </div>

      </div><!-- #copyrights end -->

    </footer>
    <!-- #footer end -->

     
   

    

    

      <!-- Include js plugin -->
       @include('web.common.scripts')
       <!-- Go To Top
  ============================================= -->
  <div id="gotoTop" class="icon-line-arrow-up"></div>
  <!-- JavaScripts
  ============================================= -->

  <script src="{{asset('rafekiweb/assets/js/jquery.js')}}"></script>
  <script src="{{asset('rafekiweb/assets/js/plugins.min.js')}}"></script>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyBY-ypuZnxoYlWLhUVBoTk7knFoHReguJw"></script>

  <!-- Footer Scripts
  ============================================= -->
  <script src="{{asset('rafekiweb/assets/js/functions.js')}}"></script>
    </body>
</html>
