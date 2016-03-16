<ul>
    <li ng-repeat="file in fs.files" context-menu="fs.menuOptions">
        Name: [[ file.name ]]
        Path: [[ file.path ]]
        button.btn.btn-xs.btn-success
    </li>
</ul>