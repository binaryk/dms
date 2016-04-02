@extends('~layout.~template')

@section('content')
    <div class="panel">
        <div class="panel-heading">
            Type of report
        </div>
    </div>
    <div class="panel-body">
        <a href="{!! route('ps.parsator.report.user_json') !!}" class="btn btn-default">USER JSON</a>
        <a href="{!! route('ps.parsator.report.user_xml') !!}" class="btn btn-default">USER XML</a>

        <a href="{!! route('ps.parsator.report.vehicle_json') !!}" class="btn btn-default">VEHICLE JSON</a>
        <a href="{!! route('ps.parsator.report.vehicle_xml') !!}" class="btn btn-default">VEHICLE XML</a>

        <a href="{!! route('ps.parsator.report.reserved') !!}" class="btn btn-default">Rental tests report</a>
        <a href="{!! route('ps.parsator.report.reserved_email') !!}" class="btn btn-default">Rental tests report by email</a>
    </div>
@stop

@section('js')

@endsection

@section('css')

@endsection

