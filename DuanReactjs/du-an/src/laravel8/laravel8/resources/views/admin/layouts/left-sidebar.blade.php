<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/dashboard') }}" aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">{{ __('admin.dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/user/profile/'.Auth::user()->id) }}" aria-expanded="false">
                        <i class="mdi mdi-account-network"></i>
                        <span class="hide-menu">{{ __('admin.profile') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/user/list') }}" aria-expanded="false">
                        <i class="mdi mdi-format-list-bulleted-type"></i>
                        <span class="hide-menu">{{ __('admin.listUser') }}</span>
                    </a>
                </li>
                 <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/country') }}" aria-expanded="false">
                        <i class="mdi mdi-border-none"></i>
                        <span class="hide-menu">{{ __('Country') }}</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('category') }}" aria-expanded="false">
                        <i class="mdi mdi-menu"></i>
                        <span class="hide-menu">{{ __('admin.Category') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('brand') }}" aria-expanded="false">
                        <i class="mdi mdi-shopping"></i>
                        <span class="hide-menu">{{ __('admin.Brand') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('listProduct') }}" aria-expanded="false">
                        <i class="mdi mdi-cart-outline"></i>
                        <span class="hide-menu">{{ __('admin.listProduct') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/blog') }}" aria-expanded="false">
                        <i class="mdi mdi-blogger"></i>
                        <span class="hide-menu">{{ __('Blog') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/page') }}" aria-expanded="false">
                        <i class="mdi mdi-menu"></i>
                        <span class="hide-menu">page</span>
                    </a>
                </li>

               <!--  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="table-basic.html" aria-expanded="false">
                        <i class="mdi mdi-border-none"></i>
                        <span class="hide-menu">Table</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="icon-material.html" aria-expanded="false">
                        <i class="mdi mdi-face"></i>
                        <span class="hide-menu">Icon</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="starter-kit.html" aria-expanded="false">
                        <i class="mdi mdi-file"></i>
                        <span class="hide-menu">Blank</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="error-404.html" aria-expanded="false">
                        <i class="mdi mdi-alert-outline"></i>
                        <span class="hide-menu">404</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/page/add') }}" aria-expanded="false">
                        <i class="mdi mdi-format-list-bulleted-type"></i>
                        <span class="hide-menu">Page</span>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>