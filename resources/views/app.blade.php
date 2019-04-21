<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assets</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="/css/bulma.css"/>
        <link rel="stylesheet" href="/css/app.css"/>

    </head>
    <body class="font-sans">

        {{--App--}}
        <div id="app">

            <!-- START NAV -->
            <nav class="navbar is-white">
                <div class="container">
                    <div class="navbar-brand">
                        <a class="navbar-item brand-text" href="../">
                            UPTIME
                        </a>
                        <div class="navbar-burger burger" data-target="navMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div id="navMenu" class="navbar-menu">
                        <div class="navbar-start">
                            <a class="navbar-item" href="admin.html">
                                Home
                            </a>
                            <a class="navbar-item" href="admin.html">
                                Orders
                            </a>
                            <a class="navbar-item" href="admin.html">
                                Payments
                            </a>
                            <a class="navbar-item" href="admin.html">
                                Exceptions
                            </a>
                        </div>

                    </div>
                </div>
            </nav>
            <!-- END NAV -->
            <div class="container">
                <div class="columns">
                    <div class="column is-3 has-text-weight-bold">
                        <aside class="menu is-hidden-mobile mt-20">

                            <ul class="menu-list">

                                <li>
                                    <a>Manage Your Servers</a>
                                    <ul>
                                        <li><a>Members</a></li>
                                        <li><a>Plugins</a></li>
                                        <li><a>Add a member</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </aside>
                    </div>
                    <div class="column is-9 mt-20">
                        <servers></servers>
                    </div>
                </div>
            </div>


        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
