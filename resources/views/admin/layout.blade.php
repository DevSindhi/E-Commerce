<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- BRAND -->
        <a class="navbar-brand" href="/admin/users">Admin Panel</a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAV CONTENT -->
        <div class="collapse navbar-collapse" id="adminNavbar">

            <!-- LEFT SIDE (ADMIN LINKS) -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a>
                </li>
            </ul>

            <!-- RIGHT SIDE -->
            <div class="d-flex align-items-center">
                @auth
                    <span class="text-white me-3">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>