@extends('admin.layout')
@section('content')
<style>
.hide-area{
   display: none;
}
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1> {{ trans('labels.AddVendor') }} <small>{{ trans('labels.AddNewVendors') }}...</small> </h1>
   <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li><a href="{{ URL::to('admin/vendors/display')}}"><i class="fa fa-users"></i> {{ trans('labels.ListingAllVendors') }}</a></li>
      <li class="active">{{ trans('labels.AddVendor') }}</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <!-- Info boxes -->
   <!-- /.row -->
   <div class="row">
      <div class="col-md-12">
         <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{ trans('labels.AddVendor') }} </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="box box-info">
                        <!--<div class="box-header with-border">
                           <h3 class="box-title">Edit category</h3>
                           </div>-->
                        <!-- /.box-header -->
                        <br>
                        @if (session('update'))
                        <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong> {{ session('update') }} </strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           {{$errors->first()}}
                        </div>
                        @endif
                        @endif
                        <div class="box-body">
                           {!! Form::open(array('url' =>'admin/vendors/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                           <div class="form-group">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.FirstName') }} </label>
                              <div class="col-sm-10 col-md-4">
                                 {!! Form::text('customers_firstname',  '', array('class'=>'form-control field-validate', 'id'=>'customers_firstname')) !!}
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.FirstNameText') }}</span>
                                 <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.LastName') }} </label>
                              <div class="col-sm-10 col-md-4">
                                 {!! Form::text('customers_lastname',  '', array('class'=>'form-control field-validate', 'id'=>'customers_lastname')) !!}
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.lastNameText') }}</span>
                                 <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Telephone') }}</label>
                              <div class="col-sm-10 col-md-4">
                                 {!! Form::text('customers_telephone',  '', array('class'=>'form-control phone-validate', 'id'=>'customers_telephone')) !!}
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                 {{ trans('labels.TelephoneText') }}</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.VendorShippingCharges') }}</label>
                              <div class="col-sm-10 col-md-4">
                                 {!! Form::number('shipping_charges',  '', array('class'=>'form-control', 'id'=>'shipping_charges')) !!}
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                 {{ trans('labels.EnterShippingCharges') }}</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.StoreName') }}</label>
                              <div class="col-sm-10 col-md-4">
                                 {!! Form::text('store_name',  '', array('class'=>'form-control', 'id'=>'store_name')) !!}
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                 {{ trans('labels.EnterUniqueStoreName') }}</span>
                              </div>
                           </div>
                           <div class="form-group" id="imageselected">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.VendorImage') }}</label>
                              <div class="col-sm-10 col-md-4">
                                 {{--{!! Form::file('newImage', array('id'=>'newImage')) !!}--}}
                                 <!-- Modal -->
                                 <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                             <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                          </div>
                                          <div class="modal-body manufacturer-image-embed">
                                             @if(isset($allimage))
                                             <select class="image-picker show-html field-validate" name="image_id" id="select_img">
                                                <option value=""></option>
                                                @foreach($allimage as $key=>$image)
                                                <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                @endforeach
                                             </select>
                                             @endif
                                          </div>
                                          <div class="modal-footer">
                                             <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                             <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                             <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="imageselected">
                                    {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                    <br>
                                    <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                    <div class="closimage">
                                       <button type="button" class="close pull-left image-close " id="image-close"
                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                 </div>
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.VendorImageText') }}</span>
                              </div>
                           </div>
                           <!-- vendor banner image -->
                           <div class="form-group" id="imageIcone">
                              <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.VendorBannerImage') }}</label>
                              <div class="col-sm-10 col-md-4">
                                 <!-- Modal -->
                                 <div class="modal fade" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                             <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                          </div>
                                          <div class="modal-body manufacturer-image-embed">
                                             @if(isset($allimage))
                                             <select class="image-picker show-html field-validate" name="vendor_image_id" id="select_img">
                                                <option value=""></option>
                                                @foreach($allimage as $key=>$image)
                                                <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                @endforeach
                                             </select>
                                             @endif
                                          </div>
                                          <div class="modal-footer">
                                             <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                             <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                             <button type="button" class="btn btn-primary" id="selectedICONE" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="imageselected">
                                    {!! Form::button(trans('labels.VendorBannerImage'), array('id'=>'newIcon','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )) !!}
                                    <br>
                                    <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5"> </div>
                                    <div class="closimage">
                                       <button type="button" class="close pull-left image-close " id="image-Icone"
                                          style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                 </div>
                                 <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.CategoryIconText') }}</span>
                              </div>
                           </div>
                           <!-- address -->
                           <input type="text" name="address" id="address-input" value="{{ old('address') }}"  class="required form-control map-input" />
                           <input type="hidden" name="address_latitude" id="address-latitude" value="{{old('address_latitude')}}" />
                           <input type="hidden" name="address_longitude" id="address-longitude" value="{{old('address_longitude')}}" />
                           <div id="address-map-container" style="width:100%;height:400px; ">
                              <div style="width: 100%; height: 100%" id="address-map"></div>
                              <!-- <div class="form-group">
                                 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Fax') }}</label>
                                 <div class="col-sm-10 col-md-4">
                                   {!! Form::text('customers_fax',  '', array('class'=>'form-control', 'id'=>'customers_fax')) !!}
                                   <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.FaxText') }}</span>
                                 </div>
                                 </div> -->
                              <hr>
                              <div class="form-group">
                                 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.EmailAddress') }} </label>
                                 <div class="col-sm-10 col-md-4">
                                    {!! Form::text('email',  '', array('class'=>'form-control email-validate', 'id'=>'email')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.EmailText') }}</span>
                                    <span class="help-block hidden"> {{ trans('labels.EmailError') }}</span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Password') }}</label>
                                 <div class="col-sm-10 col-md-4">
                                    {!! Form::password('password', array('class'=>'form-control field-validate', 'id'=>'password')) !!}
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.PasswordText') }}</span>
                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                 </div>
                              </div>
                              <div class="form-group hide-area">
                                 <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }} </label>
                                 <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="isActive">
                                       <!-- <option value="1">{{ trans('labels.Active') }}</option> -->
                                       <option value="0">{{ trans('labels.Inactive') }}</option>
                                    </select>
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    {{ trans('labels.StatusText') }}</span>
                                 </div>
                              </div>
                              <div class="box-footer text-center">
                                 <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                 <a href="{{ URL::to('admin/vendors/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                              </div>
                              {!! Form::close() !!}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <!-- /.row -->
</section>
<!-- /.content -->
</div>
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