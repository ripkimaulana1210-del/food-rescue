<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Food;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout($id)
    {
        $food = Food::findOrFail($id);

        $order = Order::create([
            'user_id' => auth()->id(),
            'food_id' => $food->id,
            'qty' => 1,
            'total_price' => $food->rescue_price,
            'status' => 'pending',
            'order_code' => strtoupper(Str::random(8)),
        ]);

        return redirect()->route('orders.show', $order->id);
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('food')
            ->latest()
            ->get();

        return view('orders.pesanan-saya', compact('orders'));
    }

    public function store(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $qty = $request->qty;

        $order = Order::create([
            'user_id' => auth()->id(),
            'food_id' => $food->id,
            'qty' => $qty,
            'total_price' => $qty * $food->rescue_price,
            'status' => 'pending',
            'order_code' => strtoupper(Str::random(8)),
        ]);

        $payment = $request->payment;

        return view('orders.payment_success', compact('order', 'payment'));
    }

    public function scan(Request $request)
    {
        $order = Order::where('order_code', $request->code)->first();

        if (!$order) {
            return back()->with('error', 'Pesanan tidak ditemukan');
        }

        $order->status = 'done';
        $order->save();

        return back()->with('success', 'Pesanan berhasil divalidasi & selesai');
    }

    public function show($id)
    {
        $order = Order::with('food')->findOrFail($id);
        return view('orders.payment_success', compact('order'));
    }

    public function confirm($id)
    {
        $order = Order::with('food')->findOrFail($id);

        if ($order->food->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        $order->status = 'paid';
        $order->save();

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}
