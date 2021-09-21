<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Firebase\JWT\JWT;
use Prophecy\Call\Call;
use function GuzzleHttp\json_decode;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => config('ekart.api_url')]);
    }

    public function init($reload = false)
    {
        $lmt = Cache::get('lmt', 0);
        if ($reload || $lmt + config('ekart.reload_settings') < time()) {
            $this->update_settings();
            $this->update_offers();
            $this->update_social_media();
            $this->update_categories();
            $this->update_sliders();
        } else {
            if (!Cache::has('logo')) {
                $this->update_settings();
            }
            if (!Cache::has('categories')) {
                $this->update_categories();
            }
            if (!Cache::has('social_media')) {
                $this->update_social_media();
            }
            if (!Cache::has('sliders')) {
                $this->update_sliders();
            }
            if (!Cache::has('offers')) {
                $this->update_offers();
            }
        }
    }

    function post($api, $params = array(), $die = false)
    {
        try {
            $return = [];
            $data = $params['data'] ?? [];
            $token = $this->generate_token();
            $data[config('ekart.access_key')] = config('ekart.access_key_val');
            $response = $this->client->post(config("ekart.apis.$api"), [
                'headers' => ["Authorization" => "Bearer $token"],
                'form_params' => $data
            ]);
            if ($response->getStatusCode() === 200) {
                if ($die) {
                    echo "Bearer $token<br><br>";
                    echo "API URL : " . get("apis.$api") . "<br><br>";
                    echo "Params : <pre>";
                    var_dump($data);
                    echo "</pre><br><br>";
                    echo "API Response : " . $response->getBody();
                    die();
                }
                $return = $this->response($response->getBody(), $params);
            }
            return $return;
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            if (isset($_GET['debug']) && $_GET['debug'] == true) {
                echo $e->getMessage();
            } else {
                $theme = get('theme');
                echo view("themes.$theme.error");
            }
        }
    }

    function response($return = [], $params = [])
    {
        $return = (array)getJSON($return);
        $error = true;
        if (isset($return['error'])) {
            if (is_bool($return['error'])) {
                if ($return['error'] === false) {
                    $error = false;
                }
            } elseif (is_string($return['error'])) {
                if ($return['error'] === "false") {
                    $error = false;
                }
            }
        }
        if (!$error) {
            $data_param = 'data';
            if (isset($params['data_param'])) {
                $data_param = $params['data_param'];
            }
            if (isset($return[$data_param])) {
                $return = (array)$return[$data_param];
            }
        }
        return $return;
    }

    function generate_token()
    {
        return jwt::encode(config('ekart.jwt_payload'), config('ekart.jwt_secret_key'), config('ekart.jwt_alg'));
    }

    public function html($view, $data = array(), $reload = false)
    {
        $this->init($reload);
        $theme = get('theme');
        if (isLoggedIn() && !isset($data['cart'])) {
            $data['cart'] = $this->getCart();
            //$data = $this->getCart();
        }
        echo view("themes.$theme.common.header", compact('view', 'data'));
        echo view("themes.$theme.$view", compact('theme', 'data'));
        if ($view == "home") {
            $this->update_sections();
            if (Cache::has('sections') && is_array(Cache::get('sections')) && count(Cache::get('sections'))) {
                foreach (Cache::get('sections') as $s) {
                    echo view("themes.$theme.parts." . $s->style, compact('theme', 's', 'view'));
                }
            }
            echo view("themes.$theme.parts.categories");
            echo view("themes.$theme.parts.offers");
        }
        echo view("themes.$theme.common.footer");
        return true;
    }

    public function update_settings()
    {
        $settings = $this->post('settings', ['data' => ['all' => true]]);
        foreach ($settings as $k => $v) {
            if ($k == "payment_methods") {
                Cache::put('payment_methods', json_decode($v));
            } elseif ($k == "front_end_settings") {
                $frontEndSettings = \json_decode($v);
                foreach ($frontEndSettings as $k1 => $v1) {
                    Cache::put($k1, $v1);
                }
            } elseif ($k == "time_slot_config") {
                $v = \json_decode($v);
                if (($v->is_time_slots_enabled ?? 0) == 1) {
                    if (($v->time_slot_config ?? 0) == 1) {
                        $getTimeSlot = $this->post('settings', ['data' => ['get_time_slots' => 1, 'setting' => 1]]);
                        if (($getTimeSlot['error'] ?? true) == false) {
                            $v->slots = $getTimeSlot['time_slots'];
                            Cache::put('timeslot', $v);
                        }
                    }
                }
                Cache::put('delivery_starts_from', $v->delivery_starts_from - 1 ?? 0);
                Cache::put('allowed_days', Cache::get('delivery_starts_from') + (($v->allowed_days ?? 10) - 1));
            } else {
                Cache::put($k, $v);
            }
        }
        Cache::put('lmt', time());
    }

    public function update_social_media($social_media = [])
    {
        if (empty($social_media)) {
            $social_media = $this->post('get-social-media', []);
        }
        if (isset($social_media['error']) && $social_media['error']) {
            die('No Data Found. Please Add Data On Admin Panel');
        }
        if (count($social_media)) {
            $socialmedia = [];
            for ($i = 0; $i < count($social_media); $i++) {
                $slug = getSlug($social_media[$i]->icon, $socialmedia);
                $social_media[$i]->icon = $slug;
                $socialmedia[$slug] = $social_media[$i];
            }
            Cache::put('social_media', $socialmedia);
            return true;
        } else {
            return false;
        }
    }

    public function update_categories($categories = [])
    {
        if (empty($categories)) {
            $categories = $this->post('get-categories', []);
        }
        if (isset($categories['error']) && $categories['error']) {
            die('No Data Found. Please Add Data On Admin Panel');
        }
        if (count($categories)) {
            $category = [];
            $subCategory = [];
            for ($i = 0; $i < count($categories); $i++) {
                $slug = getSlug($categories[$i]->name, $category);
                $categories[$i]->slug = $slug;
                $category[$slug] = $categories[$i];

                if (!empty($categories[$i]->childs)) {
                    $subCategory = array_merge($subCategory, (array)$categories[$i]->childs);
                }
            }
            Cache::put('categories', $category);
            Cache::put('sub-categories', $subCategory);
            return true;
        } else {
            return false;
        }
    }

    public function update_sliders()
    {
        $sliders = $this->post('slider-images', ['data' => [api_param('get-slider-images') => api_param('get-val')]]);
        if (!\is_null($sliders)) {
            if (count($sliders)) {
                if (isset($sliders['error']) && $sliders['error']) {
                    return false;
                } else {
                    Cache::put('sliders', $sliders);
                }
                return true;
            } else {
                return false;
            }
        }
    }

    public function update_offers()
    {
        return Cache::put('offers', $this->post('offers', ['data' => [api_param('get-offer-images') => api_param('get-val')]]));
    }

    public function update_sections()
    {
        $data = [api_param('get-all-sections') => api_param('get-val')];
        if (isLoggedIn()) {
            $data[api_param('user-id')] = session()->get('user')['user_id'];
        }
        $response = $this->post('sections', ['data' => $data, 'data_param' => 'sections']);
        if (is_array($response) && count($response)) {
            if (isset($response['error']) && $response['error']) {
                return false;
            } else {
                $sections = [];
                foreach ($response as $r) {
                    if (isset($r->title)) {
                        $r->slug = getSlug($r->title, $sections);
                        $sections[$r->slug] = $r;
                    }
                }
                Cache::put('sections', $sections);
                return true;
            }
        } else {
            return false;
        }
    }

    public function getCart()
    {
        $cart = $this->post('cart', ['data' => ['get_user_cart' => 1, 'user_id' => session()->get('user')['user_id']]]);
        $data['subtotal'] = 0;
        $data['mrptotal'] = 0;
        $data['cart'] = [];
        if (is_array($cart) && count($cart) && !($cart['error'] ?? false)) {
            $total_tax = 0;
            foreach ($cart as $c) {
                if (isset($c->item[0]) && intval($c->qty ?? 0)) {
                    $item_mrpprice = get_price_mrp($c->item[0], 0) * ($c->qty ?? 1);
                    $data['mrptotal'] += $item_mrpprice;
                    $item_price = get_price_varients($c->item[0], 0) * ($c->qty ?? 1);
                    $data['subtotal'] += $item_price;
                    $total_tax += ($item_price * ($c->item[0]->tax_percentage ?? 0) / 100);
                }
            }
            $coupon = session()->get('discount', []);
            $data['coupon'] = $coupon;
            $data['saved_price'] = $data['mrptotal'] - $data['subtotal'] + floatval($coupon['discount'] ?? 0);
            $data['cart'] = $cart;
            $data['total'] = $data['subtotal'];
            if (floatval(Cache::get('tax', 0)) > 0) {
                $data['tax'] = (floatval(Cache::get('tax', 0)) > 0) ? number_format(Cache::get('tax'), 2) : 0;
                $data['tax_amount'] = (floatval(Cache::get('tax', 0)) > 0) ? floatval(floatval(Cache::get('tax')) * $data['subtotal'] / 100) : 0;
            } else {
                $data['tax'] = '';
                $data['tax_amount'] = $total_tax;
            }
            $data['total'] += $data['tax_amount'];
            $data['shipping'] = (intval($data['subtotal']) < Cache::get('min_amount', 0) && Cache::has('delivery_charge')) ? floatval(Cache::get('delivery_charge')) : 0;
            $data['total'] += $data['shipping'];
            $coupon = session()->get('discount', []);
            $data['coupon'] = $coupon;
            $data['total'] -= floatval($coupon['discount'] ?? 0);
        }
        $data['address'] = session()->get('checkout-address');
        return $data;
    }

    public function pagination($list, $routeName = "", $page = 0, $limit = 10)
    {
        $total = $list['total'] ?? 0;
        $lastPage = "";
        if (intval($page - 1) > -1) {
            if (intval($page - 1) == 0) {
                $lastPage = route($routeName);
            } else {
                $lastPage = route($routeName, ['page' => $page - 1]);
            }
        }
        $nextPage = "";
        if (intval($total / $limit) > $page) {
            $nextPage = route($routeName, ['page' => $page + 1]);
        }
        return ['list' => $list, 'limit' => $limit, 'total' => $total, 'page' => $page, 'lastPage' => $lastPage, 'nextPage' => $nextPage];
    }

    public function ekart()
    {
        echo env("API_URL");
    }
}
