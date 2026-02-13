<aside class="navbar-aside" id="offcanvas_aside">
            <div class="aside-top">
                <a href="index.html" class="brand-wrap">
                    <img src="{{ asset('backend/assets/imgs/theme/logo.png') }}" class="logo" alt="Nest Dashboard" />
                </a>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a class="menu-link" href="{{route('dashboard')}}">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    @can('user-list')
                    <li class="menu-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('user.index') }}">
                            <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Users</span>
                        </a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li class="menu-item {{ request()->routeIs('role.*') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('role.index') }}">
                            <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Roles</span>
                        </a>
                    </li>
                    @endcan
                    @can('permission-list')
                    <li class="menu-item {{ request()->routeIs('permission.*') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('permission.index') }}">
                            <i class="icon material-icons md-add_box"></i>
                            <span class="text">Permissions</span>
                        </a>
                    </li>
                    @endcan
                </ul>
                <hr />
                <br />
                <br />
            </nav>
        </aside>