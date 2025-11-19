<div class="navigation">
  <ul>
    <!-- Logo Section -->
    <li class="title">
      <a href="#">
                <span class="icon">
                    <ion-icon name="bus-outline"></ion-icon>
                </span>
        <span class="title">BBS</span>
      </a>
    </li>

    {{-- Admin Menu --}}
    @if (Auth::user()->role === 'admin')
      <!-- Dashboard -->
      <li>
        <a href="{{ url('admin/dashboard') }}">
          <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <!-- Bus Management -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="bus-outline"></ion-icon></span>
          <span class="title">Bus Management</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="{{ route('admin.buses.index') }}">
              <ion-icon name="list-outline"></ion-icon>
              All Buses</a></li>
          <li><a href="{{ route('admin.buses.create') }}">
              <ion-icon name="add-circle-outline"></ion-icon>
              Add New Bus</a></li>
          <li><a href="{{ route('admin.bus-types.index') }}">
              <ion-icon name="options-outline"></ion-icon>
              Bus Types</a></li>
          <li><a href="{{ route('admin.seat-layouts.index') }}">
              <ion-icon name="grid-outline"></ion-icon>
              Seat Layouts</a></li>
        </ul>
      </li>

      <!-- Trip / Route Management -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="map-outline"></ion-icon></span>
          <span class="title">Trip / Route Management</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li>
            <a href="{{ route('admin.routes.index') }}">
              <ion-icon name="navigate-outline"></ion-icon>
              Routes
            </a>
          </li>
          <li>
            <a href="{{ route('admin.trips.index') }}">
              <ion-icon name="calendar-outline"></ion-icon>
              Trips / Schedules
            </a>
          </li>
          <li>
            <a href="{{ route('admin.assign.index') }}">
              <ion-icon name="swap-horizontal-outline"></ion-icon>
              Assign Bus to Trip
            </a>
          </li>
          <li>
            <a href="{{ route('admin.fares.index') }}">
              <ion-icon name="pricetag-outline"></ion-icon>
              Fare Management
            </a>
          </li>
        </ul>
      </li>


      <!-- Booking Management -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
          <span class="title">Booking Management</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="{{ route('admin.bookings.index') }}">
              <ion-icon name="list-outline"></ion-icon>
              All Bookings</a></li>
          <li><a href="{{ route('admin.bookings.create') }}">
              <ion-icon name="add-circle-outline"></ion-icon>
              Create Booking</a></li>
          <li><a href="{{ route('admin.bookings.status.pending') }}">
              <ion-icon name="hourglass-outline"></ion-icon>
              Pending Bookings</a></li>
          <li><a href="{{ route('admin.bookings.status.completed') }}">
              <ion-icon name="checkmark-circle-outline"></ion-icon>
              Completed Bookings</a></li>
          <li><a href="{{ route('admin.bookings.status.cancelled') }}">
              <ion-icon name="close-circle-outline"></ion-icon>
              Cancelled Bookings</a></li>
        </ul>
      </li>

      <!-- Users Management -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
          <span class="title">Users Management</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="{{ route('admin.users.index') }}">
              <ion-icon name="list-outline"></ion-icon>
              All Users</a></li>
          <li><a href="{{ route('admin.users.create') }}">
              <ion-icon name="add-circle-outline"></ion-icon>
              Add New User</a></li>
          <li><a href="{{ route('admin.user-roles.index') }}">
              <ion-icon name="shield-checkmark-outline"></ion-icon>
              User Roles</a></li>
          <li><a href="{{ route('admin.users.blocked') }}">
              <ion-icon name="ban-outline"></ion-icon>
              Blocked Users</a></li>
          <li><a href="{{ route('admin.users.activity') }}">
              <ion-icon name="reader-outline"></ion-icon>
              User Activity</a></li>
          <li><a href="{{ route('admin.users.bulk') }}">
              <ion-icon name="download-outline"></ion-icon>
              Bulk Actions</a></li>
        </ul>
      </li>

      <!-- Payment & Transactions -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="card-outline"></ion-icon></span>
          <span class="title">Payment & Transactions</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="documents-outline"></ion-icon>
              Payment Records</a></li>
          <li><a href="#">
              <ion-icon name="refresh-circle-outline"></ion-icon>
              Refund Requests</a></li>
          <li><a href="#">
              <ion-icon name="stats-chart-outline"></ion-icon>
              Payment Reports</a></li>
        </ul>
      </li>

      <!-- Fleet Maintenance -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="construct-outline"></ion-icon></span>
          <span class="title">Fleet Maintenance</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="document-text-outline"></ion-icon>
              Maintenance Records</a></li>
          <li><a href="#">
              <ion-icon name="alarm-outline"></ion-icon>
              Service Scheduling</a></li>
          <li><a href="#">
              <ion-icon name="build-outline"></ion-icon>
              Repair Logs</a></li>
          <li><a href="#">
              <ion-icon name="fuel-outline"></ion-icon>
              Fuel Usage</a></li>
        </ul>
      </li>

      <!-- Feedback & Support -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></span>
          <span class="title">Feedback & Support</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="chatbubbles-outline"></ion-icon>
              Customer Feedback</a></li>
          <li><a href="#">
              <ion-icon name="help-circle-outline"></ion-icon>
              Support Tickets</a></li>
          <li><a href="#">
              <ion-icon name="alert-circle-outline"></ion-icon>
              Complaints & Issues</a></li>
        </ul>
      </li>

      <!-- Reports & Analytics -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="analytics-outline"></ion-icon></span>
          <span class="title">Reports & Analytics</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="file-tray-full-outline"></ion-icon>
              Booking Reports</a></li>
          <li><a href="#">
              <ion-icon name="cash-outline"></ion-icon>
              Revenue Reports</a></li>
          <li><a href="#">
              <ion-icon name="bus-outline"></ion-icon>
              Bus Utilization</a></li>
          <li><a href="#">
              <ion-icon name="person-circle-outline"></ion-icon>
              User Activity Reports</a></li>
        </ul>
      </li>

      <!-- System Settings -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
          <span class="title">System Settings</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="cog-outline"></ion-icon>
              General Settings</a></li>
          <li><a href="#">
              <ion-icon name="notifications-outline"></ion-icon>
              Notification Settings</a></li>
          <li><a href="#">
              <ion-icon name="card-outline"></ion-icon>
              Payment Gateway Settings</a></li>
          <li><a href="#">
              <ion-icon name="shield-outline"></ion-icon>
              Roles & Permissions</a></li>
          <li><a href="#">
              <ion-icon name="cloud-upload-outline"></ion-icon>
              Backup & Restore</a></li>
        </ul>
      </li>

      <!-- Website CMS -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="globe-outline"></ion-icon></span>
          <span class="title">Website CMS</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="document-text-outline"></ion-icon>
              Manage Pages</a></li>
          <li><a href="#">
              <ion-icon name="megaphone-outline"></ion-icon>
              Announcements</a></li>
          <li><a href="#">
              <ion-icon name="images-outline"></ion-icon>
              Banners / Sliders</a></li>
          <li><a href="#">
              <ion-icon name="help-circle-outline"></ion-icon>
              FAQs</a></li>
        </ul>
      </li>

      <!-- Logs -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="receipt-outline"></ion-icon></span>
          <span class="title">Logs</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="#">
              <ion-icon name="terminal-outline"></ion-icon>
              System Logs</a></li>
          <li><a href="#">
              <ion-icon name="reader-outline"></ion-icon>
              Activity Logs</a></li>
          <li><a href="#">
              <ion-icon name="bug-outline"></ion-icon>
              Error Logs</a></li>
          <li><a href="#">
              <ion-icon name="key-outline"></ion-icon>
              Login History</a></li>
        </ul>
      </li>

      {{-- Customer Menu --}}
    @elseif (Auth::user()->role === 'customer')

      <li>
        <a href="{{ url('user/dashboard') }}">
          <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <li>
        <a href="{{ route('user.bookings.index') }}">
          <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
          <span class="title">My Bookings</span>
        </a>
      </li>

      <li>
        <a href="{{ route('user.bookings.create') }}">
          <span class="icon"><ion-icon name="add-circle-outline"></ion-icon></span>
          <span class="title">Create Booking</span>
        </a>
      </li>

      <li>
        <a href="{{ route('user.settings') }}">
          <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
          <span class="title">Settings</span>
        </a>
      </li>

    @endif

    <!-- Sign Out -->
    <li>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
        <span class="title">Sign Out</span>
      </a>

      <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>

  </ul>
</div>
