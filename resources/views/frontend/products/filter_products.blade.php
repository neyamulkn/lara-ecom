@if(count($products)>0)
<div class="product-filter filters-panel">
    <div class="row">
        <div class="col-sm-5 col-md-5 col-xs-12">({{ ($products) ?  $products->total() : '0' }}) products found for {{Request::get('q')}}</div>
    
        <div class="short-by-show form-inline text-right hidden-sm hidden-xs col-xs-8 col-md-5 col-sm-5">
            <div class="form-group short-by">
                <label class="control-label" for="input-sort">Sort By:</label>
                <select onchange="sortproduct()" id="sortby" class="form-control" >
                    <option value="">Default</option>

                    <option @if(Request::get('sortby') == 'asc') selected @endif value="asc">Name (A - Z)</option>
                    <option @if(Request::get('sortby') == 'desc') selected @endif value="desc"> Name (Z - A) </option>
                    <option @if(Request::get('sortby') == 'asc') selected @endif value="asc">Price (Low &gt; High)</option>
                    <option @if(Request::get('sortby') == 'desc') selected @endif value="desc"> Price (High &gt; Low) </option>
                    <option @if(Request::get('sortby') == 'asc') selected @endif value="asc">Rating (Highest)</option>
                    <option @if(Request::get('sortby') == 'desc') selected @endif value="desc"> Rating (Lowest) </option>

                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-limit">Show:</label>
                <select class="form-control" onchange="showPerPage()" id="perPage">
                    <option value="15">Default</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select>
            </div>
            
        </div>
        <div class="col-sm-2 view-mode hidden-sm hidden-xs">
          <div class="list-view" style="float: right;">
            <button class="btn btn-default grid active" data-view="grid" data-toggle="tooltip"  data-original-title="Grid"><i class="fa fa-th"></i></button>
            <button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>
          </div>
        </div>         
    </div>
</div>
<div class="products-list grid row number-col-4 so-filter-gird">
    @foreach($products as $product)
    <div class="product-layout col-lg-3 col-md-4 col-sm-6 col-xs-6">
        @include('frontend.products.products')
    </div>
    @endforeach
</div>

<div class="product-filter product-filter-bottom filters-panel">
    <div class="col-sm-6 text-center">
       {{$products->appends(request()->query())->links()}}
      </div>
    <div class="col-sm-6 text-right">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{$products->total()}} entries ({{$products->lastPage()}} Pages)</div>
</div>

@else
<div style="text-align: center;">
    <h3>Search Result Not Found.</h3>
    <p>We're sorry. We cannot find any matches for your search term</p>
    <i style="font-size: 10rem;" class="fa fa-search"></i>
</div>
@endif