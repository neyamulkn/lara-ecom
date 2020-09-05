<header id="header" class="typeheader-6">
<!-- Header Top -->
<div class="header-top hidden-compact">
    <div class="container">
        <div class="row">
              <div class="header-top-left  col-lg-6  col-sm-12 col-md-7 hidden-xs">
                  <div class="list-contact hidden-sm hidden-xs">
                      Get an extra 10% off or more on select hotels with Member Pricing Join now, it’s free!
                  </div>
              </div>
            <div class="header-top-right collapsed-block col-lg-6 col-sm-12 col-md-5 col-xs-12 ">
                <div class="tabBlock" id="TabBlock-1">
                    <ul class="top-link list-inline">
                        <li class="login">
                            <a class="link-lg" href="login.html">Login </a>
                        </li>
                        <li class="account " id="my_account">
                            <a href="my-account.html" title="My Account" class="btn-xs dropdown-toggle" data-toggle="dropdown"> <span>My Account</span> <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu ">
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="order-history.html">Order History</a></li>
                                <li><a href="#">Transactions</a></li>
                                <li><a href="#">Downloads</a></li>
                                <li class="checkout"><a href="checkout.html" class="btn-link" title="Checkout "><span>Checkout </span></a></li>
                            </ul>
                        </li>
                        <!-- LANGUAGE CURENTY -->
                        <li>
                            <div class="pull-left">
                                <form action="#" method="post" enctype="multipart/form-data" id="form-language">
                                    <div class="btn-group">
                                        <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{asset('frontend')}}/image/catalog/flags/gb.png" alt="English" title="English">
                                        <span class="hidden-xs hidden-sm hidden-md">English</span>&nbsp;<i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="btn-block language-select" type="button" name="ar-ar"><img src="{{asset('frontend')}}/image/catalog/flags/ar.png" alt="Arabic" title="Arabic"> Arabic</button>
                                            </li>
                                            <li>
                                                <button class="btn-block language-select" type="button" name="en-gb"><img src="{{asset('frontend')}}/image/catalog/flags/gb.png" alt="English" title="English"> English</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="code" value="">
                                    <input type="hidden" name="redirect" value="#">
                                </form>
                            </div>
                        </li>
                        <li class="currency">
                            <div class="pull-left">
                                <form action="#" method="post" enctype="multipart/form-data" id="form-currency">
                                    <div class="btn-group">
                                        <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        $<span class="hidden-xs"> US Dollar</span> 
                                        <i class="fa fa-angle-down"></i>      
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="currency-select btn-block" type="button" name="EUR">€ Euro</button>
                                            </li>
                                            <li>
                                                <button class="currency-select btn-block" type="button" name="GBP">£ Pound Sterling</button>
                                            </li>
                                            <li>
                                                <button class="currency-select btn-block" type="button" name="USD">$ US Dollar</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="code" value="">
                                    <input type="hidden" name="redirect" value="#">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- //Header Top -->
  <!-- Header center -->
<div class="header-center">
    <div class="container">
        <div class="row">
            <div class="navbar-logo col-lg-3 col-md-12 col-xs-12">
                <a href="{{url('/')}}"><img width="200" src="{{asset('frontend')}}/image/catalog/demo/logo/logo-home6.png" title="Your Store - Layout 6" alt="Your Store - Layout 6"></a>
            </div>
            <div class="header-center-right col-lg-6 col-md-7 col-sm-7 col-xs-9">
                <div class="header_search">
                    <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                        <form method="GET" action="{{ route('product.search') }}">
                            <div id="search0" class="search input-group form-group">
                                <div class="select_category filter_type  icon-select">
                                    <?php $categories =  \App\Models\Category::where('parent_id', '=', null)->where('status', 1)->get() ?>
                                    <select class="no-border" name="cat">
                                        <option value="">All categories</option>
                                        @foreach($categories as $srccategory)
                                        <option @if(Request::get('cat') == $srccategory->slug) selected @endif value="{{$srccategory->slug}}">{{$srccategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input class="autosearch-input form-control" type="text" onkeyup="searchItem(this.value)" name="q" value="@if(Request::get('q')){{Request::get('q')}}@endif" id="searchKey" required placeholder="Search">
                                <span class="input-group-btn">
                                <button type="submit" class="button-search btn btn-default btn-lg" ><i class="fa fa-search"></i><span class="hidden">Search</span></button>
                                </span>
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
            <div class="header-cart-phone col-lg-3 col-md-5 col-sm-5 col-xs-3">
                <div class="bt-head header-cart">
                    <div class="shopping_cart" onclick="getCart()">
                    <div id="cart" class="btn-shopping-cart">
                        <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
                          <div class="shopcart">
                           <?php 
                            $sessionCart = 0;
                            if(Session::has('cart')){ $sessionCart = array_sum(array_column(Session::get('cart'), 'qty')); }
                            
                            ?>
                            <span class="handle pull-left"></span>
                            <div class="cart-info" >
                              <h2 class="title-cart">Shopping cart</h2>
                              <h2 class="title-cart2 hidden">My Cart</h2>
                              <span class="total-shopping-cart cart-total-full">
                              <span class="items_cart"  id="cartCount">{{ $sessionCart }} </span> <span class="items_cart2"> item(s)</span>
                              </span>
                            </div>
                          </div>
                        </a>
                        <ul  id="getCartHead" class="dropdown-menu pull-right shoppingcart-box">
                            <div class="loadingData-sm"></div>
                        </ul>
                      </div>
                    </div>
                 </div>
                <div class="header_custom_link hidden-xs">
                    <ul>
                        <li class="compare"><a href="compare.html" class="top-link-compare" title="Compare "></a></li>
                        <li class="wishlist"><a href="wishlist.html" class="top-link-wishlist" title="Wish List (0) "></a></li>
                    </ul>   
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- //Header center -->
  <!-- Heaader bottom -->
<div class="header-bottom hidden-compact">
    <div class="container">
        <div class="header-bottom-inner">
            <div class="row">
                <div class="header-bottom-left menu-vertical col-md-3 col-sm-6 col-xs-7">
                    <div class="megamenu-style-dev megamenu-dev">
                        <div class="responsive">
                            <div class="so-vertical-menu no-gutter">
                                <nav class="navbar-default">
                                    <div class=" container-megamenu  container   vertical  ">
                                      <div id="menuHeading">
                                        <div class="megamenuToogle-wrapper">
                                          <div class="megamenuToogle-pattern">
                                            <div class="container">
                                              <div><span></span><span></span><span></span></div>
                                              <span class="title-mega">
                                              All Categories  
                                              </span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="navbar-header">
                                        <span class="title-navbar hidden-lg hidden-md">  All Categories  </span>
                                        <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        </button>
                                      </div>
                                      <div class="vertical-wrapper">
                                        <span id="remove-verticalmenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                          <div class="container">
                                            <ul class="megamenu" data-transition="slide" data-animationtime="300">
                                            @foreach($categories as $category)
                                       
                                              @if(count($category->get_subcategory)>0)
                                                <li class="item-vertical  css-menu with-sub-menu hover">
                                                  <p class="close-menu"></p>
                                                  <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                                  <span>
                                                  <strong><img src="{{asset('frontend')}}/image/catalog/demo/menu/icon/icon-8.png" alt="">{{$category->name}}</strong>
                                                  </span>
                                                  <b class="fa fa-caret-right"></b>
                                                  </a>
                                                  <div class="sub-menu" style="width: 250px;">
                                                    <div class="content">
                                                      <div class="row">
                                                        <div class="col-sm-12">
                                                          <div class="categories ">
                                                            <div class="row">
                                                              <div class="col-sm-12 hover-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    @foreach($category->get_subcategory as $subcategory)
                                                                    <li>
                                                                      <a href="{{ route('home.category', [$category->slug, $subcategory->slug]) }}"  class="main-menu">{{$subcategory->name}}
                                                                        @if(count($subcategory->get_subcategory)>0)
                                                                        <b class="fa fa-angle-right"></b>
                                                                        @endif
                                                                      </a>
                                                                      @if(count($subcategory->get_subcategory)>0)
                                                                      <ul>
                                                                        @foreach($subcategory->get_subcategory as $childcategory)
                                                                        <li><a href="{{ route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug]) }}" >{{$childcategory->name}}</a></li>
                                                                        @endforeach
                                                                      </ul>
                                                                      @endif
                                                                    </li>
                                                                    @endforeach
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </li>
                                              @else
                                                <li class="item-vertical">
                                                  <p class="close-menu"></p>
                                                  <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                                  <span>
                                                  <strong><img src="{{asset('frontend')}}/image/catalog/demo/menu/icon/icon-6.png" alt="">{{$category->name}}</strong>
                                                  </span>
                                                  </a>
                                                </li>
                                              @endif
                                              @endforeach
                                              
                                              <li class="loadmore"><i class="fa fa-plus-square"></i><span class="more-view"> More Categories</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menuhome -->
                <div class="header-bottom-right col-md-9 col-sm-6 col-xs-5">
                    <div class="header-menu">
                        <div class="megamenu-style-dev megamenu-dev">
                            <div class="responsive">
                                <nav class="navbar-default">
                                    <div class="container-megamenu horizontal">
                                        <div class="navbar-header">
                                          <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                          </button>
                                        </div>
                                        <div class="megamenu-wrapper">
                                          <span id="remove-megamenu" class="fa fa-times"></span>
                                          <div class="megamenu-pattern">
                                            <div class="container">
                                              <ul class="megamenu" data-transition="slide" data-animationtime="500">
                                                <li class="full-width menu-home with-sub-menu hover">
                                                  <p class="close-menu"></p>
                                                  <a href="#" class="clearfix">
                                                  <strong>
                                                  Home
                                                  </strong>
                                                  <b class="caret"></b>
                                                  </a>
                                                  <div class="sub-menu">
                                                    <div class="content">
                                                      <div class="row">
                                                        <div class="col-sm-12">
                                                          <div class="html ">
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                              <a href="index.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                <img src="{{asset('frontend')}}/image/catalog/demo/menu/feature/layout1.jpg" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                <p>Home Page 1</p>
                                                              </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                              <a href="home2.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                <img src="{{asset('frontend')}}/image/catalog/demo/menu/feature/layout2.jpg" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                <p>Home Page 2 </p>
                                                              </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                              <a href="home3.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                <img src="{{asset('frontend')}}/image/catalog/demo/menu/feature/layout3.jpg" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                <p>Home Page 3 </p>
                                                              </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                              <a href="home4.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                <img src="{{asset('frontend')}}/image/catalog/demo/menu/feature/layout4.jpg" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                <p>Home Page 4 </p>
                                                              </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                              <a href="home5.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                <img src="{{asset('frontend')}}/image/catalog/demo/menu/feature/layout5.jpg" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                <p>Home Page 5 </p>
                                                              </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12" style="text-align: center; margin-bottom: 20px;min-height: 140px;">
                                                              <a href="home6.html" title="" style="font-size: 12px;text-transform: uppercase;font-weight: bold;text-align: center;">
                                                                <img src="{{asset('frontend')}}/image/catalog/demo/menu/feature/layout6.jpg" alt="layout" style="margin: 0 0 10px; border: 1px solid #ddd;display: inline-block">
                                                                <p>Home Page 6 </p>
                                                              </a>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </li>
                                                <li class="full-width option2 with-sub-menu hover">
                                                  <p class="close-menu"></p>
                                                  <a class="clearfix">
                                                  <strong>
                                                  Features
                                                  </strong>
                                                  <span class="labelopencart"></span>
                                                  <b class="caret"></b>
                                                  </a>
                                                  <div class="sub-menu" style="width: 100%;">
                                                    <div class="content" >
                                                      <div class="row">
                                                        <div class="col-sm-12">
                                                          <div class="html ">
                                                            <div class="row">
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">Listing pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="category.html">Category Page 1 </a></li>
                                                                      <li><a href="category-v2.html">Category Page 2</a></li>
                                                                      <li><a href="category-v3.html">Category Page 3</a></li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">Product pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="product.html">Image size - small</a></li>
                                                                      <li><a href="product-v2.html">Image size - medium</a></li>
                                                                      <li><a href="product-v3.html">Image size - big</a></li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">Shopping pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="cart.html">Shopping Cart Page</a></li>
                                                                      <li><a href="checkout.html">Checkout Page</a></li>
                                                                      <li><a href="compare.html">Compare Page</a></li>
                                                                      <li><a href="wishlist.html">Wishlist Page</a></li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                <div class="column">
                                                                  <a href="#" class="title-submenu">My Account pages</a>
                                                                  <div>
                                                                    <ul class="row-list">
                                                                      <li><a href="login.html">Login Page</a></li>
                                                                      <li><a href="register.html">Register Page</a></li>
                                                                      <li><a href="my-account.html">My Account</a></li>
                                                                      <li><a href="order-history.html">Order History</a></li>
                                                                      <li><a href="order-information.html">Order Information</a></li>
                                                                      <li><a href="return.html">Product Returns</a></li>
                                                                      <li><a href="gift-voucher.html">Gift Voucher</a></li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </li>
                                                <li class="item-style1 content-full with-sub-menu hover">
                                                  <p class="close-menu"></p>
                                                  <a class="clearfix">
                                                  <strong>
                                                  Colections
                                                  </strong>
                                                  <span class="labelNew"></span>
                                                  <b class="caret"></b>
                                                  </a>
                                                  <div class="sub-menu" style="width: 100%; right: 0px;">
                                                    <div class="content">
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <div class="link ">
                                                            <img src="{{asset('frontend')}}/image/catalog/demo/menu/menu-img1.jpg" alt="" style="width: 100%;">
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="link ">
                                                            <img src="{{asset('frontend')}}/image/catalog/demo/menu/menu-img2.jpg" alt="" style="width: 100%;">
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="link ">
                                                            <img src="{{asset('frontend')}}/image/catalog/demo/menu/menu-img3.jpg" alt="" style="width: 100%;">
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="link ">
                                                            <img src="{{asset('frontend')}}/image/catalog/demo/menu/menu-img4.jpg" alt="" style="width: 100%;">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="border"></div>
                                                      <div class="row">
                                                        <div class="col-sm-3">
                                                          <div class="categories ">
                                                            <div class="row">
                                                              <div class="col-sm-12 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="category-v3.html" onclick="window.location = '#';" class="main-menu">Food &amp; Restaurant</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Women Fashion</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Bags</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Fashion</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Trending</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Macs</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="categories ">
                                                            <div class="row">
                                                              <div class="col-sm-12 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Fashion &amp; Accessories</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Pearl Jewelry</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Destinations</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Camera New</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Spa &amp; Massage</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Camera New</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Cell &amp; Cable</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="categories ">
                                                            <div class="row">
                                                              <div class="col-sm-12 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Sport &amp; Entertaiment</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Fashion &amp; Accessories</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Bags</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Men Fashion</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Knage unget</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Qunge genga</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                          <div class="categories ">
                                                            <div class="row">
                                                              <div class="col-sm-12 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Mobile &amp; Table</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Web Cameras</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Windows</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Pearl mens</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Pearl Jewelry</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Spa &amp; Massage</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </li>
                                                <li class="item-style2 content-full feafute with-sub-menu hover">
                                                  <p class="close-menu"></p>
                                                  <a class="clearfix">
                                                  <strong>
                                                  Accessories
                                                  </strong>
                                                  <b class="caret"></b>
                                                  </a>
                                                  <div class="sub-menu" style="width: 100%">
                                                    <div class="content">
                                                      <div class="row">
                                                        <div class="col-sm-8">
                                                          <div class="categories ">
                                                            <div class="row">
                                                              <div class="col-sm-4 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Fashion &amp; Accessories</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Digital &amp; Electronics</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Bluetooth Speakers</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Cell &amp; Cable</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Spa &amp; Massage</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Sport &amp; Entertaiment</a></li>
                                                                      </ul>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Pearl mens</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Web Cameras</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Windows</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Knage unget</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                              <div class="col-sm-4 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Sport &amp; Entertaiment</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Jean</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Latenge mange</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Punge nenune</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Trending</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                      </ul>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Mobile &amp; Table</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Case</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Laptop &amp; Notebook</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Laptops &amp; Notebooks</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Dress Ladies</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Kitchen</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                              <div class="col-sm-4 static-menu">
                                                                <div class="menu">
                                                                  <ul>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Cell &amp; Cable</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Bluetooth Speakers</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Fashion &amp; Accessories</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Qunge genga</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Punge nenune</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Punge nenune</a></li>
                                                                      </ul>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" onclick="window.location = '#';" class="main-menu">Food &amp; Restaurant</a>
                                                                      <ul>
                                                                        <li><a href="#" onclick="window.location = '#';">Fashion</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Bags</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Necklaces</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Tange manue</a></li>
                                                                        <li><a href="#" onclick="window.location = '#';">Men Fashion</a></li>
                                                                      </ul>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                          <div class="product best-sellers-menu">
                                                            <div class="image">
                                                              <a href="#" onclick="window.location = '#'"><img src="{{asset('frontend')}}/image/catalog/demo/product/fashion/24.png" alt=""></a>
                                                            </div>
                                                            <div class="name"><a href="#" onclick="window.location = '#'">Est Officia Including Shoes Beautiful Pieces Canaz</a></div>
                                                            <div class="price">
                                                              $98.00
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </li>
                                                <li class="style-page with-sub-menu hover">
                                                  <p class="close-menu"></p>
                                                  <a class="clearfix">
                                                  <strong>
                                                  Pages
                                                  </strong>
                                                  <b class="caret"></b>
                                                  </a>
                                                  <div class="sub-menu" style="width: 40%;">
                                                    <div class="content" >
                                                      <div class="row">
                                                        <div class="col-md-6">
                                                          <ul class="row-list">
                                                            <li><a class="subcategory_item" href="faq.html">FAQ</a></li>
                                                            <li><a class="subcategory_item" href="sitemap.html">Site Map</a></li>
                                                            <li><a class="subcategory_item" href="contact.html">Contact us</a></li>
                                                            <li><a class="subcategory_item" href="banner-effect.html">Banner Effect</a></li>
                                                          </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                          <ul class="row-list">
                                                            <li><a class="subcategory_item" href="about-us.html">About Us 1</a></li>
                                                            <li><a class="subcategory_item" href="about-us-2.html">About Us 2</a></li>
                                                            <li><a class="subcategory_item" href="about-us-3.html">About Us 3</a></li>
                                                            <li><a class="subcategory_item" href="about-us-4.html">About Us 4</a></li>
                                                          </ul>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </li>
                                                <li class="">
                                                  <p class="close-menu"></p>
                                                  <a href="blog-page.html" class="clearfix">
                                                  <strong>
                                                  Blog
                                                  </strong>
                                                  </a>
                                                </li>
                                                <li class="deal-h5 hidden">
                                                  <p class="close-menu"></p>
                                                  <a href="#" class="clearfix">
                                                  <strong>
                                                  <img src="{{asset('frontend')}}/image/catalog/demo/menu/hot-block.png" alt="">Buy This Theme!
                                                  </strong>
                                                  </a>
                                                </li>
                                                <li class="deal-h5 hidden">
                                                  <p class="close-menu"></p>
                                                  <a href="#" class="clearfix">
                                                  <strong>
                                                  Today Deals
                                                  </strong>
                                                  </a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>   