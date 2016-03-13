@if( Access::hasRole('Superadmin') )
    @include('basic.welcome.auth._partials.navigation.superadmin')
@endif

@if( Access::hasRole('Administrator Gal') )
    @include('basic.welcome.auth._partials.navigation.galadmin')
@endif