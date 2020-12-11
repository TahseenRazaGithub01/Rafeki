<?php
namespace App\Http\Controllers\Web;

//validator is builtin class in laravel
use App\Models\Web\Currency;
use App\Models\Web\Index;
//for password encryption or hash protected
use App\Models\Web\Languages;

//for authenitcate login data
use App\Models\Web\Products;
use Auth;

//for requesting a value
use DB;
//for Carbon a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Session;
use App\Models\Core\User;
//email

class ProductsController extends Controller
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->theme = new ThemeController();
    }

    public function category($category_slug, Request $request)
    {
        // return $request->all();
         $min = '';
         $max = '';
        if ($request->get('min') > 0) {
            $min = $request->get('min');
        }
        if ($request->get('max') > 0) {
            $max = $request->get('max');
        }
       
        $title = array('pageTitle' => 'sadsad');
        $result = array();

        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;

         if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }
        //category
         $result['category'] = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->where('categories_slug', $category_slug)
        // ->where('categories.categories_status', 1)
        ->where('language_id', Session::get('language_id'))->get();
         $filters = array();
       
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $this->products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode($options, ',');
            $filters['option_value'] = implode($option_values, ',');

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result['filter_attribute']['options'] = $options;
            $result['filter_attribute']['option_values'] = $option_values;
        
        // dd($result['category']);
       

        $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $result['category'][0]->categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min, 'max_price' => $max);

        $result['categories'] = DB::table('categories')->leftJoin('categories_description', 
            'categories_description.categories_id', '=', 'categories.categories_id');

         if ($result['category'][0]->parent_id == 0) {
          $result['categories'] =   $result['categories']->where('categories.parent_id', $result['category'][0]->categories_id);
        }
        else{
           $result['categories'] =   $result['categories']->where('categories.parent_id', $result['category'][0]->categories_id);
        }
       
      $result['categories'] =  $result['categories']->where('language_id', Session::get('language_id'))->get();
        // return $categories;

        $products = $this->products->products($data);        
        $result['products'] = $products;
        $result['filters'] = $filters;
        $result['min_price'] = $min_price;
        $result['max_price'] = $max_price;

        //search value
    

       
       
        // return $result['filters'];
       
       
       return view('web.rafeki-category.category', ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }


// vendor category Web/ProductController.php line no 166
     public function supplierProduct($category_slug, Request $request)
    {
        // return $request->all(); 
        // return ;
        if($request->ajax()){
            
            $i = 0 ;
            $arr = array();

            $one = array();

            foreach($request->category_slug as $cat_slug){

                $one[] = $cat_slug['value'] ;

                $i++;

            }



            $vendor_name =  $request['vendor_name'];

            $vendor_id = DB::table('users')->select('id')->where('user_name', $request['vendor_name'])->pluck('id');
         

        }else{

            $urlArray = explode("/",$request->fullUrl());
            $vendor_name = $urlArray[4];
            $vendor_id = DB::table('users')->select('id')->where('user_name', $category_slug)->pluck('id');
           
        }

           $category_slugs = DB::table('products')->select('category.categories_slug')->where('products.user_id', $vendor_id[0])
            ->join('products_to_categories as p_category', 'products.products_id','=','p_category.products_id')
            ->distinct('p_category.categories_id')
            ->join('categories as category','p_category.categories_id','=','category.categories_id')
            ->pluck('category.categories_slug');
            $vendor_categories = DB::table('products')->select('category_name.categories_name','category.categories_slug')->where('products.user_id', $vendor_id[0])->where('category_name.language_id', Session::get('language_id'))
            ->join('products_to_categories as p_category', 'products.products_id','=','p_category.products_id')
            ->distinct('p_category.categories_id')
            ->join('categories as category','p_category.categories_id','=','category.categories_id')
            ->join('categories_description as category_name','category_name.categories_id','=','category.categories_id')
            ->get();

            //dd( $category_slugs, $vendor_categories );

         $min = '';
         $max = '';


        if ($request->get('min') > 0) {
            $min = $request->get('min');
        }
        if ($request->get('max') > 0) {
            $max = $request->get('max');
        }
       
        $title = array('pageTitle' => 'sadsad');
        $result = array();

        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;

         if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }


         $result['category'] = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id');

         if( $request->get('category_slug')){

               $result['category'] =   $result['category']->whereIn('categories_slug', $request->get('category_slug'));

         }else{

                $result['category'] =   $result['category']->whereIn('categories_slug', $category_slugs);

         }
         
        // ->where('categories.categories_status', 1)
        $result['category'] = $result['category']->where('language_id', Session::get('language_id'))->get();


        $filterCatIds = [];
        if (!empty($request->get('category_slug'))) {
         foreach ($result['category']  as $key => $value) {
             $filterCatIds[] = $value->categories_id;
         }
            
            // return $filterCatIds;
        }
         $filters = array();
       
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $this->products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode($options, ',');
            $filters['option_value'] = implode($option_values, ',');

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result['filter_attribute']['options'] = $options;
            $result['filter_attribute']['option_values'] = $option_values;
        
        $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'search' => $search, 'filterCatIds' => $filterCatIds,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min, 'max_price' => $max,
            'vendor_id' => $vendor_id[0],
        );

       
        $result['categories'] = DB::table('categories')->leftJoin('categories_description', 
            'categories_description.categories_id', '=', 'categories.categories_id');

        if( count($result['category']) > 0 ){

                if ($result['category'][0]->parent_id == 0) {
                  $result['categories'] =   $result['categories'];
                  //->where('categories.parent_id', $result['category'][0]->categories_id);
                }
                else{
                   $result['categories'] =   $result['categories'];
                }


        }
        

       
      $result['categories'] =  $result['categories']->where('language_id', Session::get('language_id'))->get();
	
	  $vendor_image_result = DB::table('vendor_details as v')->select('v.location','a.image_id','a.path',)->where('v.vendor_id', $vendor_id[0])
		->join('image_categories as a', 'a.image_id', '=', 'v.vendor_logo')
		->get();
		
		$get_address_book_id = DB::table('user_to_address')->select('user_id','address_book_id')->where('user_id', $vendor_id[0])->first();
		if( !empty($get_address_book_id) ){
			$address_book_id = $get_address_book_id->address_book_id ;
			$vendor_name_detail = DB::table('address_book')->select('address_book_id','entry_firstname','entry_lastname','entry_street_address')->where('address_book_id', $address_book_id)->first();
			$vendor_map_record = DB::table('vendor_details')->select('vendor_id','vendor_logo','vendor_banner_image','location','latitude','longitude')->where('vendor_id', $vendor_id[0])->first();
		}else{
			$address_book_id = NULL ;
			$vendor_name_detail = NULL ;
			$vendor_map_record = NULL ;
		}

        $get_user_information_from_users = DB::table('users')->select('id','first_name','last_name')->where('id', $vendor_id[0])->first();

        $products = $this->products->vendorProducts($data);        
        $result['products'] = $products;
        $result['filters'] = $filters;
        $result['min_price'] = $min_price;
        $result['max_price'] = $max_price;
        $result['vendor_categories'] = $vendor_categories;
		
        $result['vendor_image_result'] = $vendor_image_result;
        $result['vendor_name_detail'] = $vendor_name_detail;
        $result['vendor_map_record'] = $vendor_map_record;
        $result['get_user_information_from_users'] = $get_user_information_from_users;
        
        if ($request->ajax()) {

            return view('web.supplier.supplier_product', ['title' => $title, 'vendorName' => $vendor_name, 'final_theme' => $final_theme])->with('result', $result);
        }
       
        return view('web.supplier.supplier', ['title' => $title, 'vendorName' => $vendor_name, 'final_theme' => $final_theme])->with('result', $result);
    }


    public function reviews(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $check = DB::table('reviews')
                ->where('customers_id', Auth::guard('customer')->user()->id)
                ->where('products_id', $request->products_id)
                ->first();

            if ($check) {
                return 'already_commented';
            }
            $id = DB::table('reviews')->insertGetId([
                'products_id' => $request->products_id,
                'reviews_rating' => $request->rating,
                'customers_id' => Auth::guard('customer')->user()->id,
                'customers_name' => Auth::guard('customer')->user()->first_name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('reviews_description')
                ->insert([
                    'review_id' => $id,
                    'language_id' => Session::get('language_id'),
                    'reviews_text' => $request->reviews_text,
                ]);
            return 'done';
        } else {
            return 'not_login';

        }
    }

    //shop
    public function shop(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Shop'));
        $result = array();

        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;
        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $this->products->getCategories($request);
            
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $main_category = $this->products->getMainCategories($category[0]->parent_id);

                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['categories_status'] = $categories_status;

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $this->products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode($options, ',');
            $filters['option_value'] = implode($option_values, ',');

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result['filter_attribute']['options'] = $options;
            $result['filter_attribute']['option_values'] = $option_values;
        }

        $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);

        $products = $this->products->products($data);        
        $result['products'] = $products;

        $data = array('limit' => $limit, 'categories_id' => $categories_id);
        $filters = $this->filters($data);
        $result['filters'] = $filters;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        if ($limit > $result['products']['total_record']) {
            $result['limit'] = $result['products']['total_record'];
        } else {
            $result['limit'] = $limit;
        }

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        $result['categories'] = $this->products->categories();

        $result['min_price'] = $min_price;
        $result['max_price'] = $max_price;

        

        return view("web.shop", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }

     public function search(Request $request)
    {

        $title = array('pageTitle' => Lang::get('website.Shop'));
        $result = array();

        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;
        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $this->products->getCategories($request);
            
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $main_category = $this->products->getMainCategories($category[0]->parent_id);

                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['categories_status'] = $categories_status;

        //search value
        if (!empty($request->q)) {
            $search = $request->q;
        } else {
            $search = '';
        }

        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $this->products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode($options, ',');
            $filters['option_value'] = implode($option_values, ',');

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result['filter_attribute']['options'] = $options;
            $result['filter_attribute']['option_values'] = $option_values;
        }

        $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);

        $products = $this->products->products($data);
        $result['products'] = $products;

        $data = array('limit' => $limit, 'categories_id' => $categories_id);
        $filters = $this->filters($data);
        $result['filters'] = $filters;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        if ($limit > $result['products']['total_record']) {
            $result['limit'] = $result['products']['total_record'];
        } else {
            $result['limit'] = $limit;
        }

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        $result['categories'] = $this->products->categories();

        $result['min_price'] = $min_price;
        $result['max_price'] = $max_price;

        // return $result;
        //return view("web.shop", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
        return view("web.search", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    }

    public function filterProducts(Request $request)
    {

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //if(!empty($request->category_id)){
        if (!empty($request->category) and $request->category != 'all') {
            $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->where('categories_slug', $request->category)->where('language_id', Session::get('language_id'))->get();

            $categories_id = $category[0]->categories_id;
        } else {
            $categories_id = '';
        }

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $filters['options_count'] = count($request->options_value);
            $filters['options'] = $request->options;
            $filters['option_value'] = $request->options_value;
        } else {
            $filters = array();
        }

        $data = array('page_number' => $request->page_number, 'type' => $type, 'limit' => $limit, 'categories_id' => $categories_id, 'search' => $search, 'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        $result['commonContent'] = $this->index->commonContent();
        return view("web.filterproducts")->with('result', $result);

    }

    public function ModalShow(Request $request)
    {   
       
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
            // return view("web.common.modal1")->with('result', $result);
        return view("web.rafeki-product-sections.quick_view")->with('result', $result);

    }

    //access object for custom pagination
    public function accessObjectArray($var)
    {
        return $var;
    }

     //productDetail
     public function productDetail(Request $request)
     {
 
         $title = array('pageTitle' => Lang::get('website.Product Detail'));
         $result = array();
         $result['commonContent'] = $this->index->commonContent();
         $final_theme = $this->theme->theme();
         //min_price
         if (!empty($request->min_price)) {
             $min_price = $request->min_price;
         } else {
             $min_price = '';
         }
 
         //max_price
         if (!empty($request->max_price)) {
             $max_price = $request->max_price;
         } else {
             $max_price = '';
         }
 
         if (!empty($request->limit)) {
             $limit = $request->limit;
         } else {
             $limit = 15;
         }
 
         $products = $this->products->getProductsBySlug($request->slug);
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
 
             if (!empty($category) and count($category) > 0) {
                 $category_slug = $category[0]->categories_slug;
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
 
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
             $isFlash = $this->products->getFlashSale($products[0]->products_id);
 
             if (!empty($isFlash) and count($isFlash) > 0) {
                 $type = "flashsale";
             } else {
                 $type = "";
             }
             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $detail = $this->products->products($data);
             $result['detail'] = $detail;
             if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
                 $i = 0;
                 foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                     if ($i == 0) {
                         $postCategoryId = $postCategory->categories_id;
                         $i++;
                     }
                 }
             }
 
             $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $simliar_products = $this->products->products($data);
             $result['simliar_products'] = $simliar_products;
 
             $cart = '';
             $result['cartArray'] = $this->products->cartIdArray($cart);
 
             //liked products
             $result['liked_products'] = $this->products->likedProducts();
 
             $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $top_seller = $this->products->products($data);
             $result['top_seller'] = $top_seller;		
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }

         $result['vendor'] = User::where('id', $result['detail']['product_data'][0]->user_id)->get(['first_name', 'last_name']);

         

         // return $result['vendor'];
         // return $result['detail']['product_data'];
         return view("web.detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
     }

     //productDetail
     public function productDetail1(Request $request)
     {
 
         $title = array('pageTitle' => Lang::get('website.Product Detail'));
         $result = array();
         $result['commonContent'] = $this->index->commonContent();
         $final_theme = $this->theme->theme();
         //min_price
         if (!empty($request->min_price)) {
             $min_price = $request->min_price;
         } else {
             $min_price = '';
         }
 
         //max_price
         if (!empty($request->max_price)) {
             $max_price = $request->max_price;
         } else {
             $max_price = '';
         }
 
         if (!empty($request->limit)) {
             $limit = $request->limit;
         } else {
             $limit = 15;
         }
 
         $products = $this->products->getProductsBySlug($request->slug);
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
 
             if (!empty($category) and count($category) > 0) {
                 $category_slug = $category[0]->categories_slug;
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
 
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
             $isFlash = $this->products->getFlashSale($products[0]->products_id);
 
             if (!empty($isFlash) and count($isFlash) > 0) {
                 $type = "flashsale";
             } else {
                 $type = "";
             }
             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $detail = $this->products->products($data);
             $result['detail'] = $detail;
             if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
                 $i = 0;
                 foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                     if ($i == 0) {
                         $postCategoryId = $postCategory->categories_id;
                         $i++;
                     }
                 }
             }
 
             $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $simliar_products = $this->products->products($data);
             $result['simliar_products'] = $simliar_products;
 
             $cart = '';
             $result['cartArray'] = $this->products->cartIdArray($cart);
 
             //liked products
             $result['liked_products'] = $this->products->likedProducts();
 
             $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $top_seller = $this->products->products($data);
             $result['top_seller'] = $top_seller;       
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }
         // return $result['detail']['product_data'];
         return view("web.detail1", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
     }

    //filters
    public function filters($data)
    {
        $response = $this->products->filters($data);
        return ($response);
    }

    //getquantity
    public function getquantity(Request $request)
    {
        $data = array();
        $data['products_id'] = $request->products_id;
        $data['attributes'] = $request->attributeid;

        $result = $this->products->productQuantity($data);
        print_r(json_encode($result));
    }

}
