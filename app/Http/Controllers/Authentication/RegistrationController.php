<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Rules\ValidEmployeeId;

class RegistrationController extends Controller
{
    protected $validator;
    protected $auth;
    protected $hash;
    protected $db;

    public function __construct(
        Validator $validator,
        Auth $auth,
        Hash $hash,
        DB $db
    ) {
        $this->validator = $validator;
        $this->auth = $auth;
        $this->hash = $hash;
        $this->db = $db;
    }

    public function registration()
    {
        $newEmployeeId = $this->generateNewEmployeeId();
        return view('contents.auth.registration', compact('newEmployeeId'));
    }

    public function postregistration(Request $request)
    {
        
            // Validation
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'employee_id' => 'required|valid_employee_id',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'gender' => 'required',
                'address' => 'required',
                'birth_day' => 'required|date',
                'phone_number' => 'required|regex:/^[0-9]+$/|min:10|max:15'
            ]);
            try {
            DB::beginTransaction();
            // Create User
            $createUser = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'employee_id' => $this->generateNewEmployeeId(),
                'position' => $request->input('position'), // Add the position field
                'department' => $request->input('department'), // Add the department field
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
                'password' => bcrypt($request->input('password')), // Note: Not using Hash::make
                'address' => $request->input('address'),
                'birth_day' => $request->input('birth_day'),
                'phone_number' => $request->input('phone_number'),
                'Status' => 'Active', // Set ActiveStatus to 'Active'

            ]);
            DB::commit();
            return redirect('login')->withSuccess('Successfully registered! Please log in.');
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();

            // Check if the error is a duplicate entry error
            if (strpos($errorMessage, 'Duplicate entry') !== false) {
                // Redirect back with a specific error message for duplicate entry
                return redirect('registration')->withError('Email address already in use. Please choose a different one.');
            } else {
                // Redirect back with a general error message
                return redirect('registration')->withError('Error during registration. Please try again.');
            }
        }
    } 
    private function generateNewEmployeeId()
    {
        // Get the latest employee from the database
        $latestEmployee = User::orderBy('employee_id', 'desc')->first();

        // Increment the employee_id
        $newEmployeeId = 'EPI-' . str_pad((intval(substr($latestEmployee->employee_id, 4)) + 1), 3, '0', STR_PAD_LEFT);

        return $newEmployeeId;
    }
    public function showRegistrationForm()
    {
        $newEmployeeId = $this->generateNewEmployeeId();

        return view('auth.registration', compact('newEmployeeId'));
    }
    public function create(array $data)
    {
        return user::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'employee_id' => $data['employee_id'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            
        ]);
    }

    protected function isValidEmailDomain($email)
    {
        return Str::endsWith($email, '@gmail.com');
    }
    public function processEmployeeId(Request $request)
    {
        $request->validate([
            'employee_id' => ['required', new ValidEmployeeId],
            // other validation rules
        ]);

        return response()->json(['message' => 'Validation passed']);
    }

}