<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inclusive Learning Hub - For Specially Abled Students')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50C878;
            --accent-color: #FF6B6B;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }
        .navbar {
            background-color: var(--primary-color) !important;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .accessibility-controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .high-contrast {
            filter: contrast(150%);
        }
        .large-text {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-universal-access"></i> Inclusive Learning Hub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('resources.index') }}">
                            <i class="fas fa-book"></i> Learning Resources
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <i class="fas fa-folder"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#accessibility-tools">
                            <i class="fas fa-tools"></i> Accessibility Tools
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <div class="accessibility-controls">
        <div class="btn-group">
            <button class="btn btn-primary" onclick="toggleHighContrast()">
                <i class="fas fa-adjust"></i> High Contrast
            </button>
            <button class="btn btn-primary" onclick="toggleLargeText()">
                <i class="fas fa-text-height"></i> Large Text
            </button>
            <button class="btn btn-primary" onclick="toggleScreenReader()">
                <i class="fas fa-volume-up"></i> Screen Reader
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleHighContrast() {
            document.body.classList.toggle('high-contrast');
        }
        function toggleLargeText() {
            document.body.classList.toggle('large-text');
        }
        function toggleScreenReader() {
            // Implement screen reader functionality
            alert('Screen reader mode activated. Use your screen reader to navigate the content.');
        }
    </script>
</body>
</html> 