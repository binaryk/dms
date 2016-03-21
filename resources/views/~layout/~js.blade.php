<!-- MODERNIZR-->
{!! HTML::script('angel/vendor/modernizr/modernizr.custom.js') !!}
<!-- MATCHMEDIA POLYFILL-->
{!! HTML::script('angel/vendor/matchMedia/matchMedia.js') !!}
<!-- JQUERY-->
{!! HTML::script('angel/vendor/jquery/dist/jquery.js') !!}
<!-- BOOTSTRAP-->
{!! HTML::script('angel/vendor/bootstrap/dist/js/bootstrap.js') !!}
<!-- STORAGE API-->
{!! HTML::script('angel/vendor/jQuery-Storage-API/jquery.storageapi.js') !!}
<!-- JQUERY EASING-->
{!! HTML::script('angel/vendor/jquery.easing/js/jquery.easing.js') !!}
<!-- ANIMO-->
{!! HTML::script('angel/vendor/animo.js/animo.js') !!}
<!-- SLIMSCROLL-->
{!! HTML::script('angel/vendor/slimScroll/jquery.slimscroll.min.js') !!}
<!-- SCREENFULL-->
{!! HTML::script('angel/vendor/screenfull/dist/screenfull.js') !!}
<!-- LOCALIZE-->
{!! HTML::script('angel/vendor/jquery-localize-i18n/dist/jquery.localize.js') !!}
<!-- RTL demo-->
{!! HTML::script('angel/js/demo/demo-rtl.js') !!}
{!! HTML::script('angel/js/app.js') !!}


{!! HTML::script('vendor/select2/js/select2.full.min.js') !!}
{!! HTML::script('vendor/select2/js/i18n/ro.js') !!}

{!! HTML::script('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
{!! HTML::script('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.ro.min.js') !!}

{!! HTML::script('vendor/numeral/numeral.min.js') !!}
{!! HTML::script('vendor/numeral/ro.js') !!}
{!! HTML::script('vendor/moment/moment.min.js') !!}

{!! HTML::script('vendor/file-input/js/fileinput.min.js') !!}
{!! HTML::script('vendor/file-input/js/fileinput_locale_ro.js') !!}

{!! HTML::script('comptech/helper/ajax.js') !!}
{!! HTML::script('comptech/ui/modal.js') !!}
{!! HTML::script('comptech/actions/actions.js') !!}
{!! HTML::script('comptech/actions/filter.js') !!}



{!! HTML::script('custom/angular/main.js') !!}
<script>
    var token = $('meta[name="csrf_token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token,
            'X-XSRF-TOKEN': token
        },
        '_token' : token,
        async    : false
    });
    var _config = {
        base: "{!! url('/') !!}"
    };
</script>
@yield('js')

@yield('custom-javascript-files')
<script>
    $(document).ready( function(){
//        myApp = ComptechApp();
        @yield('jquery-document-ready')
    });
</script>