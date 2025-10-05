<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App Pegawai')</title>
</head>
<body>

    <header>
        <h1>App Pegawai</h1>
        <nav>
            <ul>
                <li><a href="#">Employee</a></li>
                <li><a href="#">Department</a></li>
                <li><a href="#">Attendance</a></li>
                <li><a href="#">Report</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    
    <footer>
        <p>&copy; {{ date('Y') }} App Pegawai</p>
    </footer>

</body>
</html>