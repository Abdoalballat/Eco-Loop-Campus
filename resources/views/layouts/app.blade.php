<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green University - @yield('title', 'EcoLoop')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.3 & Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand-green: #15803d;
            --brand-green-hover: #166534;
            --soft-green-bg: #f0fdf4;
            --card-radius: 20px;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9fafb;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .main-navbar {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 14px 0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            color: var(--text-dark) !important;
        }

        .nav-link {
            color: #4b5563 !important;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 8px 16px !important;
            transition: color 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--brand-green) !important;
        }

        /* Reusable UI Components */
        .white-card {
            background: #ffffff;
            border-radius: var(--card-radius);
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            padding: 24px;
        }

        .section-tag-line {
            width: 36px;
            height: 4px;
            background-color: var(--brand-green);
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .micro-pill {
            background-color: var(--soft-green-bg);
            color: var(--brand-green);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .micro-pill-muted {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .btn-green-capsule {
            background-color: var(--brand-green);
            color: #ffffff !important;
            border-radius: 50px;
            padding: 8px 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-green-capsule:hover {
            background-color: var(--brand-green-hover);
            transform: translateY(-1px);
        }

        /* Form Controls */
        .form-control {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--brand-green);
            box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body>

    @unlessViewIs('auth.login')
        @unlessViewIs('auth.verify-otp')
            <!-- App Navbar -->
            <nav class="navbar navbar-expand-lg main-navbar mb-4">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                        <i class="bi bi-recycle text-success fs-4"></i> Green University
                    </a>
                    
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center" id="navContent">
                        <ul class="navbar-nav gap-1">
                            <li class="nav-item"><a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">Overview</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->is('rewards*') ? 'active' : '' }}" href="/rewards">Rewards Store</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->is('containers*') ? 'active' : '' }}" href="/containers">Smart Bins</a></li>
                        </ul>
                    </div>

                    @auth
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-none d-sm-flex align-items-center gap-2">
                                <div class="text-end">
                                    <div class="fw-bold small lh-1">{{ auth()->user()->name ?? 'Student' }}</div>
                                    <small class="text-muted" style="font-size: 0.72rem;">{{ auth()->user()->email }}</small>
                                </div>
                            </div>
                            <form action="#" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm rounded-circle p-2" title="Logout">
                                    <i class="bi bi-box-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </nav>
        @endunlessViewIs
    @endunlessViewIs

    <!-- Main Dynamic Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>