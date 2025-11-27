<div class="navigation">
  <ul>

    <!-- Logo -->
    <li class="title">
      <a href="#">
        <span class="icon"><ion-icon name="bus-outline"></ion-icon></span>
        <span class="title">BBS System</span>
      </a>
    </li>

    <!-- ADMIN MENU -->
    @if(Auth::user()->userType->type_name === 'admin')

      <!-- Dashboard -->
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <span class="icon"><ion-icon name="speedometer-outline"></ion-icon></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <!-- Buses -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="bus-outline"></ion-icon></span>
          <span class="title">Fleet & Buses</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="{{ route('admin.buses.index') }}"><ion-icon name="list-outline"></ion-icon>All Buses</a></li>
          <li><a href="{{ route('admin.buses.create') }}"><ion-icon name="add-circle-outline"></ion-icon>Add Bus</a></li>
          <li><a href="{{ route('admin.bus-types.index') }}"><ion-icon name="options-outline"></ion-icon>Bus Types</a></li>
          <li><a href="{{ route('admin.seat-layouts.index') }}"><ion-icon name="grid-outline"></ion-icon>Seat Layouts</a></li>
          <li><a href="{{ route('admin.amenities.index') }}"><ion-icon name="sparkles-outline"></ion-icon>Amenities</a></li>
        </ul>
      </li>

      <!-- Routes & Terminals -->
      <li class="nav-item has-submenu">
        <a href="#" class="toggle-submenu">
          <span class="icon"><ion-icon name="map-outline"></ion-icon></span>
          <span class="title">Routes & Terminals</span>
          <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
        </a>
        <ul class="submenu">
          <li><a href="{{ route('admin.cities.index') }}"><ion-icon name="business-outline"></ion-icon>Cities</a></li>
          <li><a href="{{ route('admin.terminals.index') }}"><ion-icon name="flag-outline"></ion-icon>Terminals</a></li>
          <li><a href="{{ route('admin.routes.index') }}"><ion-icon name="navigate-outline"></ion-icon>Routes</a></li>
          <li><a href="{{ route('admin.route-stops.index') }}"><ion-icon name="locate-outline"></ion-icon>Route Stops</a></li>
        </ul>
      </li>

      <!-- Schedules -->
      <li>
        <a href="{{ route('admin.schedules.index') }}">
          <span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
          <span class="title">Schedules</span>
        </a>
      </li>

      <!-- Booking -->
      <li>
        <a href="{{ route('admin.bookings.index') }}">
          <span class="icon"><ion-icon name="ticket-outline"></ion-icon></span>
          <span class="title">Bookings</span>
        </a>
      </li>

      <!-- Users -->
      <li>
        <a href="{{ route('admin.users.index') }}">
          <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
          <span class="title">Users</span>
        </a>
      </li>

      <!-- Payments -->
      <li>
        <a href="{{ route('admin.payments.index') }}">
          <span class="icon"><ion-icon name="card-outline"></ion-icon></span>
          <span class="title">Payments</span>
        </a>
      </li>

    @elseif(Auth::user()->userType->type_name === 'customer')

      <!-- USER MENU -->
      <li>
        <a href="{{ route('user.dashboard') }}">
          <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <li>
        <a href="{{ route('user.bookings.index') }}">
          <span class="icon"><ion-icon name="ticket-outline"></ion-icon></span>
          <span class="title">My Bookings</span>
        </a>
      </li>

      <li>
        <a href="{{ route('user.search') }}">
          <span class="icon"><ion-icon name="search-outline"></ion-icon></span>
          <span class="title">Search Trip</span>
        </a>
      </li>

      <li>
        <a href="{{ route('user.settings') }}">
          <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
          <span class="title">Account Settings</span>
        </a>
      </li>

    @endif

    <!-- Logout -->
    <li>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
        <span class="title">Logout</span>
      </a>
      <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;"> @csrf </form>
    </li>

  </ul>
</div>
