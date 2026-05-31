<!-- Main sidebar -->
<div class="sidebar sidebar-dark bg-primary sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto text-center">
                    <img src="{{ asset('assets/images/attalas-logo.png') }}" class="img-fluid rounded-circle"
                        width="100" alt="Attalas Cafe Logo">
                </h5>

                <div>
                    <button type="button"
                        class="btn btn-flat-white btn-icon btn-sm rounded-pill sidebar-control sidebar-main-resize d-none d-lg-inline-flex border-transparent">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button"
                        class="btn btn-flat-white btn-icon btn-sm rounded-pill sidebar-mobile-main-toggle d-lg-none border-transparent">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm sidebar-resize-hide opacity-50">ADMINISTRATOR</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="ph-house"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.menu.index') }}"
                        class="nav-link {{ Route::is('admin.menu.*') ? 'active' : '' }}">
                        <i class="ph-list"></i>
                        <span>
                            Menu
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.menu-category.index') }}"
                        class="nav-link {{ Route::is('admin.menu-category.*') ? 'active' : '' }}">
                        <i class="ph-tag"></i>
                        <span>
                            Kategori Menu
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.gallery.index') }}"
                        class="nav-link {{ Route::is('admin.gallery.*') ? 'active' : '' }}">
                        <i class="ph-image"></i>
                        <span>
                            Galeri
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reviews.index') }}"
                        class="nav-link {{ Route::is('admin.reviews.*') ? 'active' : '' }}">
                        <i class="ph-star"></i>
                        <span>
                            Ulasan
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
                        <i class="ph-users"></i>
                        <span>
                            Pengguna
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
