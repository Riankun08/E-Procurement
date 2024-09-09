<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;

class AdminAndCheckerController extends Controller
{
    public $route = 'users.';
    public $title = 'User';
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        View::share('route', $this->route);
        View::share('title', $this->title);
    }

    protected function sendOtpEmail($user, $otp)
    {
        Mail::to($user->email)->send(new OtpEmail($otp));
    }

    public function registerAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Generate a numeric OTP
        $otp = Otp::generateNumericOtp();
        $expiresAt = now()->addMinutes(15); // OTP expires in 15 minutes

        $user = null;
        DB::transaction(function () use ($request, &$user, $otp, $expiresAt) {
            $user = $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => Role::where('name', 'admin')->first()->uuid,
                'password' => Hash::make($request->password),
                'email_verified_at' => null // Ensure email is not verified yet
            ]);

            Otp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => $expiresAt,
            ]);
        });

        $this->sendOtpEmail($user, $otp);

        return response()->json([
            'code' => 200,
            'message' => 'Admin successfully registered! Please verify your email.',
            'data' => $user
        ], 200);
    }

    public function registerChecker(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Generate a numeric OTP
        $otp = Otp::generateNumericOtp();
        $expiresAt = now()->addMinutes(15); // OTP expires in 15 minutes

        $user = null;
        DB::transaction(function () use ($request, &$user, $otp, $expiresAt) {
            $user = $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => Role::where('name', 'checker')->first()->uuid,
                'password' => Hash::make($request->password),
                'email_verified_at' => null // Ensure email is not verified yet
            ]);

            Otp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => $expiresAt,
            ]);
        });

        $this->sendOtpEmail($user, $otp);

        return response()->json([
            'code' => 200,
            'message' => 'Checker successfully registered! Please verify your email.',
            'data' => $user
        ], 200);
    }
}
