<style>
    .home {
        padding: 20px;
    }

    ul a{
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }
    .light-mode .home{
        background-color: #e1e1e1; /* Light mode background */
        color: black; /* Text color for light mode */
    }

    .dark-mode .home{
        background-color: #1e1e1e; /* Dark mode background */
        color: white; /* Text color for dark mode */
    }
</style>

@if(session('isLogin'))
<div class="home">
    <h1>Welcome User:{{ session('id') }}</h1>
    <h3>You are logged in as {{ session('role') }}</h3>
    <h5>Below are the features you can access: </h5>
    <ul>
        @if(session('role') == 'admin')
        <a href="{{ route('admin.profile') }}"><li>Accept job listings</li></a>
        <a href="{{ route('admin.profile') }}"><li>Reject job listings</li></a>
        @endif

        @if(session('role') == 'Employer')
        <a href="{{ route('employers.create-job') }}"><li>Create Jobs</li></a>
        <a href="{{ route('employers.jobs') }}"><li>Delete Jobs</li></a>
        <a href="{{ route('employers.jobs') }}"><li>View Applicants</li></a>
        <a href="{{ route('employers.jobs') }}"><li>View Jobs</li></a>
        @endif

        @if(session('role') == 'Candidate')
        <a href="{{ route('candidates.applied-jobs') }}"><li>View Applied Jobs</li></a>
        <a href="{{ route('candidates.jobs') }}"><li>Apply for jobs</li></a>
        @endif
    </ul>
</div>
@else
<div class="home">
    <h1>Please login to view details</h1>
</div>
@endif