<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">I'm a modal!</h3>
    </div>
    <div class="modal-body">
        <ul>
        </ul>
    </div>
    <div class="modal-footer">
        <button ng-click="fs.test()">asda</button>
        <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
</script>

<button type="button" class="btn btn-default" ng-click="fs.open()">Open me!</button>