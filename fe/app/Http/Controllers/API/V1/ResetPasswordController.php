<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Add this line
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = $request->input('token');
        $password = $request->input('password');

        // Log the token for debugging
        Log::info('Reset Password Request', ['token' => $token]);

        $passwordReset = PasswordReset::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$passwordReset) {
            Log::info('Invalid or expired token', ['token' => $token]);
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }

        $user = User::where('email', $passwordReset->email)->first();
        if ($user) {
            $user->password = Hash::make($password);
            $user->save();

            $passwordReset->delete();

            return response()->json(['message' => 'Password successfully reset'], 200);
        }

        Log::info('User not found', ['email' => $passwordReset->email]);
        return response()->json(['message' => 'User not found'], 404);
    }
}
