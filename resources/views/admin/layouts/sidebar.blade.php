    <div class="sidebar text-capitalize">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"  rel="noopener noreferrer">
            <x-application-logo class="admin-logo"/>
            </a>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="menu-title">Navigation</li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#profile">
                        <i class="fas fa-flask"></i> profile
                        <i class="fas fa-angle-down menu-arrow"></i>
                    </a>
                    <div class="collapse" id="profile">
                        <ul class="submenu nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.user.index') }}">
                                    <i class="fas fa-shopping-cart"></i> all profile
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#store">
                         <i class="fas fa-store"></i> store
                        <i class="fas fa-angle-down menu-arrow"></i>
                    </a>
                    <div class="collapse" id="store">
                        <ul class="submenu nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.store.index') }}">
                                  <i class="fas fa-store"></i> all store
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.store.create') }}">
                                  <i class="fas fa-store"></i> add store
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#coupon">
                         <i class="fas fa-list-ul"></i> coupon
                        <i class="fas fa-angle-down menu-arrow"></i>
                    </a>
                    <div class="collapse" id="coupon">
                        <ul class="submenu nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.coupon.index') }}">
                                  <i class="fas fa-list-ul"></i> all coupon
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.coupon.create') }}">
                                  <i class="fas fa-list-ul"></i> add coupon
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#slider">
                         <i class="fas fa-list-ul"></i> slider
                        <i class="fas fa-angle-down menu-arrow"></i>
                    </a>
                    <div class="collapse" id="slider">
                        <ul class="submenu nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.slider.index') }}">
                                  <i class="fas fa-list-ul"></i> all slider
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.slider.create') }}">
                                  <i class="fas fa-list-ul"></i> add slider
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                   <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#blog">
                         <i class="fas fa-blog"></i> blog
                        <i class="fas fa-angle-down menu-arrow"></i>
                    </a>
                    <div class="collapse" id="blog">
                        <ul class="submenu nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.blog.index') }}">
                                  <i class="fas fa-blog"></i> all blog
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.blog.create') }}">
                                  <i class="fas fa-blog"></i> add blog
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-3">Apps</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.language.index') }}">
                        <i class="fa fa-language" aria-hidden="true"></i> language
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.network.index') }}">
                        <i class="fas fa-network-wired"></i> network
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.category.index') }}">
                        <i class="fas fa-list"></i> category
                    </a>
                </li>
                <li class="menu-title mt-3">Pages</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">

                     <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </form>

                </li>
            </ul>
        </div>
    </div>
