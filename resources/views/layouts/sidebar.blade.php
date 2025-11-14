<div class="navigation">
    <ul>
        <!-- Logo Section -->
        <li class="title">
            <a href="#">
                <span class="icon">
                    <ion-icon name="logo-apple"></ion-icon>
                </span>
                <span class="title">BBS</span>
            </a>
        </li>

        {{-- Admin Menu --}}
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
                <a href="#" class="toggle-submenu">
                    <span class="icon">
                        <ion-icon name="bus-outline"></ion-icon>
                    </span>
                    <span class="title">Bus Management</span>
                    <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
                </a>

                <!-- Submenu: Bus Management Options -->
                <ul class="submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.buses.index') }}">
                            <ion-icon name="list-outline"></ion-icon>
                            <span>All Buses</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.buses.create') }}">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            <span>Add New Bus</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bus-types.index') }}">
                            <ion-icon name="options-outline"></ion-icon>
                            <span>Bus Types</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.seat-layouts.index') }}">
                            <ion-icon name="grid-outline"></ion-icon>
                            <span>Seat Layouts</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-submenu">
                <a href="#" class="toggle-submenu">
                    <span class="icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </span>
                    <span class="title">Booking Management</span>
                    <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
                </a>

                <!-- Submenu: Booking Management -->
                <ul class="submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.bookings.index') }}">
                            <ion-icon name="list-outline"></ion-icon>
                            <span>All Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.create') }}">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            <span>Create Booking</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.status.pending') }}">
                            <ion-icon name="hourglass-outline"></ion-icon>
                            <span>Pending Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.status.completed') }}">
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                            <span>Completed Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.status.cancelled') }}">
                            <ion-icon name="close-circle-outline"></ion-icon>
                            <span>Cancelled Bookings</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-submenu">
                <a href="#" class="toggle-submenu">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Users Management</span>
                    <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
                </a>

                <!-- Submenu: Users Management -->
                <ul class="submenu" style="display: none;">
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <ion-icon name="list-outline"></ion-icon>
                            <span>All Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.create') }}">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            <span>Add New User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user-roles.index') }}">
                            <ion-icon name="shield-checkmark-outline"></ion-icon>
                            <span>User Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.blocked') }}">
                            <ion-icon name="ban-outline"></ion-icon>
                            <span>Blocked Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.activity') }}">
                            <ion-icon name="reader-outline"></ion-icon>
                            <span>User Activity</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.bulk') }}">
                            <ion-icon name="download-outline"></ion-icon>
                            <span>Bulk Actions</span>
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Other admin options (e.g., settings) can go here --}}
        @elseif (Auth::user()->role === 'customer')
            <li>
                <a href="{{ url('user/dashboard') }}">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">User Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('user.bookings.index') }}">
                    <span class="icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </span>
                    <span class="title">My Bookings</span>
                </a>
            </li>

            <li>
                <a href="{{ route('user.bookings.create') }}">
                    <span class="icon">
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Create Booking</span>
                </a>
            </li>

            <li>
                <a href="{{ route('user.settings') }}">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>
        @endif

        <!-- Sign Out -->
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">Sign Out</span>
            </a>

            <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
