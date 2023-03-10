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
            @role(['supervisor', 'admin'])
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.users.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            @role("supervisor") {{ __('Workers') }} @endrole
                            @role("admin") {{ __('Users') }} @endrole

                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{ request()->routeIs(['admin.users.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.users.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}   @role("supervisor") {{ __('Workers') }} @endrole
                                    @role("admin") {{ __('Users') }} @endrole
                                </p>
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
                            {{ __('Permissions') }}


                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview {{ request()->routeIs(['admin.permissions.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.permissions.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }} {{ __('Permissions') }}
                                </p>
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
                            {{ __('Roles') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{ request()->routeIs(['admin.roles.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.roles.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}
                                    {{ __('Roles') }}

                                </p>
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

            @role(['supervisor', 'admin'])
                <li
                    class="nav-item has-treeview {{ request()->routeIs(['admin.leaves.*', 'admin.logs.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-sign fas"></i>
                        <p>
                            {{ __('Log and Leave') }}

                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview {{ request()->routeIs(['admin.logs.*', 'admin.logs.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.logs.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.logs.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p> {{ __('Logs') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.leaves.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.leaves.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    {{ __('Leaves') }}

                                </p>
                            </a>
                        </li>




                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.projects.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            {{ __('Projects') }}


                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview {{ request()->routeIs(['admin.projects.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.projects.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.projects.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}
                                    {{ __('Projects') }}

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.projects.create') }}"
                                class="nav-link {{ request()->routeIs(['admin.projects.create']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.add') . ' ' . __('admin.new') }}</p>
                            </a>
                        </li>



                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.letter_subjects.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-file fas"></i>
                        <p>
                            {{ __('Letter subjects') }}


                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview {{ request()->routeIs(['admin.letter_subjects.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.letter_subjects.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.letter_subjects.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }} {{ __('Letter subjects') }}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.letter_subjects.create') }}"
                                class="nav-link {{ request()->routeIs(['admin.letter_subjects.create']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.add') . ' ' . __('admin.new') }}</p>
                            </a>
                        </li>



                    </ul>
                </li>
                @role("supervisor")
                <li class="nav-item has-treeview {{ request()->routeIs(['admin.letters.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-envelope fas"></i>
                        <p>
                            {{ __('Letters') }}


                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview {{ request()->routeIs(['admin.letters.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.letters.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.letters.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }} {{ __('Letters') }}
                                </p>
                            </a>
                        </li>




                    </ul>
                </li>
                @endrole

                <li class="nav-item has-treeview {{ request()->routeIs(['admin.offs.*']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-power-off fas"></i>
                        <p>
                            {{ __('Offs') }}


                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview {{ request()->routeIs(['admin.offs.*']) ? 'd-block' : 'display-none' }}">

                        <li class="nav-item">
                            <a href="{{ route('admin.offs.index') }}"
                                class="nav-link {{ request()->routeIs(['admin.offs.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.all') }}
                                    {{ __('Offs') }}
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
            @endrole
            @role("supervisor")
            <li class="nav-item has-treeview {{ request()->routeIs(['admin.settings.*']) ? 'menu-open' : '' }}">
                <a href="{{route("admin.settings.index")}}" class="nav-link">
                    <i class="nav-icon fa-cogs fas"></i>
                    <p>
                        {{ __('Settings') }}


                       
                    </p>
                </a>
              
            </li>
            @endrole


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
