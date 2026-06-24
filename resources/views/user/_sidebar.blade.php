<!-- Dashboard Sidebar -->
<aside class="dashboard-sidebar">
    <div class="user-profile-header">
        <h2 class="user-name">{{ $customer->name }}</h2>
        <p class="user-member-since">Member since {{ $customer->created_at->format('Y') }}</p>
    </div>
    <nav class="dashboard-nav">
        <a href="{{ route('user.orders') }}" class="dashboard-nav-item">
            <img src="{{ asset('assets/images/dashbord_oder.png') }}" alt="Orders">
            <span>Orders</span>
        </a>
        <a href="{{ route('user.wishlist') }}" class="dashboard-nav-item">
            <img src="{{ asset('assets/images/dashbord_wishlist.png') }}" alt="Wishlist">
            <span>Wishlist</span>
        </a>
        <a href="{{ route('user.addresses.index') }}" class="dashboard-nav-item">
            <img src="{{ asset('assets/images/dashbord_location.png') }}" alt="Addresses">
            <span>Addresses</span>
        </a>
        <a href="{{ route('user.profile') }}" class="dashboard-nav-item active">
            <img src="{{ asset('assets/images/dashbord_profile.png') }}" alt="Profile">
            <span>Profile</span>
        </a>
        <hr class="dashboard-nav-divider">
        <a href="{{ route('user.logout') }}" class="dashboard-nav-item logout-item"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('assets/images/dashbord_logout.png') }}" alt="Logout">
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</aside>