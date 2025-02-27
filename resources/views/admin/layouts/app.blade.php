<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .nav-link {
            color: white !important;
        }
        
        .nav-link:hover {
            background: #34495e;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('admin.partials.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @include('admin.partials.header')
                
                <div class="main-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('admin.partials.scripts')
    @stack('scripts')
</body>
</html>