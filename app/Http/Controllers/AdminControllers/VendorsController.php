<?php
namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Customers;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Core\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Kyslik\ColumnSortable\Sortable;
use Auth;
use Illuminate\Support\Str;

class VendorsController extends Controller
{
    //
    public function __construct(Customers $customers, Setting $setting)
    {
        $this->Customers = $customers;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
    }

    public function display()
    {
        $title = array('pageTitle' => Lang::get("labels.ListingVendors"));
        $language_id = '1';
		
		$customers = DB::table('users')->where('role_id', 14)->get();	

        $result = array();
        $index = 0;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['result'] = $customers;
		
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.vendors.index", $title)->with('customers', $customerData)->with('result', $result);
    }

    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddVendor"));
        $images = new Images;
        $allimage = $images->getimages();
        $language_id = '1';
        $customerData = array();
        $message = array();
        $errorMessage = array();
        $customerData['countries'] = $this->Customers->countries();
        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.vendors.add", $title)->with('customers', $customerData)->with('allimage',$allimage)->with('result', $result);
    }


    //add addcustomers data and redirect to address
    public function insert(Request $request)
    {		
		    // dd( $request->all() );
        $language_id = '1';
        //get function from other controller
        $images = new Images;
        $allimage = $images->getimages();

        $customerData = array();
        $message = array();
        $errorMessage = array();

        //check email already exists
        $existEmail = $this->Customers->email($request);
        $this->validate($request, [
            'customers_firstname' => 'required',
            'customers_lastname' => 'required',
            'customers_telephone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'isActive' => 'required',
        ]);


        if (count($existEmail)> 0 ) {
            $messages = Lang::get("labels.Email address already exist");
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        } else {
            $customers_id = $this->Customers->insertVendor($request, $request->image_id, $request->vendor_image_id);
			
			if( $request->address != NULL){
			
				DB::table('vendor_details')->where('vendor_id','=', $customers_id)->update([
				  'location'				=>   $request->address,
				  'latitude'		=>   $request->address_latitude,
				  'longitude'		=>   $request->address_longitude
				]);
			
			}
			
			if( $request->shipping_charges != NULL){
				
				DB::table('vendor_details')->where('vendor_id','=', $customers_id)->update([
				  'shipping_charges'		=>   $request->shipping_charges
				]);
				
			}
			
            return redirect('admin/vendors/address/display/' . $customers_id)->with('update', 'Vendor has been created successfully!');
        }
    }

    public function diplayaddress(Request $request){

        $title = array('pageTitle' => Lang::get("labels.AddAddress"));

        $language_id   				=   $request->language_id;
        $id            				=   $request->id;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customer_addresses = $this->Customers->addresses($id);
        $countries = $this->Customers->country();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['customer_addresses'] = $customer_addresses;
        $customerData['countries'] = $countries;
        $customerData['user_id'] = $id;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.vendors.address.index",$title)->with('data', $customerData)->with('result', $result);
    }


    //add Customer address
    public function addcustomeraddress(Request $request){	  
      $customer_addresses = $this->Customers->addcustomeraddress($request);
      return $customer_addresses;
    }

    public function editaddress(Request $request){

      $user_id                 =   $request->user_id;
      $address_book_id         =   $request->address_book_id;

      $customer_addresses = $this->Customers->addressBook($address_book_id);
	  
	  $vendor_detail = DB::table('vendor_details')->select('id', 'store_name')->where('vendor_id', $user_id)->get();
	  if(!$vendor_detail->isEmpty()){
		  $vendor_detail = $vendor_detail ;
	  }else{
		  $vendor_detail = "";
	  }
	
      $countries = $this->Customers->countries();;
      $zones = $this->Customers->zones($customer_addresses);
      $customers = $this->Customers->checkdefualtaddress($address_book_id);

      $customerData['user_id'] = $user_id;
      $customerData['customer_addresses'] = $customer_addresses;
      $customerData['countries'] = $countries;
      $customerData['zones'] = $zones;
      $customerData['vendor_detail'] = $vendor_detail;
      $customerData['customers'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin/vendors/address/editaddress")->with('data', $customerData)->with('result', $result);
    }

    //update Customers address
    public function updateaddress(Request $request){
      $customer_addresses = $this->Customers->updateaddress($request);
      return ($customer_addresses);
    }

    public function deleteAddress(Request $request){
      $customer_addresses = $this->Customers->deleteAddresses($request);
      return redirect()->back()->withErrors([Lang::get("labels.Delete Address Text")]);
    }

    //editcustomers data and redirect to address
    public function edit(Request $request){

      $images           = new Images;
      $allimage         = $images->getimages();
      $title            = array('pageTitle' => Lang::get("labels.EditCustomer"));
      $language_id      =   '1';
      $id               =   $request->id;

      $customerData = array();
      $message = array();
      $errorMessage = array();
      $customers = $this->Customers->edit($id);
	  
	  $vendor_details = DB::table('vendor_details')->where('vendor_id','=', $id)->first();
	  
	  // get vendor image 
	  if(!empty($vendor_details)){
		  if(!empty($vendor_details->vendor_logo)){
			  $image_id = $vendor_details->vendor_logo ;
			  $vendor_image = DB::table('image_categories')->where('image_id','=', $image_id)->first();
		  }else{
			  $image_id = 0 ;
			  $vendor_image = NULL;
		  }
		  
	  }else{
		  $vendor_image = NULL;
	  }
	  
	  // get vendor banner image
	  if(!empty($vendor_details)){
		  if(!empty($vendor_details->vendor_banner_image)){
			  $image_id = $vendor_details->vendor_banner_image ;
			  $banner_vendor_image = DB::table('image_categories')->where('image_id','=', $image_id)->first();
		  }else{
			  $image_id = 0 ;
			  $banner_vendor_image = NULL;
		  }
		  
	  }else{
		  $banner_vendor_image = NULL;
	  }
	  
	  if(!empty($vendor_details)){
		  $vendor_details = $vendor_details ;
	  }else{
		  $vendor_details = "";
	  }
	  
	  if(!empty($vendor_banner_details)){
		  $vendor_banner_details = $vendor_banner_details ;
	  }else{
		  $vendor_banner_details = "";
	  }

      $customerData['message'] = $message;
      $customerData['errorMessage'] = $errorMessage;
      $customerData['countries'] = $this->Customers->countries();
      $customerData['customers'] = $customers;
      $customerData['vendor_image'] = $vendor_image;
      $customerData['vendor_details'] = $vendor_details;
      $customerData['banner_vendor_image'] = $banner_vendor_image;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin.vendors.edit",$title)->with('data', $customerData)->with('result', $result)->with('allimage', $allimage);
    }

    //add addcustomers data and redirect to address
    public function update(Request $request){
		
        $language_id  =   '1';
        $user_id				  =	$request->customers_id;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        //get function from other controller
        if($request->image_id!==null){
            $customers_picture = $request->image_id;
        }	else{
            $customers_picture = $request->oldImage;
        }

        if($request->image_id){
            $uploadImage = $request->image_id;
            $uploadImage = DB::table('image_categories')->where('image_id',$uploadImage)->select('path')->first();
            $customers_picture = $uploadImage->path;
        }	else{
            $customers_picture = $request->oldImage;
        }		
		
		if( $request->store_name){
			$checkStoreName = DB::table('vendor_details')->where('id','!=', $request->record_id)->where('store_name', '=', $request->store_name)->get();
			if($checkStoreName->count() > 0){
				return redirect()->back()->withErrors([Lang::get("labels.checkVendorStoreName")]);
			}
			
			$checkVendorEntry = DB::table('vendor_details')->where('vendor_id', '=', $request->vendor_id)->get();
			$slug = Str::slug($request->store_name, '-');
			if($checkVendorEntry->count() > 0){
				$vendor_store_data = array(
					'store_name' => $request->store_name, 
					'store_slug' => $slug,
				);
				DB::table('vendor_details')->where('vendor_id', '=', $request->vendor_id)->update($vendor_store_data);
        DB::table('users')->where('id', $request->vendor_id)->update(['user_name' => $slug]);
			}else{
				
				$vendor_store_data = array(
					'vendor_id' => Auth::id(), 
					'store_name' => $request->store_name, 
					'store_slug' => $slug,
				);
				DB::table('vendor_details')->insert($vendor_store_data);
			}
		
		}
		
        $user_data = array(
            'gender'   		 	=>   $request->gender,
            'first_name'		=>   $request->first_name,
            'last_name'		 	=>   $request->last_name,
            'dob'	 			=>	 $request->dob,
            'phone'	 	        =>	 $request->phone,
            'status'		    =>   $request->status,
            'avatar'	 		  =>	 $customers_picture,
            'updated_at'    => date('Y-m-d H:i:s'),
        );
        $customer_data = array(
          'customers_newsletter'   		 	=>   0,
          'updated_at'    => date('Y-m-d H:i:s'),
        );

        if($request->changePassword == 'yes'){
            $user_data['password'] = Hash::make($request->password);
        }

        $this->Customers->updaterecord($customer_data,$user_id,$user_data);
		
		if($request->image_id != NULL){
			$vendor_logo_image = array(
				'vendor_logo' => $request->image_id
			);
			DB::table('vendor_details')->where('vendor_id', '=', $request->vendor_id)->update($vendor_logo_image);
		}
		
		// for vendor banner image
		if($request->vendor_image_id != NULL){
			$vendor_banner_image = array(
				'vendor_banner_image' => $request->vendor_image_id
			);
			DB::table('vendor_details')->where('vendor_id', '=', $request->vendor_id)->update($vendor_banner_image);
		}
		
		// for google address 
		if($request->address != NULL){
			$google_address_array = array(
				'location' => $request->address,
				'latitude' => $request->address_latitude,
				'longitude' => $request->address_longitude
				
			);
			DB::table('vendor_details')->where('vendor_id', '=', $request->vendor_id)->update($google_address_array);
		}
		
		if( $request->shipping_charges != NULL){
				
			DB::table('vendor_details')->where('vendor_id','=', $request->vendor_id)->update([
			  'shipping_charges'		=>   $request->shipping_charges
			]);
			
		}
		
		
        return redirect('admin/vendors/address/display/'.$user_id)->with('update', 'Vendor has been updated successfully!');
        
    }

    public function delete(Request $request){
      $this->Customers->destroyrecord($request->users_id);
      return redirect()->back()->withErrors([Lang::get("labels.DeleteVendorMessageSuccess")]);
    }

    public function filter(Request $request){
      $filter    = $request->FilterBy;
      $parameter = $request->parameter;

      $title = array('pageTitle' => Lang::get("labels.ListingCustomers"));
      $customers  = $this->Customers->filter($request);

      $result = array();
      $index = 0;
      foreach($customers as $customers_data){
          array_push($result, $customers_data);

          $devices = DB::table('devices')->where('user_id','=',$customers_data->id)->orderBy('created_at','DESC')->take(1)->get();
          $result[$index]->devices = $devices;
          $index++;
      }

      $customerData = array();
      $message = array();
      $errorMessage = array();

      $customerData['message'] = $message;
      $customerData['errorMessage'] = $errorMessage;
      $customerData['result'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin.customers.index",$title)->with('result', $result)->with('customers', $customerData)->with('filter',$filter)->with('parameter',$parameter);
    }
}
