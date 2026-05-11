 <!-- Left Sidebar Start -->
 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>
         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <div class="logo-box">
                 <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('dashboard/assets/images/logo-light.png') }}" alt="" height="24">
                     </span>
                 </a>
                 <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                     <span class="logo-sm">
                         <img src="{{ asset('dashboard/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('dashboard/assets/images/logo-dark.png') }}" alt="" height="24">
                     </span>
                 </a>
             </div>
             <ul id="side-menu">
                 <li class="menu-title">Menu</li>
                 <li>
                     <a href="{{ route('admin.dashboard') }}"
                         class="tp-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                         <i data-feather="home"></i>
                         <span> Dashboard </span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('user.list') }}"
                         class="tp-link {{ request()->routeIs('user.list') ? 'active' : '' }}">
                         <i data-feather="user-check"></i>
                         <span> User List </span>
                     </a>
                 </li>
                 <li class="menu-title">Pages</li>
                 <li>
                     <a href="{{ route('category.index') }}"
                         class="tp-link {{ request()->routeIs('category') ? 'active' : '' }}">
                         <i data-feather="archive"></i>
                         <span> Category </span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('products.index') }}"
                         class="tp-link {{ request()->routeIs('products') ? 'active' : '' }}">
                         <i data-feather="package"></i>
                         <span> Products </span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('customers.index') }}"
                         class="tp-link {{ request()->routeIs('customers') ? 'active' : '' }}">
                         <i data-feather="users"></i>
                         <span> Customers </span>
                     </a>
                 </li>

                 <li>
                     <a href="{{ route('sales.create') }}"
                         class="tp-link {{ request()->routeIs('sales') ? 'active' : '' }}">
                         <i data-feather="credit-card"></i>
                         <span> Sales </span>
                     </a>
                 </li>

                 <li>
                     <a href="{{ route('sales.index') }}"
                         class="tp-link {{ request()->routeIs('sales') ? 'active' : '' }}">
                         <i data-feather="clipboard"></i>
                         <span>Invoice</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm mt-4">
                         <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                         <span> Logout </span>
                     </a>
                 </li>
             </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
     </div>
 </div>
 <!-- Left Sidebar End -->
