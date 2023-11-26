<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductClientResource;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Product;

class ClientController extends Controller
{
    use HttpResponses;

    public function getProducts(Request $request)
    {

        $products = Product::paginate(20);
        $products = ProductClientResource::collection($products);

        return $this->successResponse(
            $products,
            '',
            200
        );
    }
    
}
