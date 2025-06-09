<aside class="left-sidebar with-vertical">
    <div>
        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index.html" class="text-nowrap logo-img">
                <img src="{{ asset('admin2/assets/images/logos/dark-logo.svg') }}" class="dark-logo" alt="Logo-Dark">
                <img src="{{ asset('admin2/assets/images/logos/light-logo.svg') }}" class="light-logo" alt="Logo-light">
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>


        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Home -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="index2.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="hide-menu">eCommerce</span>
                    </a>
                </li> --}}
                <!-- ---------------------------------- -->
                <!-- Apps -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('sentimen') ? 'active' : '' }}" href="/sentiment" aria-expanded="false">
                        <span>
                            <i class="ti ti-message-dots"></i>
                        </span>
                        <span class="hide-menu">Sentimen</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('prediction') ? 'active' : '' }}" href="/prediction" aria-expanded="false">
                        <span>
                            <i class="ti ti-server-2"></i>
                        </span>
                        <span class="hide-menu">Prediction</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="fixed-profile px-4 py-9 mx-4 mb-2 bg-primary-subtle rounded mt-7 position-relative">
            <div class="sidebar-footer-text position-relative z-1">
                <h4 class="fw-bolder fs-5">Upgrade to</h4>
                <h4 class="fw-bolder fs-5">Premium</h4>
                <a href="javascript:void(0)" class="btn btn-primary mt-2">Upgrade</a>
            </div>
            <img src="{{ asset('admin2/assets/images/backgrounds/sidebar-buynow.png') }}" alt="" class="buynow-img img-fluid position-absolute end-0 bottom-0">
        </div>

        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
    </div>
</aside>
