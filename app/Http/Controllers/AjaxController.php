<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Page;
use App\Models\PredefinedFeature;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    //get sub category by category
    public function get_subcategory($cat_id){
    	$subcategories = Category::where('parent_id', $cat_id)->get();
        $output = '';
        if(count($subcategories)>0){
            $output .= '<option value="">Select Subcategory</option>';
            foreach($subcategories as $subcategory){
                $output .='<option '. (old("subcategory") == $subcategory->id ? "selected" : "" ).' value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
            }
        }
        echo $output;
    }

    // get childcategory by category
    public function get_subchild_category($subcat_id){
    	$subchildcategories = Category::where('subcategory_id', $subcat_id)->get();
        $output = '';
        if(count($subchildcategories)>0){
            $output .= '<option value="">Select Subcategory</option>';
            foreach($subchildcategories as $subchildcategory){
                $output .='<option '. (old("subcategory") == $subchildcategory->id ? "selected" : "" ).' value="'.$subchildcategory->id.'">'.$subchildcategory->name.'</option>';
            }
        }
        echo $output;
    }

    //get attribute by child category
    public function getAttributeByChildcategory($subcat_id){
    	$subchildcategories = Category::where('subcategory_id', $subcat_id)->get();
        $output = '';
        if(count($subchildcategories)>0){
            $output .= '<option value="">Select Subcategory</option>';
            foreach($subchildcategories as $subchildcategory){
                $output .='<option '. (old("subcategory") == $subchildcategory->id ? "selected" : "" ).' value="'.$subchildcategory->id.'">'.$subchildcategory->name.'</option>';
            }
        }
        echo $output;
    }

    // get attribute by category & sub category
    public function getAttributeByCategory($category_id){
    	$attributes = ProductAttribute::where('category_id', $category_id)->get();
    	$output = '';
    	if(count($attributes)>0){
    		$output = view('admin.product.attributedynamic-fields')->with(compact('attributes'));
    	}

    	echo $output;
    }

    // get brand
    public function getBrand($category_id){
    	$brands = Brand::where('category_id', $category_id)->orWhere('category_id', 0)->get();
    	$output = '';
    	if(count($brands)>0){
    		$output = '
	                <div class="form-group">
	                    <label class="required" for="brand">Brand </label>
	                    <select name="brand" style="width:100%" id="brand" class="form-control custom-select">
	                       <option value="">Select Brand</option>.';
	                      		foreach ($brands as $brand) {
	                      			$output .= '<option value="'.$brand->id.'">'.$brand->name.'</option>';
	                      		}
	                    $output .= '</select>
	                </div>
	            ';
    	}
    	echo $output;
    }

    public function getFeature($category_id){
        $getFeature = PredefinedFeature::where('category_id', $category_id)->get();

        $output = '';
        if(count($getFeature)>0){
            $output = '<div class="form-group row">';
            foreach ($getFeature as $feature) {
                $output .=  '<span class="col-4 col-sm-2 required text-right col-form-label">'.$feature->name.' </span>
                <input type="hidden" value="'.$feature->name.'" class="form-control"  name="FeatureName[]"  placeholder="Enter name">
                <div class="col-8 col-sm-4">
                    <input type="text" name="FeatureValue[]" class="form-control"  placeholder="Input value here">
                </div>';
            }
            $output .= '</div>';
        }
        echo $output;
    }

    public function getMenuSourch($type){
        $getSources = [];
        $output = '';
        if($type == 'category'){
            $subcategory = Category::where('parent_id', '!=', null)->where('subcategory_id', null)->where('status', 1)->get();
            if(count($subcategory)>0){
                foreach ($subcategory as $source) {
                    $output .= ' <option value="'.$source->id.'">'.$source->name.'</option>';
                    if(count($source->get_subcategory)>0){

                        foreach($source->get_subcategory as $childcategory){
                            $output .= '<option value="'.$childcategory->id.'">&nbsp;&nbsp;'.$childcategory->name.'</option>';

                        }

                    }
                }
            }
        }elseif($type == 'page'){
            $getSources = Page::where('status', 1)->get();
            if(count($getSources)>0){
                foreach ($getSources as $source) {
                    $output .= ' <option value="'.$source->id.'">'.$source->title.'</option>';
                }
            }
        }else{
            $output = '';
        }

        echo $output;
    }

    //get cart details in header
    public function getCartHead()
    {
        $sessionCart =  Session::get('cart');
        if($sessionCart){
            echo view('frontend.carts.cart-head')->with(compact('sessionCart'));
        }else{
            echo '<h4 style="color:red;text-align: center;padding: 0px">Your cart is empty.</h4>';
        }
    }

    //suggest search keywords
    public function search_keyword(Request $request){
        $get_keyord = Product::select('title')->where('title', 'LIKE', '%'. $request->q .'%')->get();
        $tags = array();
        foreach ($get_keyord as $value) {
            array_push($tags, $value->title);
        }
        echo json_encode($tags);
    }



}
