@extends('web.layout')
@section('content')

		<section id="page-title">

			<div class="container clearfix">
				<h1>{{$result['category'][0]->categories_name}}</h1>
				<span>Products by our suppliers</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<!-- <li class="breadcrumb-item"><a href="#">Cat</a></li> -->
					<li class="breadcrumb-item active" aria-current="page">{{$result['category'][0]->categories_name}}</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
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

@foreach($result['products']['product_data'] as $key=>$f)
                <div class="col-12 col-lg-4 col-sm-6 griding">
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
@endforeach	

						

								

								

							</div><!-- #shop end -->

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								@if(!empty($result['categories'][0]))
								<div class="widget widget-filter-links">

									<h4>Select Category</h4>
									<ul class="custom-filter pl-2" data-container="#shop" data-active-class="active-filter">
										@foreach($result['categories']  as $key => $cat)
										
										<li class="">
											<a href="{{ url('/',$cat->categories_slug) }}">
											{{$cat->categories_name}}
											</a>
										</li>
										@endforeach
									</ul>

								</div>
								@endif

			<div class="range-slider-main" >
                 <h2>@lang('website.Price Range') </h2>
                 <form method="get" action="{{ url('/',$result['category'][0]->categories_slug) }}">
                 <div class="wrapper">
                     <div class="extra-controls form-inline">
                       <div class="form-group">
                           <span>
                             @if(session('symbol_left') != null)
                             <font>{{session('symbol_left')}}</font>
                             @else
                             <font>{{session('symbol_right')}}</font>
                             @endif
                                 <input type="text" name="min"  class="js-input-from form-control" value="{{ request('min') }}" />
                           </span>
                               <font>-</font>
                               <span>
                                   <input  type="text" name="max" class="js-input-to form-control" value="{{ request('max') }}" />
                                   </span>
                        </div>
                       </div>
                 </div>
                 <button type="submit" class="btn btn-warning">Filter</button>
                 </form>
            </div>

								<!-- <div class="widget widget-filter-links">

									<h4>Sort By</h4>
									<ul class="shop-sorting pl-2">
										<li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a></li>
										<li><a href="#" data-sort-by="name">Name</a></li>
										<li><a href="#" data-sort-by="price_lh">Price: Low to High</a></li>
										<li><a href="#" data-sort-by="price_hl">Price: High to Low</a></li>
									</ul>

								</div> -->

							</div>
						</div><!-- .sidebar end -->
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
@endsection