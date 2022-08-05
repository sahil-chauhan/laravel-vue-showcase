<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>                                
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('users.index') }}" key="t-user-grid">All Users</a></li>
                        <li><a href="{{ route('users.create') }}" key="t-user-grid">Add User</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-business-time"></i>
                        <span key="t-account">Accounts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('accounts.index') }}" key="t-account-grid">All Accounts</a></li>
                        <li><a href="{{ route('accounts.create') }}" key="t-account-grid">Add Account</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-shopping-bag"></i>
                        <span key="t-product">Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('products.index') }}" key="t-product-grid">All Products</a></li>
                        <li><a href="{{ route('products.create') }}" key="t-product-grid">Add Product</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-gift"></i>
                        <span key="t-coupon">Coupons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('coupons.index') }}" key="t-coupon-grid">All Coupons</a></li>
                        <li><a href="{{ route('coupons.create') }}" key="t-coupon-grid">Add Coupon</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-key"></i>
                        <span key="t-licenses">Licenses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('licenses.index') }}" key="t-licenses-grid">All Licenses</a></li>
                        <li><a href="{{ route('licenses.create') }}" key="t-licenses-grid">Add License</a></li>
                    </ul>
                </li>

               

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>