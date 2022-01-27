<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a href="/" class="navbar-brand sidebar-gone-hide mr-0"><img src="{{asset('img/logo.svg')}}" alt="" width="50"></a>
    <div class="navbar-nav">
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav navbar-left mr-auto">
            <!-- for left  -->
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user" aria-expanded="false"><div class="d-sm-none d-lg-inline-block text-custom-color mt-0">Assets</div>
                </a>
                <div class="dropdown-menu dropdown-menu-left">
                    <a href="{{route('upload-asset')}}" class="dropdown-item text-custom-color">Upload Asset</a>
                    <a href="{{route('all-asset')}}" class="dropdown-item text-custom-color">All Assets</a>
                    <a href="{{route('categories')}}" class="dropdown-item text-custom-color">Categories</a>
                </div>
            </li>
            <li><a href="" class="nav-link">News</a></li>
            <li><a href="" class="nav-link">Help</a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user" aria-expanded="false">
                <div class="d-sm-none d-lg-inline-block text-custom-color"><i class="fas fa-1x fa-search"></i></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right px-2" style="width: 950px">
                <form action="{{route('all-asset')}}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Asset" name="search" style="width: 700px !important">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-sm btn-custom" id="basic-addon2">SEARCH</button>
                        </div>
                      </div>
                </form>
            </div>
        </li>
        @guest
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user" aria-expanded="false">
            <div class="d-sm-none d-lg-inline-block text-custom-color"><i class="fas fa-1x fa-user"></i></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{route('login')}}" class="dropdown-item text-custom-color">Login</a>
              <a href="{{route('register')}}" class="dropdown-item text-custom-color">Register</a>
            </div>
          </li>
        @endguest
        @auth
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user" aria-expanded="false">
                    <div class="d-sm-none d-lg-inline-block text-custom-color"><i class="fas fa-1x fa-history"></i></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item font-weight-bold py-3">{{auth()->user()->downloads->count()}} Downloads Remaining</a>
                    {{-- @can('view', auth()->user()) --}}
                        <a href="{{route('download-history')}}" class="dropdown-item text-custom-color">Download History</a>
                    {{-- @endcan --}}
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-sm-none d-lg-inline-block text-custom-color"><i class="fas mr-1 fa-user"></i> {{auth()->user()->username}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('profile')}}" class="dropdown-item has-icon text-custom-color">
                        <i class="fas fa-address-card float-none"></i>Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.querySelector('#logout').submit();">
                        <i class="fas fa-sign-out-alt float-none"></i> Logout
                        <form action="{{route('logout')}}" method="post" id="logout" class="d-none">
                        @csrf
                        </form>
                    </a>
                </div>
            </li>
        @endauth
    </ul>
</nav>
