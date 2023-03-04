<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs(['admin.dashboard', 'admin.']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ __('admin.dashboard') }}
                    </p>
                </a>
            </li>
            @role('admin')
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.users.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{ request()->routeIs(['admin.users.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.users.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }} users</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}"
                                class="nav-link {{ request()->routeIs(['admin.users.create']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.add') . ' ' . __('admin.new') }}</p>
                            </a>
                        </li>



                    </ul>
                </li>
            @endrole
            @role('admin')
           
            <li class="nav-item has-treeview {{ request()->routeIs(['admin.permissions.*']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Permissions
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview {{ request()->routeIs(['admin.permissions.*']) ? 'd-block' : 'display-none' }}">

                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ request()->routeIs(['admin.permissions.index']) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('admin.all') }} permissions</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.create') }}"
                            class="nav-link {{ request()->routeIs(['admin.permissions.create']) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('admin.add') . ' ' . __('admin.new') }}</p>
                        </a>
                    </li>



                </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs(['admin.roles.*']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Roles
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview {{ request()->routeIs(['admin.roles.*']) ? 'd-block' : 'display-none' }}">

                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ request()->routeIs(['admin.roles.index']) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('admin.all') }} roles</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.roles.create') }}"
                            class="nav-link {{ request()->routeIs(['admin.roles.create']) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('admin.add') . ' ' . __('admin.new') }}</p>
                        </a>
                    </li>



                </ul>
            </li>
        @endrole


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
