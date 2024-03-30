<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="{{ url('/Home') }}" class="text-now ap logo -img">
                <h4 class="mb-0 text-center"> RAMSAS</h4>
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/Home') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">דף ראשי</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'Staff')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('/Add-Event') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-notes"></i>
                            </span>
                            <span class="hide-menu">הוספת אירוע</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('/Calendar') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-calendar"></i>
                            </span>
                            <span class="hide-menu">יומן</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'Admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ url('/Log-History') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-history"></i>
                            </span>
                            <span class="hide-menu">היסטוריה </span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'Admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link  " href="{{ url('/Pools') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">בריכות</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link  " href="{{ url('/Users') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">משתמשים</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'Admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                            <span class="d-flex">
                                <i class="ti ti-settings"></i>
                            </span>
                            <span class="hide-menu">הגדרות</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ url('/Message-Template') }}?temp=1" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">תבנית להודעת תזכורת</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('/Message-Template') }}?temp=2" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">תבנית להודעת אישור</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
