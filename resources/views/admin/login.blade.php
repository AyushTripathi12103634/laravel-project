<style>
    .admin-login {
        padding: 20px 20px;
    }

    .light-mode .admin-login{
        background-color: #e1e1e1; /* Light mode background */
        color: black; /* Text color for light mode */
    }

    .dark-mode .admin-login{
        background-color: #1e1e1e; /* Dark mode background */
        color: white; /* Text color for dark mode */
    }
</style>

<div class="admin-login">
    @if(session('isLogin'))
        <script>
            window.location.href = "{{ url('/') }}";
        </script>
    @endif
    <form method="POST" action="/admin-login-function">
        @csrf
        <h3 class="text-center mb-3">Admin</h3>
        <input class="form-control mb-3" name="email" type="email" required placeholder="Enter Email">
        
        <div class="input-group mb-3">
            <input class="form-control" name="password" type="password" id="password" required placeholder="Enter Password">
            <div class="input-group-append">
                <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </span>
            </div>
        </div>
        <div class="d-flex justify-content-center w-100">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>

<script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>
