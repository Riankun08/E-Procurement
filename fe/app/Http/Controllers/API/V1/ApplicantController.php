<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Applicant;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use Illuminate\Support\Facades\DB;
use App\Services\OtpResendService;

class ApplicantController extends Controller
{
    protected function sendOtpEmail($user, $otp)
    {
        Mail::to($user->email)->send(new OtpEmail($otp));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:255|unique:users,phone',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
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
        $expiresAt = now()->addMinutes(3);

        $user = null;
        $applicant = null;
        DB::transaction(function () use ($request, &$user, &$applicant, $otp, $expiresAt) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => Role::where('name', 'applicant')->first()->uuid,
                'password' => Hash::make($request->password),
                'email_verified_at' => null
            ]);

            Otp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => $expiresAt,
            ]);

            $applicant = Applicant::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'gender' => $request->gender
            ]);
        });

        if ($user && $applicant) {
            $this->sendOtpEmail($user, $otp);

            return response()->json([
                'code' => 200,
                'message' => 'Applicant successfully registered! Please verify your email.',
                'data' => $applicant->load('user')
            ], 200);
        }

        return response()->json([
            'code' => 500,
            'message' => 'Failed to register applicant.'
        ], 500);
    }


    public function resendOtp(Request $request, OtpResendService $otpResendService)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => 'User not found.',
            ], 404);
        }

        return $otpResendService->resendOtp($user);
    }


}

