<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Determine if the identity is an email or name
        $fieldType = filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Find user by the determined field
        $user = User::where($fieldType, $request->identity)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Retrieve the role name based on the role_id
        $roleName = 'Unknown'; // Default role name
        if ($user->role_id) {
            $role = Role::find($user->role_id); // Fetch role by role_id
            $roleName = $role ? $role->name : 'Unknown';
        }

        // Check if the role is 'applicant' and if the email is not verified
        if ($roleName === 'applicant' && is_null($user->email_verified_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Your email address has not been verified.',
            ], 403);
        }

        // Generate token for authenticated user
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'role' => $roleName,
                    'roles' => [$roleName],
                ],
                'token' => $token,
            ],
        ], 200);
    }
}
