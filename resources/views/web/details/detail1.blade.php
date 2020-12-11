<!-- Content
    ============================================= -->
    <section id="content">
      <div class="content-wrap">
        <div class="container clearfix">

          <div class="single-product">
            <div class="product">
              <div class="row gutter-40">

                <div class="col-md-6">

                  <!-- Product Single - Gallery
                  ============================================= -->
                  <!-- <div class="product-image">
                    <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                      <div class="flexslider">
                        <div class="slider-wrap" data-lightbox="gallery">
                           @if(!empty($result['detail']['product_data'][0]->products_video_link))
                            <a class="slider-for__item ex1 fancybox-button iframe">
                              {!! $result['detail']['product_data'][0]->products_video_link !!}                 
                            </a>
                            @endif

                            <a class="slider-for__item ex1 fancybox-button" href="{{asset('').$result['detail']['product_data'][0]->default_images }}" data-fancybox-group="fancybox-button">
                              <img src="{{asset('').$result['detail']['product_data'][0]->default_images }}" alt="Zoom Image" />
                            </a>
                             @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                              @if($images->image_type == 'LARGE')
                                   <div class="slide" data-thumb="{{asset('').$images->image_path }}"><a href="{{asset('').$images->image_path }}" title="Front View" data-lightbox="gallery-item"><img src="{{asset('').$images->image_path }}" alt=""></a></div>
                              @elseif($images->image_type == 'ACTUAL')
                                   <div class="slide" data-thumb="{{asset('').$images->image_path }}"><a href="{{asset('').$images->image_path }}" title="Front View" data-lightbox="gallery-item"><img src="{{asset('').$images->image_path }}" alt=""></a></div>
                              @endif
                             @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="sale-flash badge badge-danger p-2">Sale!</div>
                  </div> --><!-- Product Single - Gallery End -->

            <div class="slider-wrapper pd2">
              <div class="slider-for">
                @if(!empty($result['detail']['product_data'][0]->products_video_link))
                <a class="slider-for__item ex1 fancybox-button iframe">
                  {!! $result['detail']['product_data'][0]->products_video_link !!}                 
                </a>
                @endif

                <a class="slider-for__item ex1 fancybox-button" href="{{asset('').$result['detail']['product_data'][0]->default_images }}" data-fancybox-group="fancybox-button">
                  <img src="{{asset('').$result['detail']['product_data'][0]->default_images }}" alt="Zoom Image" />
                </a>
            
                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                  @if($images->image_type == 'LARGE')

                  <a class="slider-for__item ex1 fancybox-button" href="{{asset('').$images->image_path }}" data-fancybox-group="fancybox-button" >
                    <img src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                  </a>
                  
                  @elseif($images->image_type == 'ACTUAL')
                  <a class="slider-for__item ex1 fancybox-button" href="{{asset('').$images->image_path }}" data-fancybox-group="fancybox-button">
                    <img src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                  </a>
                  @endif
                @endforeach
              </div>
            
              <div class="slider-nav">
                @if(!empty($result['detail']['product_data'][0]->products_video_link))
                <div class="slider-nav__item">
                  <img src="{{asset('web/images/miscellaneous/video-thumbnail.jpg')}}" alt="Zoom Image"/>
                </div>
                @endif
                <div class="slider-nav__item">
                  <img src="{{asset('').$result['detail']['product_data'][0]->default_thumb }}" alt="Zoom Image"/>
                </div>
            
                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                  @if($images->image_type == 'THUMBNAIL')
                    <div class="slider-nav__item">
                      <img src="{{asset('').$images->image_path }}" alt="Zoom Image"/>
                    </div>
                  @elseif($images->image_type == 'MEDIUM')
                  <!-- <div class="slider-nav__item">
                    <img src="{{asset('').$images->image_path }}" alt="Zoom Image"/>
                  </div> -->
                  @elseif($images->image_type == 'LARGE')
                <!--   <div class="slider-nav__item">
                    <img src="{{asset('').$images->image_path }}" alt="Zoom Image"/>
                  </div> -->
                  @elseif($images->image_type == 'ACTUAL')
                  <!-- <div class="slider-nav__item">
                    <img src="{{asset('').$images->image_path }}" alt="Zoom Image"/>
                  </div> -->
                  @endif
                @endforeach
                
              </div>
            </div>

                </div>

                <div class="col-md-6 product-desc">
                  <div>

                     @php
                    $user_id = $result['detail']['product_data'][0]->user_id ; 
                    $tmp = \App\User::find($user_id);
                    
                    @endphp
                    
                    <h1>{{$result['detail']['product_data'][0]->products_name}}</h1>
                    <span class="posted_in">Seller: <a href="{{ route('store',$tmp->user_name)}}" rel="tag">{{ $result['vendor'][0]->first_name }} {{ $result['vendor'][0]->last_name }}</a>.</span>
                    
                  </div>

                  <div class="d-flex align-items-center justify-content-between">
                    

                   




                    <?php

            if(!empty($result['detail']['product_data'][0]->discount_price)){
              $discount_price = $result['detail']['product_data'][0]->discount_price * session('currency_value');
            }
            if(!empty($result['detail']['product_data'][0]->flash_price)){
              $flash_price = $result['detail']['product_data'][0]->flash_price * session('currency_value');
            }
              $orignal_price = $result['detail']['product_data'][0]->products_price * session('currency_value');


             if(!empty($result['detail']['product_data'][0]->discount_price)){

              if(($orignal_price+0)>0){
                $discounted_price = $orignal_price-$discount_price;
                $discount_percentage = $discounted_price/$orignal_price*100;
                $discounted_price = $result['detail']['product_data'][0]->discount_price;

             }else{
               $discount_percentage = 0;
               $discounted_price = 0;
             }
            }
            else{
              $discounted_price = $orignal_price;
            }
            ?>
            @if(!empty($result['detail']['product_data'][0]->flash_price))
            <sub class="total_price product-price">{{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}</sub>
            <span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
            @elseif(!empty($result['detail']['product_data'][0]->discount_price))
            <price class="total_price product-price">{{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}</price>
            <span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}} </span> 
            @else
            <price class="total_price product-price">{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</price>
            @endif



       <!-- Product Single - Price
              ============================================= -->
             <!--  <div class="product-price">
                <del>SAR 39.99</del>
                 <ins>SAR 24.99</ins>
              </div> --><!-- Product Single - Price End -->




                   
           

                    <!-- Product Single - Rating
                    ============================================= -->
                    <div class="d-flex align-items-center">
                      <div class="product-rating">
                       <fieldset class="disabled-ratings">                                           
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>                                          
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 3) active @endif" for="star_3" title="@lang('website.pretty_good_3_stars')"></label>                                          
                <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 2) active @endif" for="star_2" title="@lang('website.meh_2_stars')"></label>
                 <label class = "full fa @if($result['detail']['product_data'][0]->rating >= 1) active @endif" for="star1" title="@lang('website.meh_1_stars')"></label>
              </fieldset>                                          
              <a href="#review" id="review-tabs" data-toggle="pill" role="tab" class="btn-link">{{$result['detail']['product_data'][0]->total_user_rated}} @lang('website.Reviews') </a>
                      </div>
                      <!-- Product Single - Rating End -->
                      <!-- <button type="button" class="btn btn-sm btn-secondary ml-3"><i class="icon-heart"></i></button> -->

                       <button class="btn  is_liked btn btn-sm btn-secondary ml-3" products_id="<?=$result['detail']['product_data'][0]->products_id?>"><i class="icon-heart"></i>  </button>
                    </div>

                  </div>

                  <div class="line"></div>












                  <form name="attributes" id="add-Product-form" method="post" >
      <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">

      <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

      <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >

      <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif" >
       @if(!empty($result['cart']))
        <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
       @endif


    @if(count($result['detail']['product_data'][0]->attributes)>0)
    <?php
        $index = 0;
    ?>
      @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
      <?php
          $functionValue = 'function_'.$key++;
      ?>
      <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
      <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
      <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
      <input id="attributeid_<?=$index?>" type="hidden" value="">
      <input id="attribute_sign_<?=$index?>" type="hidden" value="">
      <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
      <div class="pro-options">
            <div class="box mb-3">
              <label>{{ $attributes_data['option']['name'] }}</label>
              <div class="select-control ">
              <select name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}">
                @if(!empty($result['cart']))
                  @php
                   $value_ids = array();
                    foreach($result['cart'][0]->attributes as $values){
                        $value_ids[] = $values->options_values_id;
                    }
                  @endphp
                    @foreach($attributes_data['values'] as $values_data)
                     @if(!empty($result['cart']))
                     <option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                     @endif
                    @endforeach
                  @else
                    @foreach($attributes_data['values'] as $values_data)
                     <option attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>                  
      </div>
      @endforeach
    @endif
  

  
    
    <div class="pro-counter" @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date ) style="display: none" @endif>
        <div class="input-group item-quantity">                    
            {{-- <input type="text" id="quantity1" name="quantity" class="form-control" value="10">                       --}}
            <input type="text" readonly name="quantity" class="form-control qty" value="@if(!empty($result['cart'])) {{$result['cart'][0]->customers_basket_quantity}} @else @if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif @endif" min="@if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order) {{$result['detail']['product_data'][0]->products_min_order}} @else 1 @endif" max="@if(!empty($result['detail']['product_data'][0]->products_max_stock) and $result['detail']['product_data'][0]->products_max_stock>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_max_stock){{ $result['detail']['product_data'][0]->products_max_stock}}@else{{ $result['detail']['product_data'][0]->defaultStock}}@endif">              
            <span class="input-group-btn">
                <button type="button" class="quantity-plus1 btn qtyplus">
                    <i class="fas fa-plus"></i>
                </button>
            
                <button type="button" class="quantity-minus1 btn qtyminus">
                    <i class="fas fa-minus"></i>
                </button>
            </span>
          </div>
          
          @if(!empty($result['detail']['product_data'][0]->flash_start_date) and $result['detail']['product_data'][0]->server_time < $result['detail']['product_data'][0]->flash_start_date )
            @else
              @if($result['detail']['product_data'][0]->products_type == 0)
                  @if($result['detail']['product_data'][0]->defaultStock == 0) 
                    <button class="btn btn-lg swipe-to-top  btn-danger " type="button">@lang('website.Out of Stock')</button>
                  @else
                      <button class="btn btn-secondary btn-lg swipe-to-top add-to-Cart"  type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>

                  @endif
              @else

                    <button class="btn btn-secondary btn-lg swipe-to-top  add-to-Cart stock-cart" hidden type="button" products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                    <button class="btn btn-danger btn btn-lg swipe-to-top  stock-out-cart" hidden type="button">@lang('website.Out of Stock')</button>
              @endif
            @endif
            @if($result['detail']['product_data'][0]->products_type == 2)
            <a href="{{$result['detail']['product_data'][0]->products_url}}" target="_blank" class="btn btn-secondary btn-lg swipe-to-top">@lang('website.External Link')</a>
          @endif
  
    </div>

    
  </form>



                  <!-- Product Single - Quantity & Cart Button
                  ============================================= -->
                 <!--  <form class="cart mb-0 d-flex justify-content-between align-items-center" method="post" enctype='multipart/form-data'>
                    <div class="quantity clearfix">
                      <input type="button" value="-" class="minus">
                      <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="qty" />
                      <input type="button" value="+" class="plus">
                    </div>
                    <button type="submit" class="add-to-cart button m-0">Add to cart</button>
                  </form> --><!-- Product Single - Quantity & Cart Button End -->

              


                <!--   <div class="row align-items-center">
                    

                    <div class="col-sm-6">
                      <h5 class="font-weight-medium mb-3">Select Size:</h5>
                      <div class="btn-group-toggle" data-toggle="buttons">
                        <label for="bag-size-s" class="btn btn-sm btn-outline-secondary font-weight-normal active ls0 nott">
                        <input type="radio" name="bag-size" id="bag-size-s" checked autocomplete="off" value="S"> S
                      </label>
                      <label for="bag-size-m" class="btn btn-sm btn-outline-secondary font-weight-normal ls0 nott">
                        <input type="radio" name="bag-size" id="bag-size-m" autocomplete="off" value="M"> M
                      </label>
                      <label for="bag-size-l" class="btn btn-sm btn-outline-secondary font-weight-normal ls0 nott">
                        <input type="radio" name="bag-size" id="bag-size-l" autocomplete="off" value="L"> L
                      </label>
                      <label for="bag-size-xl" class="btn btn-sm btn-outline-secondary font-weight-normal ls0 nott disabled" disabled="disabled">
                        <input type="radio" name="bag-size" id="bag-size-xl" autocomplete="off" value="XL"> <del>XL</del>
                      </label>
                      </div>
                    </div>
                  </div> -->

              

                  <!-- Product Single - Short Description
                  ============================================= -->
                 <!--  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero velit id eaque ex quae laboriosam nulla optio doloribus! Perspiciatis, libero, neque, perferendis at nisi optio dolor! Perspiciatis ad eveniet ea quasi debitis quos laborum eum reprehenderit eaque explicabo assumenda rem modi.</p>
                  <ul class="iconlist">
                    <li><i class="icon-caret-right"></i> Dynamic Color Options</li>
                    <li><i class="icon-caret-right"></i> Lots of Size Options</li>
                    <li><i class="icon-caret-right"></i> 30-Day Return Policy</li>
                  </ul> --><!-- Product Single - Short Description End -->


                  
                <!-- AddToAny END -->
                  
                  <!-- Product Single - Share
                  ============================================= -->
                  <div class="si-share d-flex justify-content-between align-items-center mt-4">
                    <span>Share:</span>
                    <div>
                     <!-- AddToAny BEGIN -->
                      <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_email"></a>
                      </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                    </div>
                  </div><!-- Product Single - Share End -->
                  
                  <!-- Product Single - Meta
                  ============================================= -->
                <!--   <div class="card product-meta">
                    <div class="card-body">
                      <span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">8465415</span></span>
                      <span class="posted_in">Seller: <a href="#" rel="tag">ABC Pets Est.</a>.</span>
                      
                    </div>
                  </div> --><!-- Product Single - Meta End -->


                </div>

                <div class="w-100"></div>

                <div class="col-12 mt-5">

                  <div class="tabs clearfix mb-0" id="tab-1">

                    <ul class="tab-nav clearfix">
                      <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="d-none d-md-inline-block"> @lang('website.Descriptions')</span></a></li>
                    <!--   <li><a href="#tabs-2"><i class="icon-info-sign"></i><span class="d-none d-md-inline-block"> Additional Information</span></a></li> -->
                      <li><a href="#tabs-3"><i class="icon-star3"></i><span class="d-none d-md-inline-block"> @lang('website.Reviews') (2)</span></a></li>
                    </ul>

                    <div class="tab-container">

                      <div class="tab-content clearfix" id="tabs-1">
                       <?=stripslashes($result['detail']['product_data'][0]->products_description)?>
                      </div>
                    <!--   <div class="tab-content clearfix" id="tabs-2">

                        <table class="table table-striped table-bordered">
                          <tbody>
                            <tr>
                              <td>Size</td>
                              <td>Small, Medium &amp; Large</td>
                            </tr>
                            <tr>
                              <td>Color</td>
                              <td>Pink &amp; White</td>
                            </tr>
                            <tr>
                              <td>Waist</td>
                              <td>26 cm</td>
                            </tr>
                            <tr>
                              <td>Length</td>
                              <td>40 cm</td>
                            </tr>
                            <tr>
                              <td>Chest</td>
                              <td>33 inches</td>
                            </tr>
                            <tr>
                              <td>Fabric</td>
                              <td>Cotton, Silk &amp; Synthetic</td>
                            </tr>
                            <tr>
                              <td>Warranty</td>
                              <td>3 Months</td>
                            </tr>
                          </tbody>
                        </table>

                      </div> -->
                      <div class="tab-content clearfix" id="tabs-3">

                       <div class="reviews">
                      @if(isset($result['detail']['product_data'][0]->reviewed_customers))
                        <div class="review-bubbles">
                            <h2>
                              @lang('website.Customer Reviews')
                            </h2>                            
                              @foreach($result['detail']['product_data'][0]->reviewed_customers as $key=>$rev)
                              <div class="review-bubble-single">
                                  <div class="review-bubble-bg">
                                      <div class="pro-rating">
                                        <fieldset class="disabled-ratings">                                           
                                          <label class = "full fa @if($rev->reviews_rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
                                          <label class = "full fa @if($rev->reviews_rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>                                          
                                          <label class = "full fa @if($rev->reviews_rating >= 3) active @endif" for="star_3" title="@lang('website.pretty_good_3_stars')"></label>                                          
                                          <label class = "full fa @if($rev->reviews_rating >= 2) active @endif" for="star_2" title="@lang('website.meh_2_stars')"></label>
                                           <label class = "full fa @if($rev->reviews_rating >= 1) active @endif" for="star1" title="@lang('website.meh_1_stars')"></label>
                                        </fieldset>                                          
                                      </div>
                                      <h4>{{$rev->customers_name}}</h4>
                                      <span>{{date("d-M-Y", strtotime($rev->created_at))}}</span>
                                      <p>{{$rev->reviews_text}}</p>
                                  </div>
                                  
                              </div>
                              @endforeach                            
                        </div>
                        @endif
                        @if(Auth::guard('customer')->check())
                        <div class="write-review">
                          <form id="idForm">
                            {{csrf_field()}}
                            <input value="{{$result['detail']['product_data'][0]->products_id}}" type="hidden" name="products_id">
                          <h2>@lang('website.Write a Review')</h2>
                          <div class="write-review-box">
                              <div class="from-group row mb-3">
                                  <div class="col-12"> <label for="inlineFormInputGroup2">@lang('website.Rating')</label></div>
                                  <div class="pro-rating col-12">

                                    <fieldset class="ratings">
                                      
                                      <input type="radio" id="star5" name="rating" value="5" class="rating"/>
                                      <label class = "full fa" for="star5" title="@lang('website.awesome_5_stars')"></label>

                                      <input type="radio" id="star4" name="rating" value="4" class="rating"/>
                                      <label class="full fa" for="star4" title="@lang('website.pretty_good_4_stars')"></label>

                                      <input type="radio" id="star3" name="rating" value="3" class="rating"/>
                                      <label class = "full fa" for="star3" title="@lang('website.pretty_good_3_stars')"></label>

                                      <input type="radio" id="star2" name="rating" value="2" class="rating"/>
                                      <label class="full fa" for="star2" title="@lang('website.meh_2_stars')"></label>

                                      <input type="radio" id="star1" name="rating" value="1" class="rating"/>
                                      <label class = "full fa" for="star1" title="@lang('website.meh_1_stars')"></label> 
                                    
                                  </fieldset>                                     
                                      
                                  </div>
                              </div>                              
                             
                                <div class="from-group row mb-3">
                                    <div class="col-12"> <label for="inlineFormInputGroup3">@lang('website.Review')</label></div>
                                    <div class="input-group col-12">                                      
                                      <textarea name="reviews_text" id="reviews_text" class="form-control" id="inlineFormInputGroup3" placeholder="@lang('website.Write Your Review')"></textarea>
                                    </div>
                                </div>

                                <div class="alert alert-danger" hidden id="review-error" role="alert">
                                 @lang('website.Please enter your review')
                                </div>

                                <div class="from-group">
                                    <button type="submit" id="review_button" disabled class="btn btn-secondary swipe-to-top">@lang('website.Submit')</button>                                    
                                </div>
                          </div>
                          
                        </form>
                        </div>
                        @endif
                    </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>
            </div>
          </div>

          <div class="line"></div>

          <div class="w-100">

            <h4>@lang('website.Related Products')</h4>

            <div class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">

               @foreach($result['simliar_products']['product_data'] as $key=>$f)
                @if($result['detail']['product_data'][0]->products_id != $f->products_id)                     
                <div class="slik">
                  
<!-- Shop Item 
============================================= -->

<div class="col-lg-12 col-md-3 col-6 px-2">
<div class="product">
<div class="product-image">
<a href="{{ URL::to('/product-detail/'.$f->products_slug)}}"><img src="{{asset('').$f->image_path}}" alt="{{$f->products_name}}"></a>


<!-- <div class="sale-flash badge badge-danger p-2"> -->
<?php 
$current_date = date("Y-m-d", strtotime("now"));

$string = substr($f->products_date_added, 0, strpos($f->products_date_added, ' '));
$date=date_create($string);
date_add($date,date_interval_create_from_date_string($result['commonContent']['settings']['new_product_duration']." days"));
$after_date = date_format($date,"Y-m-d");
if($after_date>=$current_date){
print '<span class="sale-flash badge badge-danger p-2">';
print __('website.New');
print '</span>';
}
?> 
<?php
if(!empty($f->discount_price)){
$discount_price = $f->discount_price * session('currency_value');
}
$orignal_price = $f->products_price * session('currency_value');

if(!empty($f->discount_price)){

if(($orignal_price+0)>0){
$discounted_price = $orignal_price-$discount_price;
$discount_percentage = $discounted_price/$orignal_price*100;
}else{
$discount_percentage = 0;
$discounted_price = 0;
}
?>

<span class="badge badge-danger"  data-toggle="tooltip" data-placement="bottom" title="<?php echo (int)$discount_percentage; ?>% @lang('website.off')"><?php echo (int)$discount_percentage; ?>%</span>
<?php }?>


@if($f->is_feature == 1)
<span class="sale-flash badge badge-warning p-2">@lang('website.Featured')</span>                                            

@endif
<!-- </div> -->

   



<div class="bg-overlay">
<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">


<a class="icon active swipe-to-top is_liked  btn btn-dark" products_id="<?=$f->products_id?>" data-toggle="tooltip" data-placement="bottom" title="@lang('website.Wishlist')">
  <i class="icon-heart"></i>
</a>



<!-- <a href="{{ URL::to('/modal_show')}}" class="btn btn-dark icon swipe-to-top modal_show " data-lightbox="ajax">
  <i class="icon-line-expand"></i>
</a> -->
  <div class="icon modal_show btn btn-dark" products_id ="{{$f->products_id}}">
     <i class="icon-line-expand"></i>
  </div>


</div>
<div class="bg-overlay-bg bg-transparent"></div>
</div>
</div>
<div class="product-desc">
<div class="product-title mb-1"><h3><a href="{{ URL::to('/product-detail/'.$f->products_slug)}}">{{$f->products_name}}</a></h3></div>
<div class="product-price font-primary">
<!-- <del class="mr-1">SAR 24.99</del>
<ins>SAR 12.49</ins> -->
@if(!empty($f->discount_price))
{{Session::get('symbol_left')}}&nbsp;{{$discount_price+0}}&nbsp;{{Session::get('symbol_right')}}
<span> {{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}
</span>
@else
<ins>{{Session::get('symbol_left')}}&nbsp;{{$orignal_price+0}}&nbsp;{{Session::get('symbol_right')}}</ins>
@endif    
</div>
<div class="product-rating">

<fieldset class="disabled-ratings">                                           
    <label class = "full fa @if($f->rating >= 5) active @endif" for="star_5" title="@lang('website.awesome_5_stars')"></label>
    <label class = "full fa @if($f->rating >= 4) active @endif" for="star_4" title="@lang('website.pretty_good_4_stars')"></label>                                          
    <label class = "full fa @if($f->rating >= 3) active @endif" for="star_3" title="@lang('website.pretty_good_3_stars')"></label>                                          
    <label class = "full fa @if($f->rating >= 2) active @endif" for="star_2" title="@lang('website.meh_2_stars')"></label>
     <label class = "full fa @if($f->rating >= 1) active @endif" for="star1" title="@lang('website.meh_1_stars')"></label>
  </fieldset>          
</div>
</div>
</div>
</div>




                </div>  
                @endif
                @endforeach  

            </div>

          </div>

        </div>
      </div>
    </section><!-- #content end -->
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

