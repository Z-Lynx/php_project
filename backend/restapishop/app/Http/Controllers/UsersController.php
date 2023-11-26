<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResources;
use App\Http\Requests\StoreUserRequest;

class UsersController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $data = UsersResources::collection($users);

        return $this->successResponse(
            $data,
            '',
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['is_admin'] = null;
        $user = User::create($data);

        return $this->successResponse(
            new UsersResources($user),
            'User created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!$user) {
            return $this->errorResponse(
                'User not found',
                404
            );
        }

        $user->update($request->all());

        return $this->successResponse(
            new UsersResources($user),
            'User updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse(
                'User not found',
                404
            );
        }

        $user->delete();

        return $this->successResponse(
            null,
            'User deleted successfully',
            200
        );
    }
}
