@if($result['featured']['success'] == 1)
<!-- New Arrivals Men
============================================= -->
<div class="container clearfix">

<h2 class="titular-title font-weight-bold center ">@lang('website.Top Selling of the Week')</h2>
<p class="titular-sub-title center mb-5">@lang('website.Top Sellings Of the Week Detail')</p>
</div>

<div class="row grid-6">
@foreach($result['featured']['product_data'] as $f)
<!-- Shop Item 
============================================= -->

<div class="col-lg-2 col-md-3 col-6 px-2">
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


</div>

</div>

@endif 
 

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

<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" >
  
    <div class="modal-dialog modal-lg" role="document" id="products-detail" style="background: #fff">
     
    </div>
</div> -->


 


