<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);

        $users = User::select('id', 'name', 'role', 'token')
            ->orderBy('name', 'asc')
            ->paginate($limit)
            ->appends(['limit' => $limit]);

        return response()->json([
            'success' => true,
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

    // mending langsung di-hit dari frontend enterprisely?
    // public function index(Request $request)
    // {
    //     $length = $request->get('length', 10); // limit data
    //     $start = $request->get('start', 0); // DataTables sends 'start' to indicate offset

    //     $currentPage = ($start / $length) + 1;

    //     $users = User::select('id', 'name', 'role', 'token')
    //         ->orderBy('name', 'asc')
    //         ->paginate($length, ['*'], 'page', $currentPage);

    //     // $baseUrl = request()->getSchemeAndHttpHost() . $request->getBaseUrl();

    //     return response()->json([
    //         'success' => true,
    //         'recordsTotal' => $users->total(),
    //         'recordsFiltered' => $users->total(),
    //         'data' => $users->items(),
    //         'pagination' => [
    //             'current_page' => $users->currentPage(),
    //             'total_pages' => $users->lastPage(),
    //             'total_items' => $users->total(),
    //             'per_page' => $users->perPage(),
    //             'next_page_url' => $users->nextPageUrl(),
    //             'prev_page_url' => $users->previousPageUrl(),
    //         ]
    //     ]);
    // }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'username' => 'required|string|max:255|unique:users',
                'telephone' => 'required|string|max:15',
                'place_of_birth' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string|in:Laki - laki,Perempuan',
                'religion' => 'required|string|max:50',
                'address' => 'required|string|max:500',
                'position' => 'nullable|string|max:255',
                'id_card' => 'required|string|size:16|unique:users',
                // 'role' => 'required|integer',
                // 'avatar' => 'nullable|string|max:255',
                'status' => 'required|in:0,1',
                'available' => 'required|integer',
                'schedule' => 'required|integer',
                'delete' => 'required|in:0,1',
                // 'token' => 'required|string|max:255|unique:users',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'username' => $validatedData['username'],
                'telephone' => $validatedData['telephone'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'gender' => $validatedData['gender'],
                'religion' => $validatedData['religion'],
                'address' => $validatedData['address'],
                'position' => $validatedData['position'] ?? null,
                'id_card' => $validatedData['id_card'],
                'role' => $validatedData['role'],
                'avatar' => $validatedData['avatar'] ?? null,
                'status' => $validatedData['status'],
                'available' => $validatedData['available'],
                'schedule' => $validatedData['schedule'],
                'delete' => $validatedData['delete'],
                'token' => Str::random(10),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Successfully created',
                'data' => $user,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $err) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $err->errors(),
            ], 422);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
            ], 500);
        }
    }

    // Show a specific user
    public function show($id)
    {
        $user = User::find($id, ['id', 'name', 'token']);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                // 'role' => 'required|integer',
            ]);

            $user->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated',
                'data' => [
                    'name' => $user->name,
                ],
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $err) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $err->errors(),
            ], 422);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
            ], 500);
        }
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        try {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted',
            ], 200);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update data',
            ], 500);
        }
    }
}
