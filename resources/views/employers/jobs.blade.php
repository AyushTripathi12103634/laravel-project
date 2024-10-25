<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Posted Jobs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style>
        body.light-mode .jobs-list {
            background-color: white;
            color: black;
        }

        body.dark-mode .jobs-list {
            background-color: black; /* Dark background */
            color: white; /* Light text color */
        }

        body.light-mode .jobs-list table {
            background-color: inherit;
            color: inherit;
        }

        body.dark-mode .jobs-list table {
            background-color: inherit; /* Dark background */
            color: inherit; /* Light text color */
        }
    </style>
</head>
<body>
<div class="container mt-5 jobs-list">
    <h3>Your Posted Jobs</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Company</th>
                <th>Role</th>
                <th>Location</th>
                <th>Salary</th>
                <th>Joining Date</th>
                <th>Verified Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->company }}</td>
                    <td>{{ $job->role }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->salary }}</td>
                    <td>{{ $job->joining_date }}</td>
                    <td>
                        @if($job->verified)
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if($job->verified)
                            <a href="{{ route('employers.jobs.applicants', $job->job_id) }}" class="btn btn-info">View Applicants</a>
                        @endif
                        <form action="{{ route('employers.jobs.delete', $job->job_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
