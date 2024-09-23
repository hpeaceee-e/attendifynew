<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $users = User::where('role', 2)->paginate($limit)
            ->appends(['limit' => $limit]);

        return response()->json([
            'status' => 'ok',
            'data' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'total_pages' => $users->lastPage(),
                'total_items' => $users->total(),
                'per_page' => $users->perPage(),
                'next_page_url' => $users->nextPageUrl(),
                'prev_page_url' => $users->previousPageUrl(),
            ]
        ]);
    }

    public function store(Request $request)
    {


        //TODO: tambahin key yang mau disimpen, cek json
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => 2,
            ]);

            return response()->json([
                'status' => 'ok',
                'message' => 'Successfully created',
                'data' => $user,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $err->errors(),
            ], 422);
        } catch (\Exception $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user',
            ], 500);
        }
    }


    // Show a specific user
    public function show($id)
    {
        $user = User::where('id', $id)->where('role', 2)->get();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $user,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->where('role', 2)->get();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                // 'password' => 'required|string|min:6',
            ]);

            $user->update($validatedData);
            return response()->json([
                'status' => 'ok',
                'message' => 'Successfully updated',
                'data' => $user,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $err->errors(),
            ], 422);
        } catch (\Exception $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user',
            ], 500);
        }
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::where('id', $id)->where('role', 2)->get();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        try {
            $user->delete();
            return response()->json([
                'status' => 'ok',
                'message' => 'Successfully deleted',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update data',
            ], 500);
        }
    }
}
