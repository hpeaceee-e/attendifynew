<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu" style="background-color: #ffffff;">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admin.pages.admin.dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('demo5/src/images/logo.png') }}"
                    srcset="{{ asset('demo5/src/images/logo2x.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('demo5/src/images/logo-dark.png') }}"
                    srcset="{{ asset('demo5/src/images/logo-dark2x.png') }} 2x" alt="logo-dark">
            </a>
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>

    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-menu">
                    <ul class="nk-menu">
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Dashboard</h6>
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.pages.admin.dashboard') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                                <span class="nk-menu-text">Dashboard {{ auth()->user()->name }}</span>
                            </a>
                        </li><!-- .nk-menu-item -->

                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Applications</h6>
                        </li><!-- .nk-menu-heading -->
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.kelolapegawai') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                <span class="nk-menu-text">Kelola Pegawai</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.kelolakehadiranpegawai') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-check"></em></span>
                                <span class="nk-menu-text">Kelola Kehadiran Pegawai</span>
                            </a>
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.kelolajadwal') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar"></em></span>
                                <span class="nk-menu-text">Kelola Jadwal Pegawai</span>
                            </a>
                        <li class="nk-menu-item">
                            <a href="{{ route('admin.kelolacuti') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-alt"></em></span>
                                <span class="nk-menu-text">Kelola Cuti</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                </div><!-- .nk-sidebar-menu -->
                {{-- <div class="nk-sidebar-footer">
                    <ul class="nk-menu nk-menu-footer">
                    </ul><!-- .nk-footer-menu -->
                </div><!-- .nk-sidebar-footer --> --}}
            </div><!-- .nk-sidebar-content -->
        </div><!-- .nk-sidebar-body -->
    </div><!-- .nk-sidebar-element -->
</div>
