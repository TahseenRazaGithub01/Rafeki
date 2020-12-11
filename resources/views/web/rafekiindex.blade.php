
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="SemiColonWeb" />

 <link rel="stylesheet" href="{{asset('rafekiweb/assets/css/bootstrap.css')}}" type="text/css" />

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
  <meta name="viewport" content="width=device-width, initial-scale=1" />

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

  @if(Request::path() == 'checkout')
    <!--------- stripe js ------>
    <script src="https://js.stripe.com/v3/"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  @endif

  <!-- Document Title
  ============================================= -->
  @if(!empty($result['commonContent']['setting'][72]->value))
    <title><?=stripslashes($result['commonContent']['setting'][72]->value)?></title>
    @else
    <title><?=stripslashes($result['commonContent']['setting'][18]->value)?></title>
    @endif

</head>


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

      @if (count($errors) > 0)
          @if($errors->any())
           <script>swal("Congrates!", "Thanks For Shopping!", "success");</script>
          @endif
      @endif
      
      <!-- Header Sections -->

      
  

       
  <!-- Document Wrapper
  ============================================= -->
  <div id="wrapper" class="clearfix">

     @if (count($errors) > 0)
          @if($errors->any())
           <script>swal("Congrates!", "Thanks For Shopping!", "success");</script>
          @endif
      @endif

    <!-- Header
    ============================================= -->
    <!--<div class="modal-on-load" data-target="#myModal1"></div>-->

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
<header id="header" class="full-header header-size-lg">
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
              <div id="top-account">
                <a href="#modal-register" data-lightbox="inline" ><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium">Login</span></a>
              </div><!-- #top-search end -->

              <!-- Top Cart
              ============================================= -->
              <div id="top-cart" class="header-misc-icon d-none d-sm-block">
                <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">5</span></a>
                <div class="top-cart-content">
                  <div class="top-cart-title">
                    <h4>Shopping Cart</h4>
                  </div>
                  <div class="top-cart-items">
                    <div class="top-cart-item">
                      <div class="top-cart-item-image">
                        <a href="#"><img src="{{asset('rafekiweb/assets/demos/shop/images/items/new/12.jpg')}}" alt="Blue Round-Neck Tshirt" /></a>
                      </div>
                      <div class="top-cart-item-desc">
                        <div class="top-cart-item-desc-title">
                          <a href="#">Product Name here</a>
                          <span class="top-cart-item-price d-block">SAR 19.99</span>
                        </div>
                        <div class="top-cart-item-quantity">x 2</div>
                      </div>
                    </div>
                    <div class="top-cart-item">
                      <div class="top-cart-item-image">
                        <a href="#"><img src="{{asset('rafekiweb/assets/demos/shop/images/items/new/11.jpg')}}" alt="Light Blue Denim Dress" /></a>
                      </div>
                      <div class="top-cart-item-desc">
                        <div class="top-cart-item-desc-title">
                          <a href="#">Product Name Here</a>
                          <span class="top-cart-item-price d-block">SAR 24.99</span>
                        </div>
                        <div class="top-cart-item-quantity">x 3</div>
                      </div>
                    </div>
                  </div>
                  <div class="top-cart-action">
                    <span class="top-checkout-price">SAR 114.95</span>
                    <a href="cart.php" class="button button-3d button-small m-0">View Cart</a>
                  </div>
                </div>
              </div><!-- #top-cart end -->

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
                                        <li class="menu-item mega-menu-title"><a class="menu-link" href="{{url('shop?category=').$sub->slug}}"><div>{{$sub->categories_name}}</div></a>
                                          @if(isset($sub->childs))
                                          @foreach($sub->childs as $s)
                                          <ul class="sub-menu-container">
                                            <li class="menu-item"><a class="menu-link" href="{{url('shop?category=').$s->slug}}"><div>{{$s->categories_name}}</div></a></li>
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

            <form class="top-search-form" action="{{ URL::to('/shop')}}" method="get">
              <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
            </form>

          </div>
        </div>
      </div>
      <div class="header-wrap-clone"></div>
    </header><!-- #header end -->
    <!-- #header end -->


      <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
      <!-- END NOTIFICATION CONTENT -->

    <!-- Slider
    ============================================= -->
   <!--  <section id="slider" class="slider-element swiper_wrapper" data-autoplay="6000" data-speed="800" data-loop="true" data-grab="true" data-effect="fade" data-arrow="false" style="height: 600px;">

      <div class="swiper-container swiper-parent">
        <div class="swiper-wrapper">
          <div class="swiper-slide dark">
            <div class="container">
              <div class="slider-caption slider-caption-center">
                <div>
                  <div class="h5 mb-2 font-secondary">We are here as</div>
                  <h2 class="bottommargin-sm text-white">Your Pet's Rafeki</h2>
                  <a href="#" class="button bg-white text-dark button-light">Explore Now</a>
                </div>
              </div>
            </div>
            <div class="swiper-slide-bg" style="background-image: url('public/rafekiweb/assets/demos/shop/images/slider/1.jpg');"></div>
          </div>
          
          
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </section> -->
    <?php  echo $final_theme['carousel']; ?>
    <!-- #Slider End -->
   
    
    <!-- Content
    ============================================= -->
    <section id="content">
      <div class="content-wrap">
        <div class="container clearfix">
          @include('web.rafeki-product-sections.bestselling');   
          <div class="clear"></div>

          <!-- Brands
          ============================================= -->
          <div class="line"></div>
          <div class="row mt-5">
            <div class="col-12">
              <h2 class="titular-title font-weight-bold center ">Pet Product Suppliers</h2>
            <p class="titular-sub-title center mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit voluptas.</p>
            

              <ul class="clients-grid grid-2 grid-sm-3 grid-md-6 grid-lg-8 mb-0">
                <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>
                 <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>
                  <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>
                   <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>
                    <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>
                     <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>
                      <li class="grid-item"><a href="#"><img src="{{asset('rafekiweb/assets/images/clients/logo/1.png')}}" alt="Clients"></a></li>

               
              </ul>
            </div>
          </div>
          
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

  </div><!-- #wrapper end -->
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

  <!-- ADD-ONS JS FILES -->
  <script>


jQuery(document).on('click', '.modal_show', function(e){

var parent = jQuery(this);
var products_id = jQuery(this).attr('products_id');
var message ;
jQuery(function ($) {
jQuery.ajax({
url: '{{ URL::to("/modal_show")}}',
headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

type: "POST",
data: '&products_id='+products_id,
success: function (res) {
  jQuery("#products-detail").html(res);
  jQuery('#myModal').modal('show');

},
});
});
});



  </script>

  <script>
@if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
  getQuantity();
  cartPrice();
@endif
</script>
 
</body>
</html>