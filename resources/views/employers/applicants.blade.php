<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants for Job ID: {{ $jobId }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body.light-mode {
            background-color: white;
            color: black;
        }

        body.dark-mode {
            background-color: black; /* Dark background */
            color: white; /* Light text color */
        }

        .applicant, .applicant table{
            background-color: inherit;
            color: inherit;
        }
    </style>
</head>
<body>
<div class="applicant container mt-5">
    <h3>Applicants for Job ID: {{ $jobId }}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicants as $applicant)
                <tr>
                    <td>{{ $applicant->name }}</td>
                    <td>{{ $applicant->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
