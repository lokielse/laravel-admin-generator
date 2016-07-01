<?php
/** @var string $name */
$instance   = config("admin-generator.instances.{$name}");
$assetsDir  = config('admin-generator.bower.directory', 'bower_components');
$trimPrefix = trim($instance['prefix'], '/');
$base       = $trimPrefix ? ( $trimPrefix . '/' ) : '';
$apiBase    = $request->getUriForPath("/{$base}~");
?><!DOCTYPE html>
<html lang="en" ng-app="{{ $instance['ng_app'] }}">

<head>
    <base href="/{{ $base }}"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin | Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("{$assetsDir}/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset("{$assetsDir}/metisMenu/dist/metisMenu.min.css") }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset("{$assetsDir}/startbootstrap-sb-admin-2/dist/css/timeline.css") }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset("{$assetsDir}/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css") }}" rel="stylesheet">

    <!-- ng-table CSS -->
    <link href="{{ asset("{$assetsDir}/ng-table/dist/ng-table.min.css") }}" rel="stylesheet">

    <!-- Angular Bootstrap CSS -->
    <link href="{{ asset("{$assetsDir}/angular-bootstrap/ui-bootstrap-csp.css") }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset("{$assetsDir}/morrisjs/morris.css") }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset("{$assetsDir}/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css">


    <!-- APP CSS -->
    <link href="{{ asset("css/{$namespace}/{$name}/app.css") }}" rel="stylesheet">

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" id="main-nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Admin beta</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    {{--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
                    {{--</li>--}}
                    {{--<li class="divider"></li>--}}
                    <li><a href="#set_it_first"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation" ng-controller="MenuController" ng-cloak>
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    {{--<li class="sidebar-search">--}}
                    {{--<div class="input-group custom-search-form">--}}
                    {{--<input type="text" class="form-control" placeholder="Search...">--}}
                    {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-default" type="button">--}}
                    {{--<i class="fa fa-search"></i>--}}
                    {{--</button>--}}
                    {{--</span>--}}
                    {{--</div>--}}
                    {{--<!-- /input-group -->--}}
                    {{--</li>--}}
                    {{--menu start--}}
                    <li ng-repeat="menu in menus" ng-cloak>
                        <a ui-sref="@{{menu.state}}" ui-sref-active="active"><i
                                    class="fa fa-@{{menu.icon}} fa-fw"></i> @{{menu.title}}<span
                                    class="fa arrow" ng-show="menu.menus.length"></span></a>
                        <ul class="nav nav-second-level" ng-if="menu.menus.length">
                            <li ng-repeat="menu in menu.menus">
                                <a ui-sref="@{{menu.state}}" ui-sref-active="active">@{{menu.title}}<span
                                            class="fa arrow"
                                            ng-show="menu.menus.length"></span></a>
                                <ul class="nav nav-third-level" ng-if="menu.menus.length">
                                    <li ng-repeat="menu in menu.menus">
                                        <a ui-sref="@{{menu.state}}">@{{menu.title}}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    {{--<li>--}}
                    {{--<a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="panels-wells.html">Panels and Wells</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="buttons.html">Buttons</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="notifications.html">Notifications</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="typography.html">Typography</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="icons.html"> Icons</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="grid.html">Grid</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<!-- /.nav-second-level -->--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span--}}
                    {{--class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="#">Second Level Item</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Second Level Item</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level <span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-third-level">--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Item</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Item</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Item</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Item</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<!-- /.nav-third-level -->--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<!-- /.nav-second-level -->--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                    {{--<a href="blank.html">Blank Page</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="login.html">Login Page</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<!-- /.nav-second-level -->--}}
                    {{--</li>--}}
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper" ui-view style="overflow-y: scroll"></div>

    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{ asset("{$assetsDir}/jquery/dist/jquery.min.js") }}"></script>
<script src="{{ asset("{$assetsDir}/angular/angular.min.js") }}"></script>
<script src="{{ asset("{$assetsDir}/angular-resource/angular-resource.min.js") }}"></script>
<script src="{{ asset("{$assetsDir}/angular-ui-router/release/angular-ui-router.min.js") }}"></script>
<script src="{{ asset("js/{$namespace}/{$name}/app.js") }}"></script>
<script src="{{ asset("js/{$namespace}/{$name}/templates.js") }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset("{$assetsDir}/bootstrap/dist/js/bootstrap.min.js") }}"></script>

<!-- UI Bootstrap Core JavaScript -->
<script src="{{ asset("{$assetsDir}/angular-bootstrap/ui-bootstrap.min.js") }}"></script>
<script src="{{ asset("{$assetsDir}/angular-bootstrap/ui-bootstrap-tpls.min.js") }}"></script>

<!-- ng-table JavaScript-->
<script src="{{ asset("{$assetsDir}/ng-table/dist/ng-table.min.js") }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset("{$assetsDir}/metisMenu/dist/metisMenu.min.js") }}"></script>


<!-- masonry -->
<script src="{{ asset("{$assetsDir}/jquery-bridget/jquery.bridget.js") }}"></script>
<script src="{{ asset("{$assetsDir}/get-style-property/get-style-property.js") }}"></script>
<script src="{{ asset("{$assetsDir}/get-size/get-size.js") }}"></script>
<script src="{{ asset("{$assetsDir}/eventEmitter/EventEmitter.js") }}"></script>
<script src="{{ asset("{$assetsDir}/eventie/eventie.js") }}"></script>
<script src="{{ asset("{$assetsDir}/doc-ready/doc-ready.js") }}"></script>
<script src="{{ asset("{$assetsDir}/matches-selector/matches-selector.js") }}"></script>
<script src="{{ asset("{$assetsDir}/fizzy-ui-utils/utils.js") }}"></script>
<script src="{{ asset("{$assetsDir}/outlayer/item.js") }}"></script>
<script src="{{ asset("{$assetsDir}/outlayer/outlayer.js") }}"></script>
<script src="{{ asset("{$assetsDir}/masonry/masonry.js") }}"></script>
<script src="{{ asset("{$assetsDir}/imagesloaded/imagesloaded.js") }}"></script>
<script src="{{ asset("{$assetsDir}/angular-masonry/angular-masonry.js") }}"></script>
<!-- masonry -->

<!-- Custom Theme JavaScript -->
<script src="{{ asset("{$assetsDir}/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js") }}"></script>

<script type="text/javascript">
    jQuery(function () {

        var windowHeight = $(window).height();
        var navHeight = $('#main-nav').height() + 1;


        function updateWrapperHeight() {
            $('#page-wrapper').css({
                height: windowHeight - navHeight + 'px',
                minHeight: windowHeight - navHeight + 'px'
            });
        }

        $('#side-menu').click(function () {
            setTimeout(function () {
                updateWrapperHeight();
            });
        });

        updateWrapperHeight();

    });

</script>

</body>

</html>
