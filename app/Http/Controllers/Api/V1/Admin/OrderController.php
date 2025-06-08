<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::orderByDesc('created_at')->paginate(10);

        return new OrderResource($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        $this->authorize('create', Order::class);

        $validated = $request->validated();

        $order =  Order::create([

            'customer_id' => $validated['customer_id'],
            'price' => $validated['price'],
            'shipping_address' => $validated['shipping_address'],

        ]);


        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('items')->findOrFail($id);

        $this->authorize('view', $order);

        return new OrderResource($order);
    }


    public function update(UpdateOrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);

        $validated = $request->validated();

        if (!in_array($order->status, [OrderStatusEnum::Pending->value(), OrderStatusEnum::Confirmed->value()])) {
            return response()->json([
                'message' => 'Shipping address can only be updated before shipping.',
            ], 403);
        }

        $order->update([

            'shipping_address' => $validated['shipping_address'],

        ]);


        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('delete', $order);


        $order->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
