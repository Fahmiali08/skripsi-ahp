<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #569DAA;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link border-bottom border-white text-white">
        <i class="fas fa-chart-pie brand-image img-circle elevation-4 pt-2 pl-1" style="opacity: .8;"></i>
        <span class="brand-text font-weight-bold text-white">{{ Auth::user()->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2" style="font-size: 14px">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                @if(Auth::user()->role_id == 1)
                    @include('layout.template.menu-admin')
                @endif
                @if(Auth::user()->role_id == 2)
                    @include('layout.template.menu-teacher')
                @endif
                 @if(Auth::user()->role_id == 3)
                    @include('layout.template.menu-student')
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>