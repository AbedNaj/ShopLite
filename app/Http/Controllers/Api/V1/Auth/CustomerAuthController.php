<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\auth\CustomerAuthResource;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $validated =  $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $customerID = Role::where('name', 'customer')->value('id');

            $customer = User::where('email', $validated['email'])
                ->where('role_id', $customerID)
                ->first();

            if (! $customer || ! Hash::check($validated['password'], $customer->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $customer->createToken('admin_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'customer' => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,

                ],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
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

    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Fake Data Until Make Real Register
        Customer::create(
            [
                'user_id' => $user['id'],
                'phone' => '123456789',
                'address' => 'address',
                'city' => 'city',
            ]
        );
        return new CustomerAuthResource($user);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
