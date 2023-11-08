<div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fa fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right btn-block justify-content-end">
                <li class="nav-link">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-warning">Front End</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img alt="image" src="{{ asset('uploads/' .Auth::guard('admin')->user()->photo) }}" class="rounded-circle">
                        <div class="d-sm-none d-lg-inline-block text-success">{{ Auth::guard('admin')->user()->name }}</div>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin_profile') }}"> <i class="fa fa-user"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin_logout') }}"> <i class="fa fa-sign-out"></i> Logout</a></li>
                        <li><hr class="dropdown-divider"></li>
                      </ul>
                </li>
            </ul>
        </nav>