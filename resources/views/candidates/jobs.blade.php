<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Jobs</title>
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

        .available-jobs, .available-jobs table{
            background-color: inherit;
            color: inherit;
        }
    </style>
</head>
<body>
<div class="available-jobs container mt-5">
    <h3>Available Jobs</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Company</th>
                <th>Role</th>
                <th>Location</th>
                <th>Salary</th>
                <th>Joining Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($jobs->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No jobs available.</td>
                </tr>
            @else
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->company }}</td>
                        <td>{{ $job->role }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ $job->salary }}</td>
                        <td>{{ $job->joining_date }}</td>
                        <td>
                            <form action="{{ route('apply.for.job', $job->job_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-primary">Apply</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
</body>
</html>
