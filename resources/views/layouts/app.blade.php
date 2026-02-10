<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Audit Tool</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- datatables css cdn -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
    font-family: 'Inter', system-ui, sans-serif;
    font-size: 15px;
    line-height: 1.6;
}

h1, h2, h3, h4 {
    font-weight: 600;
    letter-spacing: -0.02em;
}

p {
    font-weight: 400;
}


        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        

        main {
            flex: 1;
        }

        /* Bigger Header */
        .navbar {
            padding-top: 1.2rem;
            padding-bottom: 1.2rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        /* Big & Colorful Footer */
        footer {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
        }

        footer a {
            color: #e0e0e0;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }


   /* Page background */
body {
    background-color: #f4f6fb;
    font-family: 'Inter', system-ui, sans-serif;
}

/* Card */
.project-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

/* Gradient header */
.project-header {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    color: #fff;
    padding: 18px;
}

/* Labels */
.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* Inputs */
.form-control {
    border-radius: 10px;
    padding: 11px 14px;
    font-size: 14px;
    border: 1px solid #e5e7eb;
    background-color: #f9fafb;
}

/* Focus effect */
.form-control:focus {
    background-color: #fff;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
}

/* Button */
.btn-primary {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    border: none;
    border-radius: 30px;
    padding: 12px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.btn-primary:hover {
    opacity: 0.95;
}





/* custom header css */
/* ================= NAVBAR ================= */

.main-navbar {
    background: linear-gradient(135deg, #0f172a, #111827);
    padding: 0.8rem 0;
}

/* Brand */
.brand-icon {
    font-size: 1.4rem;
}

.brand-text {
    font-weight: 700;
    font-size: 1.05rem;
    background: linear-gradient(135deg, #60a5fa, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Nav Links */
.navbar-nav .nav-link {
    font-size: 0.9rem;
    padding: 0.5rem 0.9rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    color: #e5e7eb !important;
}

.navbar-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.08);
}

.navbar-nav .nav-link.active {
    background: rgba(99, 102, 241, 0.25);
    color: #fff !important;
}

/* Dropdown */
.dropdown-menu {
    border-radius: 12px;
    font-size: 0.88rem;
}

.dropdown-header {
    font-size: 0.7rem;
    font-weight: 600;
    color: #9ca3af;
}

/* User Button */
.user-btn {
    background: rgba(255, 255, 255, 0.08);
    color: #fff;
    font-size: 0.85rem;
    padding: 0.45rem 0.8rem;
    border-radius: 20px;
    border: none;
}

.user-btn:hover {
    background: rgba(255, 255, 255, 0.15);
}









    </style>
</head>
<body>

<!-- =================== HEADER / NAVBAR =================== -->
<nav class="navbar navbar-expand-lg navbar-dark main-navbar sticky-top">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2"
           href="{{ route('projects.index') }}">
            <span class="brand-icon">🛡️</span>
            <span class="brand-text">Audit Manager</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- Left Menu -->
            <ul class="navbar-nav me-auto align-items-lg-center gap-lg-1">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
                       href="{{ route('projects.index') }}">
                        Projects
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('audits.*') ? 'active' : '' }}"
                       href="{{ route('audits.start') }}">
                        Audits
                    </a>
                </li>

                <!-- More Dropdown -->
           <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle"
       href="#"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
        More
    </a>

    <ul class="dropdown-menu dropdown-menu-dark shadow-lg">

        <!-- Projects -->
        <li class="dropdown-header">Projects</li>

        <li>
            <a class="dropdown-item" href="{{ route('projects.index') }}">
                📁 All Projects
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('projects.create') }}">
                ➕ Create New Project
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <!-- Categories -->
        <li class="dropdown-header">Categories</li>

        <li>
            <a class="dropdown-item" href="{{ route('categories.index') }}">
                🗂️ Categories
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('categories.create') }}">
                ➕ Add Category
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <!-- Checkpoints -->
        <li class="dropdown-header">Checkpoints</li>

        <li>
            <a class="dropdown-item" href="{{ route('checkpoints.index') }}">
                ✅ Checkpoints
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('checkpoints.create') }}">
                ➕ Add Checkpoint
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <!-- Users -->
        <li class="dropdown-header">Users</li>

        <li>
            <a class="dropdown-item" href="#">
                👤 Users
            </a>
        </li>

    </ul>
</li>

            </ul>

            <!-- Right Section -->
            <div class="d-flex align-items-center gap-3">

                @auth
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn user-btn dropdown-toggle"
                                data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        Sign Up
                    </a>
                @endguest

            </div>

        </div>
    </div>
</nav>


<!-- =================== MAIN CONTENT =================== -->
<main class="container my-5 ">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')

</main>

<!-- =================== BIG COLORFUL FOOTER =================== -->
<footer class="mt-auto">
    <div class="container py-5">
        <div class="row">

            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Project Audit Tool</h5>
                <p class="small">
                    A centralized platform to manage project audits,
                    checkpoints, and quality standards efficiently.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li><a href="{{ route('audits.start') }}">Audits</a></li>
                    <li><a href="{{route('projects.create')}}">New Project</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h6 class="fw-bold">Support</h6>
                <ul class="list-unstyled">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>

        </div>

        <hr class="border-light">

        <div class="text-center small">
            © {{ date('Y') }} Project Audit Tool. All rights reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- jquery and bootsrtap cdn links  -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>