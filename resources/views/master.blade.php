<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pegawai') - App Pegawai</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-width-collapsed: 90px;
            --sidebar-width-expanded: 260px;
            
            --main-bg-color: #f0f5f0; 
            --sidebar-bg-color: #f0f5f0; 
            --active-link-bg: #c8e6c9; 
            --active-link-text: #1a531d; 
            --inactive-link-text: #333; 
            --logo-text-color: #111; 
            --hover-link-bg: #e0f0e0; 
            
            --bs-primary: #4CAF50; 
            --bs-primary-rgb: 76, 175, 80;
            --bs-info: #2196F3; 
            --bs-warning: #FFC107; 
            --bs-danger: #F44336; 
            --bs-body-bg: var(--main-bg-color); 
            --bs-card-bg: #ffffff; 
        }

        body {
            background-color: var(--main-bg-color);
            transition: background-color 0.3s ease;
        }
        
        .sidebar {
            width: var(--sidebar-width-collapsed); 
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 1rem 0;
            background-color: var(--sidebar-bg-color);
            z-index: 1000;
            transition: width 0.3s ease;
            overflow-x: hidden; 
            border-right: 1px solid #daded9;
        }

        .main-content {
            margin-left: var(--sidebar-width-collapsed); 
            padding: 1.5rem;
            width: calc(100% - var(--sidebar-width-collapsed));
            transition: margin-left 0.3s ease;
        }

        .sidebar:hover {
            width: var(--sidebar-width-expanded); 
        }
        .sidebar:hover + .main-content {
            margin-left: var(--sidebar-width-expanded); 
        }

        .sidebar .nav-link span,
        .sidebar .sidebar-brand span {
            display: none; 
            white-space: nowrap; 
            padding-left: 10px;
        }
        .sidebar:hover .nav-link span,
        .sidebar:hover .sidebar-brand span {
            display: inline; 
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--logo-text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center; 
            padding: 0 1.25rem;
            margin-bottom: 1.5rem;
            height: 40px; 
            overflow: hidden; 
        }
        .sidebar-brand i {
            font-size: 1.8rem; 
            min-width: 40px; 
            text-align: center;
            flex-shrink: 0; 
        }
        .sidebar:hover .sidebar-brand {
            justify-content: flex-start; 
        }

        .nav-link {
            color: var(--inactive-link-text);
            font-size: 1rem;
            padding: 0.75rem 1.25rem;
            margin: 0 0.75rem 0.25rem 0.75rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center; 
             overflow: hidden; 
        }
        .sidebar:hover .nav-link {
            justify-content: flex-start; 
        }
        .nav-link i {
            font-size: 1.3rem;
            min-width: 40px; 
            text-align: center;
            transition: all 0.1s ease;
            flex-shrink: 0; 
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
        
        @media (max-width: 767.98px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                bottom: auto;
                display: flex;
                flex-direction: row; 
                overflow-x: auto; 
                border-right: none;
                border-bottom: 1px solid #daded9;
            }
            .sidebar:hover {
                width: 100%; 
            }
            .sidebar .nav-link {
                justify-content: center;
                flex-direction: column;
                padding: 0.5rem;
                margin: 0.25rem;
                 overflow: visible; 
            }
            .nav-link i { min-width: auto; margin-right: 0; }
            .nav-link span { font-size: 0.75rem; display: block; padding-left: 0; } 
            .sidebar-brand { display: none; } 
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

        <div class="main-content" id="main-content">
            
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    @yield('title') 
                </h1>
                
                <div class="page-header-actions">
                    @yield('header-actions') 
                </div>
            </header>

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
                @yield('content') 
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>