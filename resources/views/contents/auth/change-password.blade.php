@extends('layouts.app')

@section('contents')

<form action="{{ route('first-time-change-login.update') }}" method="POST" autocomplete="off">

    @csrf

    <div class="container" style="margin-top: -30px">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 my-1">
                @if (session('success'))
                    <div class="col-12 mt-2">
                        <div class="alert alert-success">{{ session('success') }}</div>
                    </div>
                @elseif (session('error'))
                    <div class="col-12 mt-2">
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 my-1">
                <h4>CREATE A STRONG PASSWORD</h4>
                <p>
                    Welcome! To keep your account secure, please take a moment to set a strong password. Avoid using easily guessable information. Thank you for helping us keep your account safe!
                </p>
            </div>
        </div>
        <div style="display: flex; flex-flow: row wrap; justify-content: center; align-items: center;">
            <div class="column" style="max-width: 400px">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 my-1">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password"  placeholder="New Password *" required>
                            <label for="password">New Password <span class="text-danger">*</span></label>
                            <span id="showEye">
                                <i class='bx bxs-hide' id="eye" onclick="showPassword(pass, eye)"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 my-1">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password-confirmation" name="password_confirmation"  placeholder="Confirm New Password *" required>
                            <label for="password-confirmation">Confirm New Password <span class="text-danger">*</span></label>
                            <span id="showEye">
                                <i class='bx bxs-hide' id="eye1" onclick="showPassword(pass1, eye1)"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 my-1">
                        <div id="pswd_infoo" class="mt-2">
                            <b>Password must meet the following requirements:</b>
                            <ul>
                                <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                <li id="lowercase" class="invalid">At least <strong>one lowercase letter</strong></li>
                                <li id="number" class="invalid">At least <strong>one number</strong></li>
                                <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 my-1" style="text-align: center">
                <button type="submit" class="btn btn-success">Save Password</button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('input[name=password]').keyup(function() {
            var pswd = $(this).val();
            if ( pswd.length < 8 ) {
                $('#length').removeClass('valid').addClass('invalid');
            } else {
                $('#length').removeClass('invalid').addClass('valid');
            }

            //validate capital letter
            if ( pswd.match(/[A-Z]/) ) {
                $('#capital').removeClass('invalid').addClass('valid');
            } else {
                $('#capital').removeClass('valid').addClass('invalid');
            }

            //validate lowecase letter
            if ( pswd.match(/[a-z]/) ) {
                $('#lowercase').removeClass('invalid').addClass('valid');
            } else {
                $('#lowercase').removeClass('valid').addClass('invalid');
            }

            //validate number
            if ( pswd.match(/\d/) ) {
                $('#number').removeClass('invalid').addClass('valid');
            } else {
                $('#number').removeClass('valid').addClass('invalid');
            }
        });
    });
</script>
@endsection
