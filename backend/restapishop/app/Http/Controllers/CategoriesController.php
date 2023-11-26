<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();

        return $this->successResponse(
            $categories,
            '',
            200,
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $category = Categories::create($request->all());

        return $this->successResponse(
            $category->toArray(),
            'Category created successfully',
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
    public function update(Request $request, Categories $category)
    {
        if (!$category) {
            return $this->errorResponse(
                'Category not found',
                404
            );
        }

        $category->update($request->all());

        return $this->successResponse(
            $category->toArray(),
            'Category updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::find($id);

        if (!$category) {
            return $this->errorResponse(
                'Category not found',
                404
            );
        }

        $category->delete();

        return $this->successResponse(
            null,
            'Category deleted successfully',
            200
        );
    }
}
