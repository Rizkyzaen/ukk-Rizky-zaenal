<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --sidebar-width: 250px;
        }

        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .sidebar-brand {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu-item {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #495057;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-menu-item:hover, .sidebar-menu-item.active {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1rem;
            transition: all 0.3s;
        }

        .navbar-top {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1.5rem;
        }

        .card {
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .badge-returned {
        background-color: #198754;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        }

        .badge-borrowed {
            background-color: #ffc107;
            color: black;
            padding: 4px 10px;
            border-radius: 5px;
        }


        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block !important;
            }
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #495057;
        }
        .star-rating {
        direction: rtl;
        display: inline-flex;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star-rating input[type="radio"]:checked ~ label {
        color: #ffc107;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
    </style>
        <!-- Other head elements -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Bagian Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/') }}" class="sidebar-brand">
        <i class="fas fa-book"></i><span>Perpustakaan</span>
      </a>
    </div>
    <div class="sidebar-menu">
      @auth
        @if(auth()->user()->role === 'siswa')
          <a href="{{ route('siswa.dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i><span>Dashboard</span>
          </a>
          <a href="{{ route('pinjam.index') }}" class="sidebar-menu-item {{ request()->routeIs('pinjam.index') ? 'active' : '' }}">
            <i class="fas fa-list"></i><span>Daftar Peminjaman</span>
          </a>
          <a href="{{ route('pinjam.create') }}" class="sidebar-menu-item {{ request()->routeIs('pinjam.create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle"></i><span>Pinjam Buku</span>
          </a>
        @endif

        @if(auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
          </a>
          <a href="{{ route('admin.user.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
            <i class="fas fa-users-cog"></i><span>Kelola Pengguna</span>
          </a>
          <a href="{{ route('buku.create') }}" class="sidebar-menu-item {{ request()->routeIs('buku.create') ? 'active' : '' }}">
            <i class="fas fa-book-medical"></i><span>Tambah Buku</span>
          </a>
          <a href="{{ url('pinjam') }}" class="sidebar-menu-item {{ request()->routeIs('buku.create') ? 'active' : '' }}">
            <i class="fas fa-list-check me-1"></i><span>Kelola Peminjaman</span>
          </a>
        @endif

        @if(auth()->user()->role === 'petugas')
          <a href="{{ route('petugas.dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
            <i class="fas fa-columns"></i><span>Dashboard</span>
          </a>
          <a href="{{ route('buku.create') }}" class="sidebar-menu-item {{ request()->routeIs('buku.create') ? 'active' : '' }}">
            <i class="fas fa-book-medical"></i><span>Tambah Buku</span>
          </a>
          <a href="{{ route('petugas.buku.index') }}" class="sidebar-menu-item {{ request()->routeIs('petugas.buku.index') ? 'active' : '' }}">
            <i class="fas fa-book"></i><span>Daftar Buku</span>
          </a>
        @endif
      @endauth

      @guest
        <a href="{{ route('login') }}" class="sidebar-menu-item {{ request()->routeIs('login') ? 'active' : '' }}">
          <i class="fas fa-sign-in-alt"></i><span>Login</span>
        </a>
        <a href="{{ route('register') }}" class="sidebar-menu-item {{ request()->routeIs('register') ? 'active' : '' }}">
          <i class="fas fa-user-plus"></i><span>Register</span>
        </a>
      @endguest
    </div>
  </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar-top d-flex justify-content-between align-items-center mb-4">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <div class="d-flex align-items-center">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>

                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !sidebarToggle.contains(event.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>
