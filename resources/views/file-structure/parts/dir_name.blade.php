<div class="panel panel-default" ng-show="fs.addDir" ng-cloak>
    <div class="panel-body">
        <form role="form" class="form-inline" _lpchecked="1" ng-submit="fs.storeDirectory()">
            <div class="form-group">
                <label for="input-name" class="sr-only">Numele directorului</label>
                <input id="input-name" type="text" placeholder="Documente" class="form-control" ng-model="fs.form.name" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-default">Salveaza</button>
        </form>
    </div>
</div>