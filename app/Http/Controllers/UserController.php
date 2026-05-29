<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function add_user(Request $request): JsonResponse
    {
        $validated_data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'status' => 'string|in:Active,Inactive',
        ]);

        $validated_data['password'] = Hash::make($validated_data['password']);
        
        $user = User::create($validated_data);

        $toke = $user->createToken($user->first_name, ['*'], now()->addDays(1))->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'token' => $toke,
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'role' => $user->role,
                'username' => $user->username,
                'status' => $user->status
            ]
        ], 200);
    }

    public function update_user(Request $request, $id): JsonResponse
    {
        $validated_data = $request->validate([
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "username"=> ["required","string","max:255",
                Rule::unique('users', 'username')->ignore($id)
            ],
            "role" => "required|string|max:255",
            "password" => "required|string|min:6",
            "status" => "required|string|in:Active,Inactive",
        ]);

        $validated_data["password"] = Hash::make($validated_data["password"]);
        $user = User::findOrFail($id);
        $user->update($validated_data);

        return response()->json([
            "message" => "User updated successfully",
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'role' => $user->role,
                'username' => $user->username,
                'status' => $user->status
            ]
        ], 200);
    }

    public function delete_user($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            "message" => "User deleted successfully",
            "userId" => $id
        ], 200);
    }

    public function get_users(): JsonResponse
    {
        $users = User::all(['id', 'first_name', 'last_name', 'role', 'username', 'status']);

        return response()->json($users, 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'=> 'required|string',
            'password' => 'required|string'
        ]);
        
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return response()->json([
                "message" => "No user found"
            ], 404);
        }

        if(!Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                "message" => "User Credential is wrong"
            ], 401);
        }

        $toke = $user->createToken($user->first_name, ['*'], now()->addDays(1))->plainTextToken;

        return response()->json([
            "token" => $toke,
            "role" => $user->role,
            "message" => "User login successfull"
        ], 200);
    }
}

