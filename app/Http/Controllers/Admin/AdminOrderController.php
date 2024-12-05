<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Display a listing of the orders
    public function index()
    {
        $orders = Order::all();  // You can customize this as needed, e.g., paginate results
        return view('admin.orders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function create()
    {
        return view('admin.orders.create');
    }

    // Store a newly created order in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_total' => 'required|numeric',
            'status' => 'required|string',
            // Add other fields as needed
        ]);

        Order::create($validatedData); // Create the order

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    // Show the form for editing the specified order
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Update the specified order in storage
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_total' => 'required|numeric',
            'status' => 'required|string',
            // Add other fields as needed
        ]);

        $order->update($validatedData); // Update the order

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    // Remove the specified order from storage
    public function destroy(Order $order)
    {
        $order->delete(); // Delete the order

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
