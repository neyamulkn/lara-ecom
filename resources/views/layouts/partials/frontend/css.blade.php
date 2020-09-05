<!-- Libs CSS
        ============================================ -->
<link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap/css/bootstrap.min.css">
<link href="{{asset('frontend')}}/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="{{asset('frontend')}}/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="{{asset('frontend')}}/js/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/lib.css" rel="stylesheet">
<link href="{{asset('frontend')}}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="{{asset('frontend')}}/js/minicolors/miniColors.css" rel="stylesheet">
<!-- Theme CSS
    ============================================ -->
<link href="{{asset('frontend')}}/css/themecss/so_sociallogin.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/so_searchpro.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/so_megamenu.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/so-categories.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/so-listing-tabs.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/so-category-slider.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/themecss/so-newletter-popup.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/footer/footer2.css" rel="stylesheet">


<link href="{{asset('frontend')}}/css/header/header6.css" rel="stylesheet">
<link id="color_scheme" href="{{asset('frontend')}}/css/home4.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/responsive.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/quickview/quickview.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/custom.css" rel="stylesheet">
<link href="{{ asset('frontend/css/toastr.css') }}"  rel="stylesheet">

<style type="text/css">
    #pageLoading
    {
        z-index: 999999; 
        width: 100%;
        height: 100%;
        top: 10%;
        left: 10%;
        text-align: center;
        min-height: 200px;
        position: fixed;
        background: url('{{ asset("assets/images/loading.gif")}}') no-repeat center; 
    }
    #loadingData
    {
        z-index: 999999; 
        width: 100%;
        height: 100%;
        min-height: 100px;
        display: none;
        position: fixed;
        background: url('{{ asset("assets/images/loading.gif")}}') no-repeat center; 
    }
    .loadingData-sm
    {
        z-index: 9999; 
        width: 100%;
        height: 20px;
        background: url('{{ asset("assets/images/loader.gif")}}') no-repeat center; 
    }
</style>
@yield('css')