@extends('~layout.~template')
@section('ctrl')
@stop
@section('content')

    <div class="col-lg-12">
        <!-- START panel-->
        <div class="panel panel-default">
            <div class="panel-heading">User accounts</div>
            <div class="panel-body">
                <!-- START table-responsive-->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Identification number</th>
                            <th>Type</th>
                            <th>Ammount money</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $k => $account)
                        <tr>
                            <td>{!! $k !!}</td>
                            <td>{!! $account->identification_number !!}</td>
                            <td>{!! $account->type !!}</td>
                            <td>{!! $account->amount_money !!}</td>
                            <td>@mdo</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END table-responsive-->
            </div>
        </div>
        <!-- END panel-->
    </div>

@stop

