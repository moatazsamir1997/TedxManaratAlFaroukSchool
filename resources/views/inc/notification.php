<li>
    <div ng-app="demoApp" class="ng-app">
        <div class="wrapper" ng-controller="demoController">
            <div class="nav-bar">
                <ul>
                    <li>
                        <div class="dropdowns-wrapper">
                            <div class="dropdown-container" style="position:relative;top:{{$css}}">
                                <div class="notifications dropdown dd-trigger" ng-click="showNotifications($event)">
                                    <span class="count animated" id="notifications-count">awaitingNotifications</span>
                                    <span class="fa fa-bell-o"></span>
                                </div>
                                <div class="dropdown-menu animated" id="notification-dropdown">
                                    <div class="dropdown-header">
                                        <span class="triangle"></span>
                                        <span class="heading">Notifications</span>
                                        <span class="count" id="dd-notifications-count">newNotifications.length</span>
                                    </div>
                                    <div class="dropdown-body">
                                        <div class="notification new" ng-repeat="notification in newNotifications.slice().reverse() track by notification.timestamp">
                                            <div class="notification-image-wrapper">
                                                <div class="notification-image">
                                                    <img src="notification.user.imageUrl" alt="" width="32">
                                                </div>
                                            </div>
                                            <div class="notification-text">
                                                <span class="highlight">notification.user.name</span> notification.action notification.target
                                            </div>
                                        </div>
                                        <div class="notification" ng-repeat="notification in readNotifications.slice().reverse() track by $index">
                                            <div class="notification-image-wrapper">
                                                <div class="notification-image">
                                                    <img src="notification.user.imageUrl" alt="" width="32">
                                                </div>
                                            </div>
                                            <div class="notification-text">
                                                <span class="highlight">notification.user.name</span> notification.action notification.target
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</li>
