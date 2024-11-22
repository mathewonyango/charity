<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Otp;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\UserCreatedMail;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'in:admin,user', // Allow only 'admin' or 'user'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'code' => '999',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user', // Default to 'user' if role is not provided
        ]);


        return response()->json([
            'code' => '000',
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            try {
                // Generate OTP
                $otpCode = rand(100000, 999999);
                $expiresAt = now()->addMinutes(5);

                // Log before saving OTP
                Log::info('Generating OTP for user:', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'otp' => $otpCode
                ]);

                // Save OTP to the database
                $otp = Otp::create([
                    'user_id' => $user->id,
                    'otp' => $otpCode,
                    'expires_at' => $expiresAt,
                    'validated' => false,
                ]);

                // Log before sending email
                Log::info('Attempting to send OTP email to:', [
                    'email' => $user->email
                ]);

                // Send OTP with error handling
                try {
                    Mail::to($user->email)->send(new SendOtpMail($otpCode));
                    Log::info('OTP email sent successfully');
                } catch (\Exception $emailError) {
                    Log::error('Failed to send OTP email:', [
                        'error' => $emailError->getMessage(),
                        'trace' => $emailError->getTraceAsString()
                    ]);

                    // Optional: You might want to handle this differently
                    return response()->json([
                        'code' => '001',
                        'message' => 'Login successful but failed to send OTP. Please contact support.',
                    ], 500);
                }

                return response()->json([
                    'code' => '000',
                    'message' => 'Login successful. OTP sent to your email.',
                    "otp"=>$otpCode

                ], 200);

            } catch (\Exception $e) {
                Log::error('Error in login process:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return response()->json([
                    'code' => '002',
                    'message' => 'An error occurred during login process.',
                ], 500);
            }
        }

        return response()->json([
            'code' => '999',
            'message' => 'Invalid credentials',
        ], 401);
    }
    public function validateOtp(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        // Find the user by email
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return response()->json([
                'code' => '999',
                'message' => 'Invalid email address.',
            ], 404);
        }

        // Find the OTP associated with the user
        $otpRecord = Otp::where('user_id', $user->id)
            ->where('otp', $validatedData['otp'])
            ->where('validated', false) // Ensure the OTP hasn't already been used
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'code' => '999',
                'message' => 'Invalid OTP.',
            ], 400);
        }

        // Check if the OTP has expired
        if (now()->greaterThan($otpRecord->expires_at)) {
            return response()->json([
                'code' => '999',
                'message' => 'OTP has expired.',
            ], 400);
        }

        // Mark the OTP as validated
        $otpRecord->update(['validated' => true]);

        return response()->json([
            'code' => '000',
            'message' => 'OTP validated successfully.',
        ], 200);
    }


    public function profile(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        return response()->json([
            'code' => '000',
            'message' => 'Profile fetched successfully',
            'data' => [
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'pending_contributions' => $user->contributions()->where('status', 'Ongoing')->get(),
                'pending_events' => $user->events()->where('status', 'Ongoing')->get(),
            ],
        ], 200);
    }



    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        $user_count=$users->count();

        // Return the view with users data
        return view('users.index', compact('users','user_count'));
    }
    public function toggleStatus(User $user)
{
    $user->status = $user->status === 'active' ? 'inactive' : 'active';
    $user->save();
    toast("User status updated successfully!", "success");


    return redirect()->route('portal.users.index')->with('success', 'User status updated successfully!');
}


public function edit($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Return the edit view with the user data
    return view('users.edit', compact('user'));
}


public function update(Request $request, $id)
{
    // Validate the incoming data
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email,' . $id,
        'phone_number' => 'required',
        'role' => 'required',
        // Add any other validation rules here
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Update the user's details
    $user->email = $request->input('email');
    $user->phone_number = $request->input('phone_number');
    $user->role = $request->input('role');
    // Update any other fields you need here

    // Save the updated user data
    $user->save();
    toast("User updated successfully!", "success");

    // Redirect back to the users list with a success message
    return redirect()->route('portal.users.index');
}

 public function create(){
    return view('users.create');
 }


 public function store(Request $request)
{
    // Validate only email, phone_number, and role
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email', // Email is required and must be unique
        'phone_number' => 'nullable|string', // Phone number is optional, but should be a string
        'role' => 'required|in:admin,user', // Role (type) must be either 'admin' or 'user'
    ]);

    // Create a new user
    $user = new User();
    $user->email = $validated['email']; // Store the email
    $user->phone_number = $validated['phone_number']; // Store the phone number (if provided)
    $user->role = $validated['role']; // Store the role (admin or user)

    // You can also generate a default password or ask the user to input it. Here, we set a default password.
    // You could also remove the password part if you don't want to set it here.
    $user->password = bcrypt('defaultpassword'); // Default password for new user

    // Save the user
    $user->save();

    // Send the email
    Mail::to($user->email)->send(new UserCreatedMail($user));
    toast("User created successfully and email sent.!", "success");


    // Redirect back to the user index page with success message
    return redirect()->route('portal.users.index');
}


public function show(User $user)
{
    // Fetch events created by the user
    $events = $user->events()->latest()->get();

    // Fetch contributions created by the user
    $contributions = $user->contributions()->latest()->get();

    return view('users.view', compact('user', 'events', 'contributions'));
}


public function resetPassword(Request $request)
{
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'identifier' => 'required', // Either phone or email
        'password' => 'required|min:8|confirmed', // Ensure password is confirmed
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 400);
    }

    // Search for user by email or phone number
    $user = User::where('email', $request->input('identifier'))
                ->orWhere('phone_number', $request->input('identifier'))
                ->first();

    // If user not found, return an error
    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User not found with the provided identifier',
        ], 404);
    }

    // Update the user's password
    $user->password = Hash::make($request->input('password'));
    $user->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Password reset successfully',
    ]);
}
}
