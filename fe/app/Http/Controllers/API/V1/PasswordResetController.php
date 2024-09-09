<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Handle the password reset request.
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
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

        $email = $request->input('email');
        $token = $request->input('token');
        $password = $request->input('password');

        // Check if the token is valid
        $passwordReset = PasswordReset::where('email', $email)
            ->where('token', $token)
            ->where('created_at', '>', now()->subMinutes(60)) // Token is valid for 60 minutes
            ->first();

        if (!$passwordReset) {
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }

        // Update the user's password
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($password);
            $user->save();

            // Delete the used token
            $passwordReset->delete();

            return response()->json([
                'message' => 'Password successfully reset',
                'user' => $user
            ], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
