@extends('layouts.auth')

@section('contents')

    <h1 style="text-align: center; margin-top: 150px; color: #14592d">Eternal Plans, Inc</h1>
    <h1 style="text-align: center; color: #14592d">Management Information System</h1>
    <div class="container" style="max-width: 500px;">
        <div class="mt-5">
            <form action="{{ route('registration.post') }}" method="POST">

                @csrf

                <h5 class="text-center"><b>Register with your details.</b></h5>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    
                <a href="{{ url('/') }}" class="btn-success mb-3" style="text-decoration: none;">
                    <i class="ri-arrow-left-circle-line icon-size" style="font-size: 24px;"></i>
                </a>
                

                        <br><br>
                            
                            <div class="form-floating mb-3">
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter your First Name" required autofocus autocomplete="given-name"/>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter your Last Name" required autocomplete="family-name"/>
                                <label for="last_name">Last Name</label>
                            </div>
                            <div class="form-floating mb-3 " >
                                <select id="department" name="department" class="form-control" required autocomplete="sex">
                                    <option value="" disabled selected>Select your Department</option>
                                    <option value="accounting">Accounting</option>
                                    <option value="concervation">Concervation</option>
                                    <option value="hr">Human Resources</option>
                                    <option value="csu">Customer Service</option>
                                    <option value="mis">MIS</option>
                                    <option value="treasury">Treasury</option>
                                    <option value="sales">Sale's</option>
                                    <option value="claims">Claims</option>
                                    <option value="admin">Admin</option>
                                    <option value="pad">Plan Admin</option>
                                    <option value="contractual">Contractual</option>
                                </select>
                                <label for="department">Department</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" id="position" name="position" class="form-control" placeholder="Enter your Position" required autocomplete="family-name"/>
                                <label for="position">Position</label>
                            </div>
                            <div class="form-floating mb-3 " >
                                <select id="gender" name="gender" class="form-control" required autocomplete="sex">
                                    <option value="" disabled selected>Select your gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Choose not to say</option>
                                </select>
                                <label for="gender">Gender</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter your Email" required autocomplete="email"/>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Enter your Phone Number" required autocomplete="tel"/>
                                <label for="phone_number">Phone Number</label>
                            </div>                    
                                <div class="form-floating mb-3">
                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter your Address" required autocomplete="address-line1"/>
                                <label for="address">Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" id="birth_day" name="birth_day" class="form-control" required autocomplete="bday"/>
                                <label for="birth_day">Birth Day</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" id="employee_id" name="employee_id" class="form-control" value="{{ $newEmployeeId }}" readonly required autofocus autocomplete="off"/>
                                <label for="employee_id">Employee Id</label>
                            </div>                                       
                            <div class="form-floating mb-3" id="show_hide_password">
                                    <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password" />
                                    <label for="password">Password</label>
                                    <span id="showEye">
                                        <i class='bx bxs-hide' id="eye" onclick="showPassword(pass, eye)"></i>
                                    </span>
                            </div>
                            <div class="form-floating mb-3" id="show_hide_password">
                                <input type="password" id="password-confirmation" name="password-confirmation" class="form-control" required autocomplete="new-password" />
                                <label for="password-confirmation">Confirm Password</label>
                                <span id="showEye">
                                    <i class='bx bxs-hide' id="eye1" onclick="showPassword(pass1, eye1)"></i>
                                </span>
                            </div>                                                                                                                                                    
                            <button style="width: 100%" type="submit" id="signup-btn" class="btn btn-success mb-3"><i class="ri-account-pin-circle-line"></i>Sign Up</button>         
                        <div class="text-center mt-3">
                            <p>Have an account? <a href="{{ '/' }}">Log in here!</a>.</p>
                        </div>
            </form>
        </div>
    </div>
@endsection
