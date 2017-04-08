<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User">
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li{!! Route::is('dashboard') ? ' class="active"' : '' !!}>
                <a href="{{ route('dashboard') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li{!! Request::is('dashboard/clients*') ? ' class="active"' : '' !!}>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">group</i>
                    <span>Clients</span>
                </a>
                <ul class="ml-menu">
                    <li{!! Route::is('clients.index') ? ' class="active"' : '' !!}>
                        <a href="{{ route('clients.index') }}">Manage</a>
                    </li>
                    <li{!! Route::is('clients.create') ? ' class="active"' : '' !!}>
                        <a href="{{ route('clients.create') }}">Create</a>
                    </li>
                    @if (Route::is('clients.edit'))
                        <li class="active"'>
                            <a>Editing</a>
                        </li>
                    @endif
                    @if (Route::is('clients.show'))
                        <li class="active">
                            <a>Viewing</a>
                        </li>
                    @endif
                </ul>
            </li>
            <li{!! Request::is('dashboard/services*') ? ' class="active"' : '' !!}>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">local_offer</i>
                    <span>Services</span>
                </a>
                <ul class="ml-menu">
                    <li{!! Route::is('services.index') ? ' class="active"' : '' !!}>
                        <a href="{{ route('services.index') }}">Manage</a>
                    </li>
                    <li{!! Route::is('services.create') ? ' class="active"' : '' !!}>
                        <a href="{{ route('services.create') }}">Create</a>
                    </li>
                    @if (Route::is('services.edit'))
                        <li class="active"'>
                            <a>Editing</a>
                        </li>
                    @endif
                    @if (Route::is('services.show'))
                        <li class="active">
                            <a>Viewing</a>
                        </li>
                    @endif
                </ul>
            </li>
            <li{!! Request::is('dashboard/jobs*') ? ' class="active"' : '' !!}>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">business_center</i>
                    <span>Jobs</span>
                </a>
                <ul class="ml-menu">
                    <li{!! Route::is('jobs.index') ? ' class="active"' : '' !!}>
                        <a href="{{ route('jobs.index') }}">Manage</a>
                    </li>
                    <li{!! Route::is('jobs.create') ? ' class="active"' : '' !!}>
                        <a href="{{ route('jobs.create') }}">Create</a>
                    </li>
                    @if (Route::is('jobs.edit'))
                        <li class="active"'>
                            <a>Editing</a>
                        </li>
                    @endif
                    @if (Route::is('jobs.show'))
                        <li class="active">
                            <a>Viewing</a>
                        </li>
                    @endif
                </ul>
            </li>
            <li{!! Request::is('dashboard/reports*') ? ' class="active"' : '' !!}>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">insert_chart</i>
                    <span>Reports</span>
                </a>
                <ul class="ml-menu">
                    <li{!! Route::is('reports.week') ? ' class="active"' : '' !!}>
                        <a href="{{ route('reports.week') }}">Weekly</a>
                    </li>
                    <li{!! Route::is('reports.month') ? ' class="active"' : '' !!}>
                        <a href="{{ route('reports.month') }}">Monthly</a>
                    </li>
                    <li{!! Route::is('reports.index') ? ' class="active"' : '' !!}>
                        <a href="{{ route('reports.index') }}">Generate</a>
                    </li>
                    @if (Route::is('reports.show'))
                        <li class="active">
                            <a>Viewing</a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.4
        </div>
    </div>
    <!-- #Footer -->
</aside>