@extends('layouts.admin-master')
@section('title', 'Add product')
@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<style type="text/css">
    @media screen and (min-width: 640px) {
        .divrigth_border::after {
            content: '';
            width: 0;
            height: 100%;
            margin: -1px 0px;
            position: absolute;
            top: 0;
            left: 100%;
            margin-left: 0px;
            border-right: 3px solid #e5e8ec;
        }
    }
    .dropify_image{
            position: absolute;top: -14px!important;left: 12px !important; z-index: 9; background:#fff!important;padding: 3px;
        }
    .dropify-wrapper{
        height: 100px !important;
    }
    .bootstrap-tagsinput{
            width: 100% !important;
            padding: 5px;
        }
    .closeBtn{position: absolute;right: 0;bottom: 10px;}
    form label{font-weight: 600;}
    form span{font-size: 12px;}
    #main-wrapper{overflow: visible !important;}
    .shipping-method label{font-size: 13px; font-weight:500; margin-left: 15px; }
    #shipping-field{padding: 0 15px;margin-bottom: 10px; }
</style>
@endsection

@section('content')

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add New product</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                                <li class="breadcrumb-item active">create</li>
                            </ol>
                        <a href="{{route('product.list')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Product List</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card">
                 <div id="pageLoading"></div>
                <div class="card-body">

                    <form action="{{route('product.store')}}" data-parsley-validate enctype="multipart/form-data" method="post" id="product">
                        @csrf

                        <div class="form-body">
                            
                            <div class="row" style="align-items: flex-start; overflow: visible;">
                                
                                <div class="col-md-9 divrigth_border sticky-conent">
                                    <div class="row">
                                        <div class="col-md-12 title_head">
                                           
                                            Product Basic Information
                                           
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Product Title</label>
                                                <input type="text" value="{{old('title')}}" name="title" required="" id="title" placeholder = 'Enter title' class="form-control" >
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('title') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="category">Select category</label>
                                                <select required=""  onchange="get_subcategory(this.value)" name="category" id="category" class="form-control custom-select">
                                                   <option value="">Select category</option>
                                                   @foreach($categories as $category)
                                                   <option {{ (old('category') == $category->id ? 'selected' : '' ) }} value="{{$category->id}}">{{$category->name}}</option>
                                                   @endforeach
                                                </select>
                                                @if ($errors->has('category'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('category') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="subcategory">Select subcategory</label>
                                                <select onchange="get_subchild_category(this.value)" required name="subcategory" id="subcategory" class="form-control custom-select">
                                                   <option value="">Select first category</option>
                                                </select>
                                                @if ($errors->has('subcategory'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('subcategory') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="subchildcategory">Select Child Category</label>
                                                <select onchange="getAttributeByCategory(this.value, 'getAttributesByChildcategory')" name="childcategory"  id="subchildcategory" class="form-control custom-select">
                                                   <option value="">Select first sub category</option>
                                                  
                                                </select>
                                                @if ($errors->has('childcategory'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('childcategory') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="purchase_price">Purchase Price</label>
                                                <input required type="text" value="{{old('purchase_price')}}"  name="purchase_price" id="purchase_price" placeholder = 'Enter purchase price' class="form-control" >
                                                @if ($errors->has('purchase_price'))
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $errors->first('purchase_price') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="selling_price">Selling Price</label>
                                                <input required type="text" value="{{old('selling_price')}}"  name="selling_price" id="selling_price" placeholder = 'Enter selling price' class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="discount">Discount</label>
                                                <input type="text" value="{{old('discount')}}"  name="discount" id="discount" placeholder = 'Enter discount' class="form-control" >
                                            </div>
                                        </div>

                                       <div class="col-md-12 title_head">
                                            Product Attribute & Features
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                    <input type="checkbox" id="productVariation" name="productVariation" value="1">
                                                    <label for="productVariation">Add Product Variant</label>
                                              </div>      
                                            </div> 
                                            <div id="productVariationField" style="display: none;">
                                                <div id="getAttributesByCategory"></div>
                                                <div id="getAttributesBySubcategory"></div>
                                                <div id="getAttributesByChildcategory"></div>
                                            </div>
                                        </div>

                                       
                                        <div class="col-md-12">
                                            <!-- Allow attribute checkbox button -->
                                            <div class="form-group">
                                                <div class="checkbox2">
                                                    
                                                    <label for="predefinedFeature">Product Features</label>
                                                </div>
                                            </div>
                                            
                                            <div id="PredefinedFeatureBycategory"></div>
                                            <div id="PredefinedFeatureBySubcategory"></div>
                                            <div id="PredefinedFeatureByChildcategory"></div>
                                            <div id="extraPredefinedFeature"></div>
                                            <div class="row justify-content-md-center"><div class="col-md-4"> <span  style="cursor: pointer;" class="btn btn-info" onclick="extraPredefinedFeature()"><i class="fa fa-plus"></i> Add More Feature </span></div></div> <hr/>';
            
                                        </div>
                                        
                                        <div class="col-md-12">
                                        	<div class="form-group">
                                        		<label class="required" style="background: #fff;padding-bottom:0px;  top:-14px;z-index: 999" >Product Description</label>
	                                           <textarea name="description" class="summernote form-control">{{old('description')}}</textarea>
	                                       </div>
                                        </div>
                                          
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 title_head">
                                                    Shipping & Delivery
                                                </div>
                                               
                                                <div class="col-md-12">
                                                   <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="required" >Product Package</label>
                                                        </div>
                                                        <div class="col-sm-4 nopadding">
                                                           <div class="form-group">
                                                                <span>Package Weight (kg)</span>
                                                                <input required type="number" min="1" class="form-control"  name="weight"  placeholder="Enter weight">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12 nopadding">
                                                             <label class="required">Package Dimensions (cm) </label>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span class="required">Length (cm)</span>
                                                                <input required type="number" min="1" class="form-control"  name="length"  placeholder="Enter Length">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span class="required">Width (cm)</span>
                                                                <input required type="number" min="1" class="form-control"  name="width"  placeholder="Enter Width">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 nopadding">
                                                            <div class="form-group">
                                                                <span>Height (cm)</span>
                                                                <input required type="number" min="1" class="form-control" name="height"  placeholder="Enter Height">
                                                            </div>
                                                        </div>
                                                       
                                                       
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        
                                                        <div class="checkbox2">
                                                          <input type="checkbox" id="ship_time" value="1"> 
                                                          <label for="ship_time">Allow Shipping Charge</label>
                                                        </div>
                                                                  
                                                    </div> 
                                                    <div id="ship_time_display"  style="display: none;">

                                                        <div class="form-group">
                                                            <div class="checkbox2 shipping-method">
                                                                <label for="Flate_shipping"><input type="radio" name="shipping_method" id="Flate_shipping" value="Flate"> 
                                                                Flate Shipping</label>
                                                                <label for="Location_shipping">
                                                                <input type="radio" name="shipping_method" id="Location_shipping" value="location"> 
                                                                Location-based shipping</label>

                                                                <label for="Price_shipping">
                                                                <input type="radio" name="shipping_method" id="Price_shipping" value="price"> 
                                                                Price-based shipping</label>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="shipping-field"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="checkbox2">
                                                            <input type="checkbox" id="checkSeo" name="secheck" value="1">
                                                            <label for="checkSeo">Allow Product SEO</label>
                                                      </div>      
                                                    </div> 
                                                    <div  id="seoField" style="display: none;">  
                                                        
                                                        <div class="form-group">
                                                            <span class="required" for="meta_title">Meta Title</span>
                                                            <input type="text" value="{{old('meta_title')}}"  name="meta_title" id="meta_title" placeholder = 'Enter meta title'class="form-control" >
                                                        </div>
                                                        <div class="form-group">
                                                            <span class="required">Meta Keywords( <span style="font-size: 12px;color: #777;font-weight: initial;">Write meta tags Separated by Comma[,]</span> )</span>

                                                             <div class="tags-default">
                                                                <input  type="text" name="meta_keywords[]"  data-role="tagsinput" placeholder="Enter meta keywords" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <span class="control-label" for="meta_description">Meta Description</span>
                                                            <textarea class="form-control" name="meta_description" id="meta_description" rows="2" style="resize: vertical;" placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                                                        </div>
                                                 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 sticky-conent">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="stock">Product Stock</label>
                                                <input type="text" value="{{old('stock')}}"  name="stock" id="stock" placeholder = 'Example: 100'class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="manufacture_date">Manufacture date(Mfd)</label>
                                                <input type="date" value="{{old('manufacture_date')}}" placeholder = 'Enter manufacture date' name="manufacture_date" id="manufacture_date" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expired_date">Expired date(Exd)</label>
                                                <input type="date" value="{{old('expired_date')}}" placeholder = 'Enter expired date' name="expired_date" id="expired_date" class="form-control" >
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12" id="brand"></div>

                                    	<div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="dropify_image required">Feature Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="feature_image" id="input-file-events">
                                            </div>
                                            @if ($errors->has('feature_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('feature_image') }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Gallery Image</label>
                                                <input  type="file" multiple class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="gallery_image[]" id="input-file-events">
                                            </div>
                                            @if ($errors->has('gallery_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('gallery_image') }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                
                                                <div class="checkbox2">
                                                  <input name="product_video" type="checkbox" id="product_video" value="1"> 
                                                  <label for="product_video">Add Video</label>
                                                </div>
                                                          
                                            </div> 
                                            <div id="video_display"  style="display: none;">
                                                <div id="extra_video_fields"></div>
                                                <div class="form-group" style="text-align: center;"><span  style="cursor: pointer;" class="btn btn-info" onclick="extra_video_fields()"><i class="fa fa-plus"></i> Add More </span>
                                                </div>

                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                
                                                <label class="switch-box" style="top:-12px;">Status</label>
                                                
                                                    <div class="custom-control custom-switch">
                                                      <input name="status" {{ (old('status') == 'on') ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="status">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status">Publish/Unpublish</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                    
                        </div><hr>
                        <div class="form-actions pull-right">
                            <button type="submit"  name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> Save Product </button>
                            
                            <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
               
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->


   
@endsection

@section('js')


   
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script type="text/javascript">

        @if(old('category'))
            get_subcategory({{old('category')}});
        @endif

      
        function get_subcategory(id=''){
            document.getElementById('pageLoading').style.display ='block';
        
        	//get attribute by category
                getAttributeByCategory(id, 'getAttributesByCategory');
          	//when main category change reset attribute fields
                $('#getAttributesBySubcategory').html(' ');
                $('#getAttributesByChildcategory').html(' ');

          	//get brand by category
                getBrand(id);
            //get product feature by sub category
                getFeature(id, 'PredefinedFeatureBycategory');
            //when category change reset feature
                $('#PredefinedFeatureBySubcategory').html(' ');
                $('#PredefinedFeatureByChildcategory').html(' ');
        
            var  url = '{{route("getSubCategory", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    
                    if(data){
                        $("#subcategory").html(data);
                        $("#subcategory").focus();
                        
                    }else{
                        $("#subcategory").html('<option value="">subcategory not found</option>');
                    }
                    document.getElementById('pageLoading').style.display ='none';
                }
            });
        }        
        @if(old('subcategory'))
            get_subchild_category({{old('subcategory')}});
        @endif
        function get_subchild_category(id=''){
            //enable loader
            document.getElementById('pageLoading').style.display ='block';
            //get brand
            getBrand(id);
            //get product feature by sub category
            getFeature(id, 'PredefinedFeatureBySubcategory');
            //when sub category change reset feature 
            $('#PredefinedFeatureByChildcategory').html(' ');

        	//get attribute by sub category 
        	getAttributeByCategory(id, 'getAttributesBySubcategory');
        	//when sub category change reset attribute fields
        	 $('#getAttributesByChildcategory').html(' ');
        	
            var  url = '{{route("getSubChildCategory", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    
                    if(data){
                        $("#subchildcategory").html(data);
                        $("#subchildcategory").focus();
                    }else{
                        $("#subchildcategory").html('<option value="">Childcategory not found</option>');
                    }
                    document.getElementById('pageLoading').style.display ='none';
        
                }
            });
        }  

        // get Attribute by Category 
        function getAttributeByCategory(id, category){
            //enable loader
            document.getElementById('pageLoading').style.display ='block';

            //get product feature by child category
            if(category == 'getAttributesByChildcategory'){
                getFeature(id, 'PredefinedFeatureByChildcategory');
            }

            var  url = '{{route("getAttributeByCategory", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                	
                    if(data){
                        $("#"+category).html(data);
                    }else{
                        $("#"+category).html('');
                    }
                    document.getElementById('pageLoading').style.display ='none';
                }
            });
        }           

        // get brand by Category 
        function getBrand(id){

            var  url = '{{route("getBrand", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                	
                    if(data){
                        $("#brand").html(data);
                    }else{
                        $("#brand").html('');
                    }
                }
            });
        }          

        // get feature by Category 
        function getFeature(id, category){

            var  url = '{{route("getFeature", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                   
                    if(data){
                        $("#"+category).html(data);
                    }else{
                        $("#"+category).html('');
                    }
                }
            });
        }       

   
    </script>

    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });

    $("#ship_time").change(function() {
	    if(this.checked) { $("#ship_time_display").show(); }
	    else { $("#ship_time_display").hide(); }
	});    

    $("#Flate_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" placeholder="Exm: 50" min="1" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }
    });     

    $("#Price_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-3"><span class="required">Order price above</span><input class="form-control" required name="order_price_above" placeholder="0.00" min="1" type="number"></div><div class="col-md-3><div class="form-group"><div class="checkbox2 shipping-method"><label for="Free_shipping"><span class="required">Shipping Rate</span><br/><br/><input type="checkbox" name="free_shipping" id="Free_shipping" value="1"> Free Shipping</label></div></div></div><div class="col-md-3"><span>Or shipping cost</span><input class="form-control" name="shipping_cost" placeholder="Exm: 3-4 days" type="text"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }
    });     

    $("#Location_shipping").change(function() {
        if(this.checked) { $("#shipping-field").html('<div class="col-md-4"><span class="required">Select Specific Region</span><select required name="region_id" id="region_id" class="form-control custom-select"> @foreach($regions as $region) <option value="{{$region->id}}">{{$region->name}}</option> @endforeach </select></div><div class="col-md-3"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_cost" placeholder="Exm: 50" min="1" type="number"></div><div class="col-md-12"><br/></div><div class="col-md-4"><span>Others region shipping cost</span><input class="form-control" name="shipping_time" placeholder="Exm: 55" type="text"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" placeholder="Exm: 3-4 days" type="text"></div>'); }
        else { $("#shipping-field").html(''); }
    });    


    var shipping = 1;
    //add dynamic shipping 
    function shipping_fields() {

        shipping++;
        var objTo = document.getElementById('shipping_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + shipping);
        var rdiv = 'removeclass' + shipping;
        divtest.innerHTML = '<div class="col-md-4"><span class="required">Select Region</span><select required name="video_type" id="video_type" class="form-control custom-select"><option value="1">Youtube</option> <option value="2">Vimeo</option></select></div><div class="col-md-2"><span class="required">Shipping Cost</span><input class="form-control" name="shipping_time" id="ship_time" placeholder="Exm: 50" value="" min="1" type="number"></div><div class="col-md-3"><span>Estimated Shipping Time</span><input class="form-control" name="shipping_time" id="ship_time" value="Exm: 3-4 days" type="text"></div><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_shipping_fields(' + shipping + ');"><i class="fa fa-times"></i></button></div>';

        objTo.appendChild(divtest)
    }

    //allow seo fields
	$("#checkSeo").change(function() {
	    if(this.checked) { $("#seoField").show(); }
	    else { $("#seoField").hide(); }
	});    

    $("#productVariation").change(function() {
        if(this.checked) { $("#productVariationField").show(); }
        else { $("#productVariationField").hide(); }
    });
    </script>

    <script type="text/javascript">


    var extraAttribute = 1;
    //add dynamic attribute value fields by attribute
    function extraPredefinedFeature() {

        extraAttribute++;
        var objTo = document.getElementById('extraPredefinedFeature')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", " removeclass" + extraAttribute);
        var rdiv = 'removeclass' + extraAttribute;
        divtest.innerHTML = '<div class="form-group row"><span class="col-4 col-sm-2 text-right col-form-label">Feature name</span> <div class="col-8 col-sm-4"> <input type="text" class="form-control"  name="FeatureName[]"  placeholder="Feature name"> </div><span class="col-4 col-sm-2 text-right col-form-label">Feature Value</span> <div class="col-7 col-sm-3"> <input type="text" name="FeatureValue[]" class="form-control"  placeholder="Input value here"> </div> <div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_extraPredefinedFeature(' + extraAttribute + ');"><i class="fa fa-times"></i></button></div></div>';

        objTo.appendChild(divtest)
    }
    //remove dynamic extra field
    function remove_extraPredefinedFeature(rid) {
        $('.removeclass' + rid).remove();
    }
  

    //Allow checkbox check/uncheck handle
    $("#product_video").change(function() {

        if(this.checked) { 
            $("#video_display").show(); 
            $("#extra_video_fields").html('<div class="row" style="align-items: center"><div class="col-10"><div class="form-group"><span for="video_type" class="required">Video Type</span><select required name="video_type" id="video_type" class="form-control custom-select"><option value="1">Youtube</option> <option value="2">Vimeo</option></select><span class="required">Video link</span><input class="form-control" name="video_link" id="video_link" required placeholder="Exm: https://www.youtube.com" value="" type="text"></div></div><div class="col-1"><button class="btn btn-success" type="button" onclick="extra_video_fields()"><i class="fa fa-plus"></i></button></div></div>'); 
        }
        else {  
           
            $("#extra_video_fields").html('');
            $("#video_display").hide();
        }
    });


    var product_video = 1;
    //add dynamic attribute value fields by attribute
    function extra_video_fields() {

        product_video++;
        var objTo = document.getElementById('extra_video_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + product_video);
        var rdiv = 'removeclass' + product_video;
        divtest.innerHTML = '<div class="row" style="align-items: center"><div class="col-10"><div class="form-group"><span for="video_type" class="required">Video Type</span><select required name="video_type" id="video_type" class="form-control custom-select"><option value="1">Youtube</option> <option value="2">Vimeo</option></select><span class="required">Video link</span><input class="form-control" required name="video_link" id="video_link" placeholder="Exm: https://www.youtube.com" value="" type="text"></div></div><div class="col-1"><button class="btn btn-danger" type="button" onclick="remove_extra_video_fields(' + product_video + ');"><i class="fa fa-times"></i></button></div></div>';

        objTo.appendChild(divtest)
    }
    //remove dynamic extra field
    function remove_extra_video_fields(rid) {
        $('.removeclass' + rid).remove();
    }

    </script>
   
   <script src="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
    $(function() {

        $('.summernote').summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }

    </script>
    <script src="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
    // Enter form submit preventDefault for tags
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
      if(e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
    });
    </script>
 
@endsection

