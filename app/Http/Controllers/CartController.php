<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


    public function cartAdd(Request $request)
    {

      $json_attr = json_encode($request->all());
dd($json_attr);
        $product = Product::find($request->product_id);
        //check weather cart array have product or empty
        $cart = Session::has('cart') ? Session::get('cart') : [];
        $qty = 0;
        if(array_key_exists($product->id, $cart)){
            $qty = $cart[$product->id]['qty']+1;
        }

        if($qty <= $product->stock) {
            //check weather have discount
            if ($product->discount) {
                $price = $product->selling_price - ($product->discount * $product->selling_price) / 100;
            } else {
                $price = $product->selling_price;
            }

            //check product id already exists
            if (array_key_exists($product->id, $cart)) {
                $cart[$product->id]['qty']++;
            } else {
                $cart[$product->id] = [
                    'product_id' => $request->product_id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'image' => $product->feature_image,
                    'qty' => (isset($request->qty)) ? $request->qty : 1,
                    'price' => $price,
                ];
            }
            session(['cart' => $cart]);

            $output = array(
                'status' => 'success',
                'title' => $product->title,
                'image' => $product->feature_image,
                'msg' => Config::get('siteSetting.cart_success')
            );

        }else {
            $output = array(
                'status' => 'error',
                'msg' => 'Out of stock'
            );
        }

        return response()->json($output);

    }

    public function cartView()
    {
        $user_id = Auth::id();
        $getCart = Cart::where('user_id', $user_id)->get();

        return view('frontend.cart');
    }



    public function cartUpdate(Request $request)
    {
        $request->validate([
            'qty' => 'required:numeric|min:1'
        ]);
        $product = Product::find($request->id);
        if($request->qty <= $product->stock) {
            //check weather cart array have product or empty
            $cart = Session::has('cart') ? Session::get('cart') : [];
            //check product id already exists
            if (array_key_exists($product->id, $cart)) {
                $cart[$product->id]['qty'] = $request->qty;
            }
            session(['cart' => $cart]);

            $cartItems = Session::get('cart');
            return view('frontend.carts.cart_summary')->with(compact('cartItems'));

        }else{
            return response()->json(['status' => 'error', 'msg' => 'Out of stock']);
        }

    }


    public function itemRemove($id)
    {
       if(Session::get('cart')){
           $cart = Session::get('cart');
           unset($cart[$id]);
           session(['cart' => $cart]);
           $cart = Session::get('cart');
           $total = 0;
           foreach($cart as $item) {
               $total += round($item['price'] * $item['qty'], 2);
           }
           $output = array(
               'status' => 'success',
               'cartCount' => count(Session::get('cart')),
               'total' => $total,
               'grandTtotal' => $total - (Session::get('couponAmount') ? Session::get('couponAmount') : 0),
               'msg' => Config::get('siteSetting.cart_remove')
           );

       }else{
           $output = array(
               'status' => 'error',
               'msg' => 'Internal error occur.'
           );
       }
       return response()->json($output);
    }

    public function clearCart(){
        Session::forget('cart');
        return redirect()->back();
    }
}
