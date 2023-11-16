<nav class="sb-sidenav accordion  sb-sidenav-dark" id="sidenavAccordion" style="background-image: linear-gradient(to bottom , #168253, #233329);">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Users</div>

            <a class="nav-link" href="{{ route('admin.admin-user.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                Admin User Table
            </a>
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                User Table
            </a>

            <div class="sb-sidenav-menu-heading">Posts</div>
            <a class="nav-link" href="{{ route('admin.buy.post.index') }}">
                <div class="sb-nav-link-icon"><i class="far fa-clipboard"></i></div>
                Buy Posts
            </a>
            <a class="nav-link" href="{{ route('admin.sell.post.index') }}">
                <div class="sb-nav-link-icon"><i class="far fa-clipboard"></i></div>
                Sale Posts
            </a>

            <div class="sb-sidenav-menu-heading">Others</div>
            <a class="nav-link" href="{{ route('admin.manufacturer.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-industry"></i></div>
                Manufacturer
            </a>
            <a class="nav-link" href="{{ route('admin.build-type.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                Build Types
            </a>
            <a class="nav-link" href="{{ route('admin.plate-division.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-map"></i></div>
                Plate Divisions
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Car Seller Admin
    </div>
</nav>