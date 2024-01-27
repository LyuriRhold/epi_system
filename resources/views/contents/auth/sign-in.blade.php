@extends('layouts.auth')

@section('contents')

<h1 style="text-align: center; margin-top: 150px; color: #14592d">Eternal Plans, Inc.</h1>
    <h1 style="text-align: center; color: #14592d">Management Information System</h1>
<div class="container" style="max-width: 500px;">
    <div class="mt-5">
        <form action="{{ route('sign-in') }}" method="POST">

            @csrf

            <h5 class="text-center"><b>Login with your employee id and password.</b></h5>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3" id="show_hide_password">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                <span id="showEye">
                    <i class='bx bxs-hide' id="eye" onclick="showPassword(pass, eye)"></i>
                </span>
            </div>

            @include('components.form_errors')
            
                <input style="width: 100%" type="submit" value="Login"  class="btn btn-success mb-3">
            <div class="text-center mt-3">
                <p>No account? <a href="{{ route('registration') }}">Register here</a>.</p>
            </div>
        </form>
    </div>
</div>

@endsection
