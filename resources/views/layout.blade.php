<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body.light-mode {
            background-color: white;
            color: black;
        }

        body.dark-mode {
            background-color: black; /* Dark background */
            color: white; /* Light text color */
        }

        .navbar {
            height: 80px;
            background-color: #e1e1e1; /* Light mode navbar color */
        }

        body.dark-mode .navbar {
            background-color: #1e1e1e; /* Dark mode navbar color */
        }

        .footer {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100px;
            position: static;
            bottom: 0;
            background-color: #e1e1e1; /* Light mode footer color */
            color: black; /* Dark text color in light mode */
        }

        body.dark-mode .footer {
            background-color: #1e1e1e; /* Dark mode footer color */
            color: white; /* Light text color in dark mode */
        }

        .links a, h1 a {
            text-decoration: none;
            color: inherit; /* Use inherited color */
            cursor: pointer;
        }

        .view {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
            padding: 40px 60px;
            overflow-y: auto; /* Change to auto to show scrollbar only when needed */
            overflow-x: hidden;
        }

        /* Hide scrollbar for WebKit browsers (Chrome, Safari) */
        .view::-webkit-scrollbar {
            display: none; /* Hide scrollbar */
        }

        /* Hide scrollbar for IE, Edge, and Firefox */
        .view {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
    </style>
</head>
<body class="{{ session('darkMode') ? 'dark-mode' : 'light-mode' }}">
    <div class="navbar d-flex justify-content-between align-items-center w-100">
        <div class="logo align-items-center">
            <h1><a href="{{ route('home') }}">Job Board</a></h1>
        </div>
        <div class="links w-50 d-flex justify-content-around align-items-center">
            @if(session('isLogin') && session('isLogin') === true)
                @if(session('role') === 'Employer')
                    <a href="{{ route('employers.create-job') }}">New Job</a>
                    <a href="{{ route('employers.jobs') }}">Jobs</a>
                @elseif(session('role') === 'Candidate')
                    <a href="{{ route('candidates.applied-jobs') }}">Applied Jobs</a>
                    <a href="{{ route('candidates.jobs') }}">Jobs</a>
                @elseif(session('role') === 'admin')
                    <a href="{{ route('admin.profile') }}">Profile</a>
                @endif
            @else
                <a href="{{ route('auth.login') }}">Login</a>
                <a href="{{ route('auth.register') }}">Register</a>
                <a href="{{ route('admin.login') }}">Admin-Login</a>
            @endif
            
            <script>
                function toggleTheme() {
                    const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                    // Update body classes
                    document.body.classList.toggle('dark-mode');
                    document.body.classList.toggle('light-mode');

                    // Update button text
                    const button = document.getElementById('theme-toggle');
                    if (newTheme === 'dark') {
                        button.innerText = 'Light Mode';
                        button.classList.remove('bg-light', 'text-dark');
                        button.classList.add('bg-dark', 'text-light');
                    } else {
                        button.innerText = 'Dark Mode';
                        button.classList.remove('bg-dark', 'text-light');
                        button.classList.add('bg-light', 'text-dark');
                    }

                    // Send the theme change request
                    fetch(`/toggle-theme`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ theme: newTheme })
                    });
                }
            </script>

            <button id="theme-toggle" class="{{ session('darkMode') ? 'bg-dark text-light' : 'bg-light text-dark' }} btn" onclick="toggleTheme()">
                {{ session('darkMode') ? 'Light Mode' : 'Dark Mode' }}
            </button>
            
            @if(session('isLogin'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            @endif
        </div>
    </div>
    <div class="view">
        @include($view)
    </div>
    <!-- <div class="footer w-100">
        <h2>CoffeeCoders - Daikehorus</h2>
    </div> -->
</body>
</html>
