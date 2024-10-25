<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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

        .admin-jobs, .admin-jobs table {
            background-color: inherit;
            color: inherit;
        }
    </style>
</head>
<body>
<div class="container admin-jobs mt-5">
    <h3>Admin Profile</h3>
    
    <form method="GET" action="{{ route('admin.profile') }}" class="mb-4">
        <select name="filter" class="form-control w-25 d-inline" onchange="this.form.submit()">
            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Jobs</option>
            <option value="verified" {{ request('filter') == 'verified' ? 'selected' : '' }}>Accepted Jobs</option>
            <option value="unverified" {{ request('filter') == 'unverified' ? 'selected' : '' }}>Unverified Jobs</option>
        </select>
    </form>

    <h4>Jobs</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Company</th>
                <th>Role</th>
                <th>Location</th>
                <th>Salary</th>
                <th>Joining Date</th>
                <th>Status</th>
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
                        <form action="{{ route('admin.profile.verify', $job->job_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="verified" value="1">
                            <button class="btn btn-success">Accept</button>
                        </form>
                        <form action="{{ route('admin.profile.verify', $job->job_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="verified" value="0">
                            <button class="btn btn-danger">Reject</button>
                        </form>
                        <form action="{{ route('employers.jobs.delete', $job->job_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
