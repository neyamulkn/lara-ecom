    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{asset('frontend')}}/js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/themejs/so_megamenu.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/slick-slider/slick.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/themejs/libs.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/unveil/jquery.unveil.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/countdown/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/datetimepicker/moment.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/modernizr/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/minicolors/jquery.miniColors.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/jquery.nav.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/quickview/jquery.magnific-popup.min.js"></script>
    <!-- Theme files
        ============================================ -->
    <script type="text/javascript" src="{{asset('frontend')}}/js/themejs/application.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/themejs/homepage.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/themejs/custom_h1.js"></script>
    <script type="text/javascript" src="{{asset('frontend')}}/js/themejs/addtocart.js"></script>  
    

    <script src="{{ mix('js/laravel-echo.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('frontend/js/typeahead.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.js') }}"></script>

    
     @yield('js')

 
   
    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    </script>


<!--     <script>
        
        Echo.channel('postBroadcast')
        .listen('PostCreated', (e) => {
            toastr.info(e.post['title']);
        });
    </script> -->
   <script>
    
    $(document).ready(function () {
        document.getElementById('pageLoading').style.display ='none';
        $('#searchKey').typeahead({

            source: function (query, result) {
                $.ajax({
                    url: '{{ route("search_keyword") }}',
                    data: 'q=' + query,            
                    dataType: "json",
                    type: "get",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
    });
</script>