<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Kreait\Firebase\Factory;
use DB;
use PDF;

class HomeController extends Controller{

    public function index(){
        $result = array();
        $categories = DB::table('category')
            ->paginate(100);

        $categories = DB::table('category')
            ->paginate(100);

        $profession = DB::table('profession')
            ->orderBy('priority', 'asc')
            ->paginate(100);

        $title = "Ecommerce | Full Store Website";

        $this->html('home', ['title'=> $title, 'categories' => $categories, 'profession' => $profession], true);

    }

    public function page($slug){

        $page = array('privacy-policy' => 'privacy_policy', 'tnc' => 'terms_conditions', 'about' => 'about_us');

        $title = array('privacy-policy' => 'Privacy Policy', 'tnc' => 'Terms & Conditions', 'about' => 'About Us');

        if(isset($page[$slug]) && Cache::has($page[$slug])){

            $this->html('page', ['title'=> $title[$slug], 'content' => Cache::get($page[$slug])]);

        }else{

            abort(404);

        }
    }

    public function faq(Request $request){

        $page = 0;

        if($request->has('page') && intval($request->page)){

            $page = intval($request->page);

        }

        $limit = 5;

        $result = $this->post('faq', ['data' => [api_param('search') => $request->search ?? '', api_param('limit') => $limit, api_param('page') => $page+1], 'data_param' => '']);

        if(isset($result['error']) && $result['error'] === false){

            $breadcrumb = array();

            $breadcrumb[] = array('title' => 'Home', 'link' => route('home'));

            $breadcrumb[] = array('title' => 'Faq', 'link' => '#');

            $this->html('faq', ['title' => __('msg.faq'), 'breadcrumb'=> $breadcrumb, 'faq' => $result['data'], 'page' => $page, 'limit' => $limit, 'total' => $result['total']]);
        }else{

            abort(404);

        }

    }

    public function contact_page(Request $request){

       $this->html('contact', ['title' => __('msg.contact_page')]);

    }

    public function product($slug){
        $data = ['slug' => $slug];
        if(isLoggedIn()){
            $data[api_param('user-id')] = session()->get('user')['user_id'];
        }
        $product = $this->post('get-product', ['data' => $data]);
        if(count($product) && !(isset($product['error']) && $product['error']) && isset($product[0])){
            $product = $product[0];
            $similarProducts = array();
            $data = [api_param('category-id') => $product->category_id, api_param('product-id') => $product->id, api_param('get_similar_products') => 1];

            $result = $this->post('get-similar-products', ['data' => $data]);

            if(!isset($result['error'])){
                foreach($result as $r){
                    if($r->slug != $slug){
                        $similarProducts[] = $r;
                    }
                }
            }
            $this->html('product', ['title' => $product->name, 'product' => $product, 'similarProducts' => $similarProducts]);
        }else{
            abort(404);
        }

    }

    public function get_shop_params_category(Request $request){

        $selectedCategoryIds = [];

        $selectedSubCategoryIds = [];

        $selectedSubCategory = explode(",", $request->get('sub-category', ""));

        $selectedCategory = explode(",", $request->get('category', ""));

        $categories = Cache::get('categories');

        foreach($selectedCategory as $cat){

            if(isset($categories[$cat]->childs)){

                $selectedCategoryIds[intval($categories[$cat]->id ?? 0)] = intval($categories[$cat]->id ?? 0);

                $childs = (array)$categories[$cat]->childs;

                foreach($selectedSubCategory as $sub){

                    if(isset($childs[$sub])){

                        unset($selectedCategoryIds[intval($categories[$cat]->id ?? 0)]);

                        $selectedSubCategoryIds[] = intval($childs[$sub]->id ?? 0);

                    }

                }

            }

        }

        return ['selectedCategory' => $selectedCategory, 'selectedCategoryIds' => $selectedCategoryIds, 'selectedSubCategory' => $selectedSubCategory, 'selectedSubCategoryIds' => $selectedSubCategoryIds];

    }

    public function get_shop_params(Request $request){

        $limit = 12;

        $page = $request->page ?? 0;

        $data = ['limit' => $limit, 'offset' => ($page * $limit)];

        $param = [];

        if(isLoggedIn()){

            $data[api_param('user-id')] = session()->get('user')['user_id'];

        }


        $data['s'] = trim($request->s ?? "");

        $param['s'] = trim($request->s ?? "");

        if($request->has('section') && trim($request->section) != ""){

            $sections = Cache::get('sections');

            if(isset($sections[$request->section])){

                $data['section'] = intval($sections[$request->section]->id ?? 0);

                $param['section'] = trim($request->section);

            }

        }

        extract($this->get_shop_params_category($request));

        $param['sub-category'] = trim($request->{'sub-category'});

        $param['category'] = trim($request->category);

        $data['category'] = implode(",", $selectedCategoryIds);

        $data['sub-category'] = implode(",", $selectedSubCategoryIds);

        $data[api_param('sort')] = trim($request->sort ?? "");

        $param[api_param('sort')] = trim($request->sort ?? "");

        $param['min_price'] = trim($request->{'min_price'});

        $param['max_price'] = trim($request->{'max_price'});

        $data['min_price'] = $request->min_price ?? 0;

        $data['max_price'] = $request->max_price ?? 0;

        return ['data' => $data, 'param' => $param, 'page' => $page, 'limit' => $limit, 'selectedCategory' => $selectedCategory, 'selectedSubCategory' => $selectedSubCategory];

    }

    public function shop(Request $request){

        extract($this->get_shop_params($request));

        $list = $this->post('shop', ['data' => $data, 'data_param' => '']);

        $total = $list['total'] ?? 0;

        $min_price = $list['min_price'] ?? 0;

        $max_price = $list['max_price'] ?? 0;

        $selectedMaxPrice = ($request->max_price ?? 0) < $max_price ? $max_price : ($request->max_price ?? 0);

        $selectedMinPrice = ($request->min_price ?? 0) < $min_price ? $min_price : ($request->min_price ?? 0);

        if(isset($list['category']) && is_array($list['category']) && count($list['category'])){
            $this->update_categories($list['category']);
        }

        $lastPage = "";

        if(intval($page - 1) > -1){

            if(intval($page - 1) == 0){

                $lastPage = route('shop', $param);

            }else{

                $param['page'] = $page - 1;

                $lastPage = route('shop', $param);

            }

        }

        $nextPage = "";

        if(intval($total / $limit) > $page){

            $param['page'] = $page + 1;

            $nextPage = route('shop', $param);

        }
        $number_of_pages= $total / $limit;
        $categories = Cache::get('categories', []);

        $this->html('shop', ['title' => __('msg.shop'), 'list' => $list, 'limit' => $limit, 'total' => $total, 'min_price' => $min_price, 'max_price' => $max_price, 'selectedMinPrice' => $selectedMinPrice, 'selectedMaxPrice' => $selectedMaxPrice, 'next' => $nextPage, 'last' => $lastPage, 'categories' => $categories, 'selectedCategory' => $selectedCategory, 'selectedSubCategory' => $selectedSubCategory, 'number_of_pages' => $number_of_pages]);

    }

    public function category(Request $request, $slug) {
        $breadcrumb = array();
        $breadcrumb[] = array('title' => 'Home', 'link' => route('home'));
        $breadcrumb[] = array('title' => 'Shop', 'link' => route('shop'));
        if (Cache::has('categories') && is_array(Cache::get('categories')) && isset(Cache::get('categories')[$slug])) {
            $category = Cache::get('categories')[$slug];
            $subCategory = $this->post('get-sub-categories', ['data' => [api_param('category-id') => $category->id]]);
            if (isset($subCategory['error']) && $subCategory['error']) {
                //return redirect()->route('shop')->with('err', 'No Sub Category Found.');

                $breadcrumb[] = array('title' => $category->name, 'link' => route('category', $category->slug));
                $this->html('sub-categories', ['title' => $category->name, 'breadcrumb' => $breadcrumb, 'category' => $category]);
            }
            $s = Cache::get('sub-categories') ?? [];
            foreach ($subCategory as $t) {
                $s[$t->slug] = $t;
            }
            Cache::put('sub-categories', $s);
            $breadcrumb[] = array('title' => $category->name, 'link' => route('category', $category->slug));

            $this->html('sub-categories', ['title' => $category->name, 'breadcrumb' => $breadcrumb, 'category' => $category, 'sub-categories' => $subCategory]);
        } else {
            return redirect()->route('shop');
        }
    }

    public function sub_category(Request $request, $categorySlug = "", $subCategorySlug = "", $offset = 0){

        $subTitle = '';

        $products = [];

        $total = 0;

        $breadcrumb = array();

        $breadcrumb[] = array('title' => 'Home', 'link' => route('home'));

        $breadcrumb[] = array('title' => 'Shop', 'link' => route('shop'));

        if(Cache::has('categories') && is_array(Cache::get('categories')) && isset(Cache::get('categories')[$categorySlug])){

            $category = Cache::get('categories')[$categorySlug];

            $breadcrumb[] = array('title' => $category->name, 'link' => route('category', $category->slug));

            $more = false;

            if(Cache::has('sub-categories') && isset(Cache::get('sub-categories')[$subCategorySlug])){

                $subCategory = Cache::get('sub-categories')[$subCategorySlug];

                $title = $subCategory->name;

                $breadcrumb[] = array('title' => $title, 'link' => route('sub-category', [$category->slug, $subCategory->slug]));

                $response = $this->post('get-products-by-subcategory', ['data_param' => '', 'data' => [api_param('limit') => get('load-item-limit'), api_param('offset') => intval($offset * get('load-item-limit')), api_param('sub-category-id') => $subCategory->id]]);

                if(isset($response['data']) && is_array($response['data']) && count($response['data'])){

                    $products = $response['data'];

                    $total = $response['total'];

                    if($total > ($response['limit'] ?? get('load-item-limit'))){

                        $more = true;

                    }

                }

                $this->html('shop', ['title' => $title, 'subTitle' => $subTitle, 'products' => $products, 'more' => $more, 'breadcrumb' => $breadcrumb, 'total' => $total]);

            }else{

                return redirect()->route('category', $categorySlug);

            }

        }else{

            return redirect()->route('shop');

        }
    }

    public function login_page(){

        if(isLoggedIn()){

            return redirect()->route('home');

        }

        $this->html('login', ['title' => __('msg.login')]);
    }

    public function login(Request $request){

        $error = msg('error');

        $validator = Validator::make($request->all(), [

            'mobile' => 'required',

            'password' => 'required',

        ]);

		if ($validator->fails()) {

            $errors = $validator->messages()->all();

            $response['message'] = $errors[0];

		}else{

            $login = $this->post('login', ['data' => [api_param('mobile') => $request->mobile, api_param('password') => $request->password]]);

            if(isset($login['user_id']) && intval($login['user_id'])){

                $msg = $login['message'];

                unset($login['message']);

                unset($login['error']);

                $request->session()->put('user', $login);

                $lastUrl = $request->get('last_url', '');

                if(trim($lastUrl) != ''){

                    return redirect()->to($lastUrl);

                }else{

                    return redirect()->route('home')->with('suc', $msg);

                }

            }elseif(isset($login['message']) && trim($login['message']) != ""){

                $error = $login['message'];

            }

            return back()->with("err", $error);
        }

    }

    public function already_registered(Request $request){
        $response = ['error' => false, 'message' => 'Enter Valid Mobile Number'];
        if(strlen(trim($request->get('mobile', ""))) > 0){
            $response = $this->post('user-registration', ['data' => [api_param('mobile') => $request->mobile, api_param('type') => api_param('verify-user')]]);
            if($response['error']){
                session()->put('temp_user', $response);
            }
        }
        echo json_encode($response);
    }

    public function register(Request $request){
//        $factory = (new Factory)->withServiceAccount(base_path('config/firebase.json'));
//        $auth = $factory->createAuth();
//        $user = $auth->getUser($request->auth_uid);
//        if($user->uid == $request->auth_uid){
            if($request->has('action') && $request->action == 'save'){
                $response = array('error' => true, 'message' => 'Something Went Wrong');
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:5|confirmed',
                ]);
                if ($validator->fails()) {
                    $errors = $validator->messages()->all();
                    $response['message'] = $errors[0];
                }else{
                    $is_agent = 0;
                    if (isset($request->is_agent) && trim($request->is_agent) == "on") {
                        $is_agent = 1;
                    }
                    $param = array();
                    $session = session()->get('registeration');
                    $mobile = $request->mobile;
                    $param[api_param('type')] = api_param('register');
                    $param[api_param('name')] = $request->display_name;
                    $param[api_param('friends-code')] = $request->friends_code ?? session()->get('friends_code', '');
                    $param[api_param('email')] = $request->email;
                    $param[api_param('mobile')] = $mobile ?? $session['mobile'] ?? $request->mobile;
                    $param[api_param('password')] = $request->password;
                    $param[api_param('pincode')] = $request->pincode ?? '';
                    $param[api_param('city-id')] = $request->city ?? '';
                    $param[api_param('area-id')] = $request->area ?? '';
                    $param[api_param('street')] = $request->address ?? '';
                    $param[api_param('is_agent')] = $is_agent;
                    $param[api_param('latitude')] = 0;
                    $param[api_param('longitude')] = 0;
                    $param[api_param('country-code')] = $request->country;
                    $registration = $this->post('user-registration', ['data' => $param]);
                    if($registration['error'] === false){
                        $response['error'] = 'false';
                        $response['message'] = $registration['message'];
                        unset($registration['friends_code']);
                        unset($registration['message']);
                        unset($registration['error']);
                        session()->put('user', $registration);
                    }else{
                        $response = $registration;
                    }
                }
                echo json_encode($response);
            }
            else{
                $data = array();
//                $data['email'] = $user->email;
//                $data['display_name'] = $user->displayName;
                $data['country'] = "+254";
//                $data['mobile'] = substr($request->mobile, strlen($request->country_code));
//                $data['auth_uid'] = $request->auth_uid;
//                $data['friends_code'] = $request->friends_code ?? session()->get('friends_code', '');

//                session()->put('registeration', $data);
                $this->html('register', $data);
                $data['title'] = __('msg.register');
            }
        /*}else{
            return back()->with("err", 'Auth Token Not Matched');
        }*/
    }

    public function city(Request $request){
        echo json_encode($this->post('get-cities'));
    }

    public function area(Request $request, $cityId = 0){
        echo json_encode($this->post('get-areas', ['data' => [api_param('city-id') => $cityId]]));
    }

    public function refer($code){

        session()->put('friends_code', $code);

        $this->html('login', ['title' => __('msg.refer_and_earn'), 'code' => $code]);

    }

    public function newsletter(Request $request){

        $rules = [

            'email' => 'required|email',

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){

            $messages = $validator->messages();

            return res(false, $messages->all());

        }else{

            $result = $this->post('newsletter', ['data' => ['email' => $request->email]]);

            return res(!$result['error'], $result['message']);

        }

    }

    public function customMade(){
        $result = array();
        $categories = DB::table('custom_product_category')
            ->paginate(100);

        $i=1;
        $productData = array();
        foreach ($categories AS $category) {
            $products = DB::table('custom_product')
                ->where('category_id', '=', $category->id)
                ->orderBy('id', 'ASC')
                ->paginate(500);

            if ($i % 2 == 0) {
                $productData['right'][$i] = $category;
                $productData['right'][$i]->variants = $products;
            } else {
                $productData['left'][$i] = $category;
                $productData['left'][$i]->variants = $products;
            }
            $i++;
        }

        $result['product_list'] = $productData;
        $this->html('custom-made', ['title' => __('msg.shop'), 'product_list' => $productData]);
    }

    public function customMadeQuery(Request $request) {
        ini_set('memory_limit', '-1');
        $product_id = DB::table('custom_product_query')->insertGetId([
            'person' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'product_ids' => $_POST['product_ids'],
            'date' => date("Y-m-d")
        ]);

        $product = DB::table('custom_product')
            ->select('custom_product.name as product_name')
            ->whereIn('custom_product.id', explode(",", $_POST['product_ids']))
            ->get()->toArray();
        $productAry = array_column($product, "product_name");
        $products = implode(" / ", $productAry);

        if (intval($product_id) > 0)
            return json_encode(array("status" => "true", 'id' => $product_id, 'products' => $products));
        else
            return json_encode(array("status" => "false", 'id' => 0, 'products' => ''));
    }

    public function quotationPdf($id) {
        $custom_product_data = DB::table('custom_product_query')
            ->where('id', '=', $id)
            ->first();

        $product_ary = explode(",", $custom_product_data->product_ids);
        $productData = array();
        $total = 0;
        foreach ($product_ary AS $val) {
            $product = DB::table('custom_product')
                ->select('custom_product.name AS product_name', 'custom_product.price', 'custom_product.id', 'custom_product_category.name as category_name')
                ->leftJoin('custom_product_category','custom_product_category.id', '=', 'custom_product.category_id')
                ->where('custom_product.id', '=', $val)
                ->first();

            $total = floatval($product->price + $total);
            $productData[] = $product;
        }
        $custom_product_data->total = $total;
        $custom_product_data->products = $productData;

        $filename = rand()."quotation.pdf";
        $pdf = PDF::loadView('themes.ekart.quotation', (array)$custom_product_data);
        $pdf->save(storage_path().'/quotation_pdf/'.$filename);

        return $pdf->download($filename);
    }

}
