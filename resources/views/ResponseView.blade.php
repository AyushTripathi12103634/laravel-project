<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="card {{ $status === 'success' ? 'bg-success text-white' : 'bg-danger text-white' }}">
        <div class="card-body text-center">
            <h4 class="card-title">{{ ucfirst($status) }}</h4>
            <p class="card-text">{{ $message }}</p>
            <a href="{{ $redirectUrl }}" class="btn btn-light">Go to Next</a>
            <div class="mt-3">
                <p>Response Code: <strong>{{ $code }}</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
