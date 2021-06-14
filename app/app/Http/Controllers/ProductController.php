<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), ["product_id" => "required", "quantity" => "required"]);

        if ($validator->fails()) {
            return response(json_encode(["message" => "Please check all the fields"]), 401);
        }

        $product = Product::find($request->product_id);

        if ($product->stock < $request->quantity) {
            return response(json_encode(["message" => "Failed to order this product due to unavailability of the stock"]), 400);
        }

        $product->stock -= $request->quantity;
        $product->save();

        return response(json_encode(["message" => "You have successfully ordered this product."]), 201);

    }
}
