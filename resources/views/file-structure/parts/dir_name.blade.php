<div class="col-xs-4"  ng-show="fs.addDir" ng-cloak>
    <div id="new-child-dir" class="panel panel-default">
        <form role="form"  _lpchecked="1" ng-submit="fs.storeDirectory()">
            <div class="panel-heading">Adaugă un director în spațiul dvs de stocare
                <a href="#" ng-click="fs.addDir = !fs.addDir" data-tool="panel-dismiss" data-toggle="tooltip" title="" class="pull-right" data-original-title="Close Panel">
                    <em class="fa fa-times"></em>
                </a>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <label for="input-name" class="sr-only">Numele directorului</label>
                        <input id="input-name" type="text" placeholder="Documente" class="form-control" ng-model="fs.form.name" autocomplete="off">
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-default">Salvează</button>
                    <button type="button" class="btn btn-link" ng-click="fs.addDir = !fs.addDir">Renunță</button>
                </div>
            </div>
        </form>
    </div>
</div>