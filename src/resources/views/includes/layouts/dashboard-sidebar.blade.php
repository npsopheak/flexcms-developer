
    <nav class="sidebar-nav" ng-controller="LeftCtrl">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="icon-speedometer"></i> Dashboard <span class="badge badge-primary">NEW</span></a>
            </li>
            
            <li class="nav-item nav-dropdown" ng-repeat="(i, menu) in menus">
                <a  class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> <% menu.text %></a>
                <ul class="nav-dropdown-items" ng-repeat="item in menu.items">
                    <li class="nav-item" >
                        <a class="nav-link" ng-click="!item.event ? navigateTo(item.path, $event) : item.event(this)" ><i class="icon-puzzle"></i> <% item.name %></a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
