@extends('layouts.frontend')
@section('title', 'Cart Item')
@section('css')

@endsection
@section('content')
        <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            
            <ul class="breadcrumb-cate">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#">Cart</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div id="pageLoading"></div>
        <div class="row" id="cart_summary">
            @include('frontend.carts.cart_summary')
        </div>
    </div>          
    @include('frontend.modal.cartItemRemove')
@endsection

@section('js')

<script type="text/javascript">
    function cartUpdate(id){
        document.getElementById('pageLoading').style.display = 'block';
        var qty = $('#qtyTotal'+id).val();
        if(parseInt(qty) && qty>0){
            $.ajax({
                url:"{{route('cart.update')}}",
                method:"get",
                data:{ id:id,qty:qty },
                success:function(data){
                    if(data.status == 'error'){
                        toastr.error(data.msg);
                    }else{
                        $('#cart_summary').html(data);
                        toastr.success('Quantity Update Successful');
                    }
                    document.getElementById('pageLoading').style.display = 'none';
                },
                error: function(jqXHR, exception) {
                    toastr.error('Internal server error.');
                    document.getElementById('pageLoading').style.display = 'none';
                }
            });
        }else{
            toastr.error('Invalid Number.');
            document.getElementById('pageLoading').style.display = 'none';
        }
    }    

   $("#couponForm").submit(function(e) {
        e.preventDefault(); 
        var coupon_code = $('#coupon_code').val();
       
        document.getElementById('pageLoading').style.display = 'block';
        $.ajax({
            url:"{{route('coupon.apply')}}",
            method:"get",
            data:{ coupon_code:coupon_code },
            success:function(data){
                document.getElementById('pageLoading').style.display = 'none';
                if(data.status == 'error'){
                    $('#grandTotal').html(data.total);
                    toastr.error(data.msg);
                }else{
                    $('#cart_summary').html(data);
                    toastr.success('Coupon code successfully applied. You are available discount..');
                }
               
            },
            error: function(jqXHR, exception) {
                toastr.error('Internal server error.');
                document.getElementById('pageLoading').style.display = 'none';
            }
        });
    });
</script>

@endsection