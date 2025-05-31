<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        try {
            $validated =  $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $adminID = Role::where('name', 'admin')->value('id');

            $admin = User::where('email', $validated['email'])
                ->where('role_id', $adminID)
                ->first();

            if (! $admin || ! Hash::check($validated['password'], $admin->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $admin->createToken('admin_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,

                ],
            ]);
        } catch (\Throwable $e) {

            Log::error('Admin login error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',

            ], 500);
        }
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
