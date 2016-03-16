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


{!! Html::script('vendor/select2/js/select2.full.min.js') !!}
{!! Html::script('vendor/select2/js/i18n/ro.js') !!}

{!! Html::script('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
{!! Html::script('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.ro.min.js') !!}

{!! Html::script('vendor/numeral/numeral.min.js') !!}
{!! Html::script('vendor/numeral/ro.js') !!}
{!! Html::script('vendor/moment/moment.min.js') !!}

{!! Html::script('vendor/file-input/js/fileinput.min.js') !!}
{!! Html::script('vendor/file-input/js/fileinput_locale_ro.js') !!}

{!! Html::script('comptech/helper/ajax.js') !!}
{!! Html::script('comptech/ui/modal.js') !!}
{!! Html::script('comptech/actions/actions.js') !!}
{!! Html::script('comptech/actions/filter.js') !!}



{!! Html::script('custom/angular/main.js') !!}
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
    var _config = {};
</script>
@yield('js')
@yield('custom-javascript-files')