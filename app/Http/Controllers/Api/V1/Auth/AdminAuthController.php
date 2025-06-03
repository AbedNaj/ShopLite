<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminAuthController extends Controller
{
    use AuthorizesRequests;
    public function login(Request $request)
    {


        $validated = $request->validate([
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
            'data' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
        ]);
    }


    public function me(Request $request)
    {

        return response()->json([
            'data' => $request->user(),
        ]);
    }
    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
