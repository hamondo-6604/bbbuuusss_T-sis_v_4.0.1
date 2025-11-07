<div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="icon">
                    <ion-icon name="logo-apple"></ion-icon>
                </span>
                <span class="title">BBS</span>
            </a>
        </li>

        {{-- admin_menu --}}
        @if (Auth::user()->role === 'admin')
            <li>
                <a href="{{ url('admin/dashboard') }}">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a href="#">
                    <span class="icon">
                        <ion-icon name="bus-outline"></ion-icon>
                    </span>
                    <span class="title">Bus Management</span>
                    <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
                </a>

                <!-- Submenu: Bus Management Options -->
                <ul class="submenu">

                    <!-- View list of all registered buses -->
                    {{-- <li>
                        <a href="{{ route('admin.buses.index') }}">
                            <ion-icon name="list-outline"></ion-icon>
                            <span>All Buses</span>
                        </a>
                    </li>

                    <!-- Form page to add/register a new bus -->
                    <li>
                        <a href="{{ route('admin.buses.create') }}">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            <span>Add New Bus</span>
                        </a>
                    </li> --}}
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.buses.index') }}">
                    <ion-icon name="list-outline"></ion-icon>
                    <span>All Buses</span>
                </a>
            </li>

            <!-- Form page to add/register a new bus -->
            <li>
                <a href="{{ route('admin.buses.create') }}">
                    <ion-icon name="add-circle-outline"></ion-icon>
                    <span>Add New Bus</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.bus-types.index') }}">
                    <ion-icon name="add-circle-outline"></ion-icon>
                    <span>Bus Type</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.seat-layouts.index') }}">
                    <ion-icon name="grid-outline"></ion-icon>
                    <span>Seat Layout</span>
                </a>
            </li>

            {{-- user_menu --}}
        @elseif(Auth::user()->role === 'customer')
            <li>
                <a href="{{ url('user/dashboard') }}">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>
        @endif

        <li>
            <a href="{{ url('logout ') }}">
                <span class="icon">
                    <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Sign Out</span>
            </a>
        </li>
    </ul>
</div>
