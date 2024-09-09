<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // Import Carbon for date/time manipulation
use Illuminate\Support\Facades\Log; // Import Log for debugging

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = Str::random(60);

        // Calculate expires_at as created_at + 60 minutes
        $expiresAt = Carbon::now()->addMinutes(60);

        Log::info('Token: ' . $token);
        Log::info('Expires At: ' . $expiresAt);

        // Save the token and calculated expires_at to the database
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token, 'expires_at' => $expiresAt]
        );

        // Send the reset password email with the token
        Mail::to($user->email)->send(new ResetPasswordEmail($token));

        return response()->json(['message' => 'Password reset link sent'], 200);
    }
}
