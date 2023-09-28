 <!-- ========== App Menu ========== -->
 <div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
      <!-- Dark Logo-->
      <a href="{{ route('welcome') }}" class="logo logo-dark">
        <span class="logo-sm">
          <h3 class="d-inline-block text-white ">{{ env("APP_NAME") }}</h3>
        </span>
        <span class="logo-lg">
          <h3 class="d-inline-block text-white ">{{ env("APP_NAME") }}</h3>
        </span>
      </a>
      <!-- Light Logo-->
      <a href="{{ route('welcome') }}" class="logo logo-light">
        <span class="logo-sm">
          <h3 class="d-inline-block text-white ">{{ env("APP_NAME") }}</h3>
        </span>
        <span class="logo-lg">
          <h3 class="d-inline-block text-white ">{{ env("APP_NAME") }}</h3>
        </span>
      </a>
      <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
        <i class="ri-record-circle-line"></i>
      </button>
    </div>
    <div id="scrollbar">
      <div class="container-fluid">
        <div id="two-column-menu"></div>
        <ul class="navbar-nav" id="navbar-nav">
          <li class="menu-title">
            <span data-key="t-menu">Menu</span>
          </li>

          @if (auth()->user()->role === 'admin')
              @include('layouts.dashboard.includes.menu.admin-menu')
          @elseif(auth()->user()->role === 'agent')
              @include('layouts.dashboard.includes.menu.agent-menu')
          @elseif(auth()->user()->role === 'user')
              @include('layouts.dashboard.includes.menu.user-menu')
          @endif
         
        </ul>
      </div>
      <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
  </div>
  <!-- Left Sidebar End -->