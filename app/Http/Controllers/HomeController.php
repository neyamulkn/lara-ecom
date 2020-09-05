<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductFeature;
use App\Models\ProductFeatureDetail;
use App\Models\Services;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{

    //home page
    public function index()
    {
        $data = [];
        $data['sliders'] = Slider::where('status', 1)->orderBy('orderBy', 'asc')->get();
        $data['services'] = Services::where('status', 1)->orderBy('orderBy', 'asc')->get();
        $data['brands'] = Brand::where('status', 1)->orderBy('name', 'asc')->get();
        $data['categories'] = Category::where('papular', 1)->where('status', 1)->orderBy('orderBy', 'asc')->get();
        $data['products'] = Product::get();
        return view('frontend.home')->with($data);
    }

    //product showby category
    public function category(Request $request)
    {

        $data['products'] = $data['specifications'] = $data['category'] = $data['filterCategories'] = $data['brands'] = [];

        try {
            $products = new Product();
            $specifications = ProductAttribute::orderBy('id', 'asc');
            if ($request->catslug) {
                $data['category'] = Category::where('slug', $request->catslug)->first();
                if($data['category']) {
                    $data['filterCategories'] = $data['category']->get_subcategory;
                    //get product attribute by category id
                    $specifications->orWhere('category_id', $data['category']->id);

                    //get product by category id
                    $products = $products->where('category_id', $data['category']->id);
                }
            }
            if (!$request->subslug && !$request->childslug && $request->catslug) {
                $specifications->orWhere('category_id', $data['category']->id)
                    ->orWhereIn('category_id', $data['filterCategories']->pluck('id'))
                    ->orWhereIn('category_id', $data['category']->get_subchild_category->pluck('id'));
            }
            if ($request->subslug) {
                $data['category'] = Category::where('slug', $request->subslug)->first();
                $data['filterCategories'] = $data['category']->get_subchild_category;
                //get product attribute by sub category id
                $specifications->orWhere('category_id', $data['category']->id);
                //get product by sub category id
                $products = $products->where('subcategory_id', $data['category']->id);
            }
            if ($request->childslug) {
                $data['category'] = Category::where('slug', $request->childslug)->first();
                $data['filterCategories'] = Category::where('subcategory_id', $data['category']->subcategory_id)->get();
                //get product attribute by child category id
                $specifications->orWhere('category_id', $data['category']->id);
                $products = $products->where('childcategory_id', $data['category']->id);
            }
            //check search keyword
            if ($request->q) {
                $products = $products->where('title', 'like', '%' . $request->q . '%');
            }

            //check ratting
            if ($request->ratting) {
                $products = $products->where('avg_ratting', $request->ratting);
            }

            //check brand
            if ($request->brand) {
                $products = $products->where('brand_id', $request->brand);
            }
            //check orderby
            if ($request->sortby) {
                $products = $products->orderBy('id', $request->sortby);
            }

            //check price keyword
            if ($request->price) {
                $price = explode(',', $request->price);
                $products = $products->whereBetween('selling_price', [$price[0], $price[1]]);
            }

            $data['specifications'] = $specifications->get();

            //check weather ajax request identify filter parameter

            foreach ($data['specifications'] as $filterAttr) {
                $filter = strtolower($filterAttr->name);
                if ($request->$filter) {
                    if (!is_array($request->$filter)) { // direct url tags
                        $tags = explode(',', $request->$filter);
                    } else { // filter by ajax
                        $tags = implode(',', $request->$filter);
                    }
                    //get product id from url filter id (size=1,2)
                    $productsFilter = ProductFeatureDetail::whereIn('attributeValue_id', $tags)->groupBy('product_id')->get()->pluck('product_id');

                    $products = $products->whereIn('id', $productsFilter);
                }
            }
            $data['products'] = $products->paginate(5);

        }catch (Exception $e){

        }


        if($request->filter){
            return view('frontend.products.filter_products')->with($data);
        }else{
            if($data['category']){
                $data['brands'] = Brand::where('category_id', $data['category']->id)->where('status', 1)->get();
            }
            return view('frontend.products.category')->with($data);
        }
    }
    //search products
    public function search(Request $request)
    {

        $search = Product::where('title', 'like', '%' . $request->q . '%');
        if ($request->cat){
            $search->join('categories', 'products.category_id', 'categories.id');
            $search->where('categories.slug', $request->cat);
        }
        $search = $search->first();
        $data['products'] = $data['specifications'] = $data['category'] = $data['filterCategories'] = $data['brands'] = [];
        //dd($get_products);
        if($search) {
            $products = new Product();
            $specifications = ProductAttribute::orderBy('id', 'asc');
            if ($search->category_id) {
                $data['category'] = Category::where('id', $search->category_id)->first();
                $data['filterCategories'] = $data['category']->get_subcategory;
                //get product attribute by category id
                $specifications->where('category_id', $data['category']->id);

                //get product by category id
                $products = $products->where('category_id', $data['category']->id);
            }
            if (!$search->childcategory_id && !$search->subcategory_id && $search->category_id) {
                $specifications->orWhere('category_id', $data['category']->id)
                    ->orWhereIn('category_id', $data['filterCategories']->pluck('id'))
                    ->orWhereIn('category_id', $data['category']->get_subchild_category->pluck('id'));
            }
            if ($search->subcategory_id) {
                $data['category'] = Category::where('id', $search->subcategory_id)->first();
                $data['filterCategories'] = $data['category']->get_subchild_category;
                //get product attribute by sub category id
                $specifications->where('category_id', $data['category']->id);
                //get product by sub category id
                $products = $products->where('subcategory_id', $data['category']->id);
            }
            if ($search->childcategory_id) {
                $data['category'] = Category::where('id', $search->childcategory_id)->first();
                $data['filterCategories'] = Category::where('subcategory_id', $data['category']->subcategory_id)->get();
                //get product attribute by child category id
                $specifications->where('category_id', $data['category']->id);
                $products = $products->where('childcategory_id', $data['category']->id);
            }
            //check search keyword
            if ($request->q) {
                $products = $products->where('title', 'like', '%' . $request->q . '%');
            }

            //check ratting
            if ($request->ratting) {
                $products = $products->where('avg_ratting', $request->ratting);
            }

            //check brand
            if ($request->brand) {
                $products = $products->where('brand_id', $request->brand);
            }
            //check orderby
            if (isset($request->sortby) && $request->sortby) {
                $products = $products->orderBy('id', $request->sortby);
            }

            //check price keyword
            if ($request->price) {
                $price = explode(',', $request->price);
                $products = $products->whereBetween('selling_price', [$price[0], $price[1]]);
            }

            $data['specifications'] = $specifications->get();

            //check weather ajax request identify filter parameter

            foreach ($data['specifications'] as $filterAttr) {
                $filter = strtolower($filterAttr->name);
                if ($request->$filter) {
                    if (!is_array($request->$filter)) { // direct url tags
                        $tags = explode(',', $request->$filter);
                    } else { // filter by ajax
                        $tags = implode(',', $request->$filter);
                    }
                    //get product id from url filter id (size=1,2)
                    $productsFilter = ProductFeatureDetail::whereIn('attributeValue_id', $tags)->groupBy('product_id')->get()->pluck('product_id');

                    $products = $products->whereIn('id', $productsFilter);
                }
            }

            $data['products'] = $products->paginate(10);
            $data['brands'] = Brand::where('category_id', $data['category']->id)->where('status', 1)->get();
        }
        if($request->filter){
            return view('frontend.products.filter_products')->with($data);
        }else{
            return view('frontend.products.search_products')->with($data);
        }
    }

    //disply product details by product id/slug
    public function product_details($slug)
    {
        $data['product'] = Product::with('user:id,name','get_category:id,name','get_features')->where('slug', $slug)->where('status', 1)->first();

        if($data['product']) {
            $data['product']->increment('views'); // news view count
            $data['related_products'] = Product::where('category_id', $data['product']->category_id)->where('id', '!=', $data['product']->id)->where('status', 1)->take(8)->get();

            return view('frontend.products.product_details')->with($data);
        }else{
            return view('frontend.404');
        }
    }

    //disply add to cart details
    public function cart()
    {
        $cartItems = Session::get('cart');
        return view('frontend.carts.cart')->with(compact('cartItems'));
    }

    // apply coupon code in cart & checkout page
    public function couponApply(Request $request){
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
        if(!$coupon){
            return response()->json(['status' => 'error', 'msg' => 'This coupon does not exists.']);
        }else{

            if($coupon->status == 0)
            {
                return response()->json(['status' => 'error', 'msg' => 'This coupon is not active.']);
            }

            if($coupon->times != null)
            {
                if($coupon->times == "0")
                {
                    return response()->json(['status' => 'error', 'msg' => 'Coupon usage limit has been reached.']);
                }
            }

            $today = Carbon::parse(now())->format('d-m-Y');
            $from = Carbon::parse($coupon->start_date)->format('d-m-Y');
            $to = Carbon::parse($coupon->expired_date)->format('d-m-Y');

            if( $from > $today)
            {
                return response()->json(['status' => 'error', 'msg' => 'This coupon is running from: '.$from]);
            }if( $to < $today )
            {
                return response()->json(['status' => 'error', 'msg' => 'This coupon is expired.']);
            }

            $cart = Session::get('cart');
            $total_amount = 0;
            foreach($cart as $item) {
                $total_amount += round($item['price'] * $item['qty'], 2);
            }
            if($coupon->type == 0)
            {
                $couponAmount = $total_amount * ($coupon->amount/100);
            }else{
                $couponAmount = $coupon->amount;
            }

            if(Session::get('couponCode') == $request->coupon_code){
                return response()->json(['status' => 'error', 'msg' => 'This coupon is allready used.']);
            }

            Session::put('couponCode', $request->coupon_code);
            Session::put('couponAmount', $couponAmount);
            $cartItems = Session::get('cart');
            $output =  view('frontend.carts.cart_summary')->with(compact('cartItems'));

            return $output ;
        }
    }
    //order checkout
    public function checkout()
    {
        return view('frontend.checkout.checkout');
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }

    public function my_account()
    {
        return view('frontend.my-account');
    }
}
