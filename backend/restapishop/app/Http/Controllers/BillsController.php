<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Bills;
use App\Http\Resources\BillResource;

class BillsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bills::all();
        $bills = BillResource::collection($bills);
        return $this->successResponse(
            $bills,
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
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'total_amount' => 'required|integer',
            'status' => 'required|string',
        ]);

        $bill = Bills::create($request->all());

        return $this->successResponse(
            new BillResource($bill),
            'Bill created successfully',
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
    public function update(Request $request, string $id)
    {
        $bill = Bills::find($id);
        if (!$bill) {
            return $this->errorResponse(
                'Bill not found',
                404
            );
        }
        $bill->update($request->all());

        return $this->successResponse(
            new BillResource($bill),
            'Bill updated successfully',
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bills::find($id);
        if (!$bill) {
            return $this->errorResponse(
                'Bill not found',
                404
            );
        }
        $bill->delete();

        return $this->successResponse(
            new BillResource($bill),
            'Bill deleted successfully',
            200
        );
    }
}
