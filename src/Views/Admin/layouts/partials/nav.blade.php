<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ routeAdmin() }}">LuxChill</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ routeAdmin() }}">Lux</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="active">
                <a class="nav-link" href="{{ routeAdmin() }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Manager</li>
            <li>
                <a class="nav-link" href="{{ routeAdmin('categories') }}">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ routeAdmin('users') }}">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ routeAdmin('products') }}">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ routeAdmin('orders') }}">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ routeAdmin('comments') }}">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Comments</span>
                </a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ routeClient() }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Web
            </a>
        </div>
    </aside>
</div>