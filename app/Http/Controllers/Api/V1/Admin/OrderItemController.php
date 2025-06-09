<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Resources\Admin\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderItemController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderItemRequest $request)
    {
        $this->authorize('create', OrderItem::class);


        $validated = $request->validated();

        $orderItem = OrderItem::create([
            'product_id' => $validated['product_id'],
            'order_id' => $validated['order_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price']
        ]);

        return new OrderItemResource($orderItem);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $this->authorize('delete', $orderItem);

        $orderItem->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
