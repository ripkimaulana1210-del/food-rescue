<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Food;
use App\Events\OrderStatusUpdated;
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

        if ($qty > $food->portions) {
            return redirect()->back()->with('error', 'Porsi tidak mencukupi. Tersisa ' . $food->portions . ' porsi.');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'food_id' => $food->id,
            'qty' => $qty,
            'total_price' => $qty * $food->rescue_price,
            'status' => 'pending',
            'order_code' => strtoupper(Str::random(8)),
            'payment_method' => $request->payment,
        ]);

        // Reduce food portions
        $food->portions -= $qty;
        if ($food->portions <= 0) {
            $food->status = 'sold_out';
        }
        $food->save();

        $payment = $request->payment;

        return view('orders.payment_success', compact('order', 'payment'));
    }

    public function scan(Request $request)
    {
        $code = strtoupper(trim($request->code ?? $request->manual_code));

        $order = Order::where('order_code', $code)->first();

        if (!$order) {
            return back()->with('error', 'Pesanan tidak ditemukan');
        }

        // Only the store owner can view this order
        if ($order->food->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk pesanan ini');
        }

        return redirect()->route('orders.scan.result', $order->order_code);
    }

    public function showScanResult($code)
    {
        $order = Order::where('order_code', $code)
            ->with(['food', 'user'])
            ->firstOrFail();

        // Only the store owner can view this order
        if ($order->food->user_id !== auth()->id()) {
            return redirect()->route('store.orders')
                ->with('error', 'Anda tidak memiliki akses untuk pesanan ini');
        }

        return view('orders.scan-result', compact('order'));
    }

    public function complete($id)
    {
        $order = Order::with('food')->findOrFail($id);

        if ($order->food->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses');
        }

        if ($order->status !== 'paid') {
            return back()->with('error', 'Pesanan belum dibayar');
        }

        $order->status = 'done';
        $order->save();

        // Broadcast order status update
        try {
            broadcast(new OrderStatusUpdated($order))->toOthers();
        } catch (\Exception $e) {
            // Silently ignore broadcast failures
        }

        return redirect()->route('store.orders')
            ->with('success', 'Pesanan selesai & makanan diserahkan')
            ->with('highlight_order', $order->id);
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

        // Broadcast order status update
        try {
            broadcast(new OrderStatusUpdated($order))->toOthers();
        } catch (\Exception $e) {
            // Silently ignore broadcast failures
        }

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    /**
     * Get buyer's orders updates (for realtime polling)
     */
    public function getBuyerOrdersUpdates()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('food')
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'status' => $order->status,
                    'order_code' => $order->order_code,
                    'food_name' => $order->food->food_name,
                    'total_price' => $order->total_price,
                    'qty' => $order->qty,
                    'payment_method' => $order->payment_method,
                ];
            });

        return response()->json(['orders' => $orders]);
    }

    /**
     * Get seller's orders updates (for realtime polling)
     */
    public function getSellerOrdersUpdates()
    {
        // Get all orders untuk food milik user
        $orders = Order::whereHas('food', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with('food', 'user')
        ->latest()
        ->get()
        ->map(function ($order) {
            return [
                'id' => $order->id,
                'status' => $order->status,
                'order_code' => $order->order_code,
                'food_name' => $order->food->food_name,
                'buyer_name' => $order->user->name,
                'total_price' => $order->total_price,
                'qty' => $order->qty,
                'payment_method' => $order->payment_method,
            ];
        });

        return response()->json(['orders' => $orders]);
    }
}
