<script type="text/ng-template" id="addDirector.html">
    <div class="modal-body">
        <div class="form-group">
            <label for="input-name" class="control-label">Numele directorului</label>
            <input id="input-name" type="text" placeholder="Documente" class="form-control" ng-model="name">
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="store()">Salveaza</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Renunta</button>
    </div>
</script>
