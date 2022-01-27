<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">MY ASSETS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">MA</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="{{request()->routeIs('dashboard') ? 'active' : ''}}"><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Starter</li>
          <li class="{{request()->routeIs('category') ? 'active' : ''}}"> <a href="{{route('category')}}" class="nav-link"><i class="fas fa-columns"></i> <span>Category</span></a> </li>
          <li class="{{request()->routeIs('users') ? 'active' : ''}}"><a class="nav-link" href="{{route('users')}}"><i class="fas fa-users-cog"></i> <span>Users</span></a></li>
          <li class="{{request()->routeIs('assets') ? 'active' : ''}}"><a class="nav-link" href="{{route('assets')}}"><i class="fas fa-cubes"></i> <span>Assets</span></a></li>
          <li class="nav-item dropdown {{request()->routeIs('software') || request()->routeIs('render') ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-blender"></i> <span>Software</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('software')}}"><span>Software 3D</span></a></li>
              <li><a class="nav-link" href="{{route('render')}}">Render Engine</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href=""><i class="fas fa-flag"></i> <span>Report</span></a></li>
         </ul>
    </aside>
  </div>