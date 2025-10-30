<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pegawai') - App Pegawai</title>

    <!-- Link CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link Bootstrap Icons (Untuk icon di sidebar) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Kustom untuk Tampilan Baru -->
    <style>
        /* Variabel Warna (Sesuai gambar Anda) */
        :root {
            --sidebar-width-collapsed: 90px;
            --sidebar-width-expanded: 260px;
            
            /* Warna Hijau */
            --main-bg-color: #f0f5f0;     /* Latar belakang halaman (hijau sangat muda) */
            --sidebar-bg-color: #f0f5f0;  /* Latar belakang sidebar */
            --active-link-bg: #c8e6c9;   /* Latar belakang link aktif (hijau muda) */
            --active-link-text: #1a531d; /* Teks link aktif (hijau tua) */
            --inactive-link-text: #333;  /* Teks link tidak aktif (abu-abu tua) */
            --logo-text-color: #111;      /* Warna teks logo */
            --hover-link-bg: #e0f0e0;     /* Warna saat hover link */
            
            /* Override Warna Bootstrap */
            --bs-primary: #4CAF50; /* Hijau untuk tombol primer (Tambah, Simpan) */
            --bs-primary-rgb: 76, 175, 80;
            --bs-info: #2196F3;    /* Biru untuk tombol detail */
            --bs-warning: #FFC107; /* Kuning untuk tombol edit */
            --bs-danger: #F44336;  /* Merah untuk tombol hapus */
            --bs-body-bg: var(--main-bg-color); /* Atur background body bootstrap */
            --bs-card-bg: #ffffff; /* Biarkan card putih agar konten terbaca */
        }

        body {
            background-color: var(--main-bg-color);
            transition: background-color 0.3s ease;
        }
        
        /* Tata Letak Sidebar */
        .sidebar {
            width: var(--sidebar-width-collapsed); /* Mulai dari kolaps (icon saja) */
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 1rem 0;
            background-color: var(--sidebar-bg-color);
            z-index: 1000;
            transition: width 0.3s ease;
            overflow-x: hidden; /* Sembunyikan teks saat kolaps */
            border-right: 1px solid #daded9;
        }

        /* Tata Letak Konten Utama */
        .main-content {
            margin-left: var(--sidebar-width-collapsed); /* Sesuaikan dengan sidebar kolaps */
            padding: 1.5rem;
            width: calc(100% - var(--sidebar-width-collapsed));
            transition: margin-left 0.3s ease;
        }

        /* EFEK HOVER (Pop-up) */
        .sidebar:hover {
            width: var(--sidebar-width-expanded); /* Lebarkan sidebar saat di-hover */
        }
        .sidebar:hover + .main-content {
            margin-left: var(--sidebar-width-expanded); /* Geser konten utama */
        }

        /* Tampilan Teks di Sidebar */
        .sidebar .nav-link span,
        .sidebar .sidebar-brand span {
            display: none; /* Sembunyikan teks by default */
            white-space: nowrap; /* Agar teks tidak wrap */
            padding-left: 10px;
        }
        .sidebar:hover .nav-link span,
        .sidebar:hover .sidebar-brand span {
            display: inline; /* Tampilkan teks saat sidebar di-hover */
        }

        /* Styling Link */
        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--logo-text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center; /* Center icon saat kolaps */
            padding: 0 1.25rem;
            margin-bottom: 1.5rem;
            height: 40px; /* Tinggi konsisten */
            overflow: hidden; /* Cegah teks keluar saat kolaps */
        }
        .sidebar-brand i {
            font-size: 1.8rem; /* Ukuran icon brand */
            min-width: 40px; /* Jaga agar icon tetap terpusat saat kolaps */
            text-align: center;
            flex-shrink: 0; /* Cegah icon mengecil */
        }
        .sidebar:hover .sidebar-brand {
            justify-content: flex-start; /* Ratakan kiri saat expanded */
        }

        .nav-link {
            color: var(--inactive-link-text);
            font-size: 1rem;
            padding: 0.75rem 1.25rem;
            margin: 0 0.75rem 0.25rem 0.75rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center; /* Center icon saat kolaps */
             overflow: hidden; /* Cegah teks keluar saat kolaps */
        }
        .sidebar:hover .nav-link {
            justify-content: flex-start; /* Ratakan kiri saat expanded */
        }
        .nav-link i {
            font-size: 1.3rem;
            min-width: 40px; /* Jaga alignment icon */
            text-align: center;
            transition: all 0.1s ease;
            flex-shrink: 0; /* Cegah icon mengecil */
        }

        .nav-link:hover {
            background-color: var(--hover-link-bg);
            color: var(--active-link-text);
        }

        .nav-link.active {
            background-color: var(--active-link-bg);
            color: var(--active-link-text);
            font-weight: 600;
        }
        
        /* Style untuk layar kecil (Mobile) */
        @media (max-width: 767.98px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                bottom: auto;
                display: flex;
                flex-direction: row; /* Jadikan menu horizontal di mobile */
                overflow-x: auto; /* Bisa di-scroll jika tidak muat */
                border-right: none;
                border-bottom: 1px solid #daded9;
            }
            .sidebar:hover {
                width: 100%; /* Tetap full-width di mobile */
            }
            .sidebar .nav-link {
                justify-content: center;
                flex-direction: column;
                padding: 0.5rem;
                margin: 0.25rem;
                 overflow: visible; /* Tampilkan teks di mobile */
            }
            .nav-link i { min-width: auto; margin-right: 0; }
            .nav-link span { font-size: 0.75rem; display: block; padding-left: 0; } /* Tampilkan teks di mobile */
            .sidebar-brand { display: none; } /* Sembunyikan brand di mobile */
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar:hover + .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- ==== SIDEBAR NAVIGASI KIRI ==== -->
        <div class="sidebar" id="sidebar">
            <a href="{{ route('employees.index') }}" class="sidebar-brand">
                <i class="bi bi-person-workspace"></i>
                <span>App Pegawai</span>
            </a>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('employees.index') }}" 
                       class="nav-link @if(Request::is('employees*')) active @endif">
                        <i class="bi bi-people-fill"></i>
                        <span>Pegawai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('departments.index') }}" 
                       class="nav-link @if(Request::is('departments*')) active @endif">
                        <i class="bi bi-building"></i>
                        <span>Departemen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('positions.index') }}" 
                       class="nav-link @if(Request::is('positions*')) active @endif">
                        <i class="bi bi-person-badge"></i>
                        <span>Jabatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.index') }}" 
                       class="nav-link @if(Request::is('attendance*')) active @endif">
                        <i class="bi bi-calendar-check"></i>
                        <span>Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('salaries.index') }}" 
                       class="nav-link @if(Request::is('salaries*')) active @endif">
                        <i class="bi bi-cash-stack"></i>
                        <span>Gaji</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ==== KONTEN UTAMA (Kanan) ==== -->
        <div class="main-content" id="main-content">
            
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    @yield('title') {{-- Judul halaman dari @section('title') --}}
                </h1>
                
                <div class="page-header-actions">
                    @yield('header-actions') {{-- Tombol "Tambah" atau "Kembali" --}}
                </div>
            </header>

            <!-- Pesan Sukses/Error (Alert) -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
             @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Terdapat masalah dengan input Anda.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main>
                @yield('content') {{-- Konten utama (Tabel, Form) --}}
            </main>

        </div>
    </div>

    <!-- Script Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

