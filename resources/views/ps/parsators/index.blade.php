@extends('~layout.~template')
@section('ctrl')

@stop
@section('content')
    <div class="col-xs-12" id="image-upload-box">
        <input type="file" name="file" class="form-control" id="file">
    </div>
@stop


@section('css')
    @parent

    <link rel="stylesheet" href="{!! asset('vendor\file-input\css\fileinput.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('custom/css/file-icons.css') !!}">
@stop


@section('js')
    @parent
    <script>

        var file = $("[name=file]").fileinput({
            'dropZoneEnabled' : true,
            'showCaption'     : true,
            'showUpload'      : true,
            'showRemove'      : true,
            'uploadAsync'     : true,
            'uploadAsync'     : true,
            'uploadUrl'       : "{!! route('ps.parsator.uploadxml') !!}",
        });

        file.on('filepreupload', function(event) {
            Spinner.show();
        });

        file.on('fileuploaded', function(event, data, previewId, index) {
//            var form = data.form, files = data.files, extra = data.extra,
//                    response = data.response, reader = data.reader;
            console.log('File fileuploaded triggered');
            Spinner.hide(1000, function(){
                var afirm = new App.Afirm();
                afirm.onConfirm = function(){
                    window.location.href = "vehicles";
                }
                afirm.question("Foarte bine!","Importul a avut loc cu succes. Mergeti la lista ?",'success');
            });
        });


    </script>
@stop