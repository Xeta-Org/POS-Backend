<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Str;

class UserController extends Controller
{
    public function add_user(Request $request): JsonResponse
    {
        $validated_data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'status' => 'string|in:active,inactive',
        ]);

        $validated_data['password'] = Hash::make($validated_data['password']);
        
        $user = User::create($validated_data);

        return response()->json([
            'message' => 'User created successfully'
        ], 200);
    }

    public function update_user(Request $request, $id): JsonResponse
    {
        $validated_data = $request->validate([
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "role" => "required|string|max:255",
            "password" => "required|string|min:6",
            "status" => "required|string|in:active,inactive",
        ]);

        $validated_data["password"] = Hash::make($validated_data["password"]);
        $user = User::findOrFail($id);
        $user->update($validated_data);

        return response()->json([
            "message" => "User updated successfully"
        ], 200);
    }

    public function delete_user($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            "message" => "User deleted successfully"
        ], 200);
    }

    public function get_users(): JsonResponse
    {
        $users = User::all(['id', 'first_name', 'last_name', 'role']);

        return response()->json($users, 200);
    }
}

