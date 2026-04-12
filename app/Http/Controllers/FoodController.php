<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $foods = Food::latest()->get();
        return view('marketplace', compact('foods'));
    }

    public function show($id)
    {
        $food = Food::findOrFail($id);
        return view('food_detail', compact('food'));
    }

    public function create()
    {
        return view('store.sell');
    }

    public function store(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('foods', 'public');
        }

        Food::create([
            'user_id' => auth()->id(),
            'store_name' => $request->store_name,
            'food_name' => $request->food_name,
            'image' => $image,
            'original_price' => $request->original_price,
            'rescue_price' => $request->rescue_price,
            'portions' => $request->portions,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'expired_at' => $request->expired_at
        ]);

        return redirect('/foods');
    }

    public function buy(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $qty = $request->qty;

        if ($qty > $food->portions) {
            return redirect()->back()->with('error', 'Porsi tidak cukup');
        }

        $food->portions -= $qty;

        if ($food->portions <= 0) {
            $food->status = 'sold_out';
        }

        $food->save();

        return redirect('/foods')->with('success', 'Berhasil mengambil makanan');
    }

    public function checkout(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $qty = $request->qty;

        return view('checkout', compact('food', 'qty'));
    }

    public function pay(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $qty = $request->qty;

        if ($qty > $food->portions) {
            return redirect()->back()->with('error', 'Porsi tidak cukup');
        }

        // kurangi stok
        $food->portions -= $qty;

        if ($food->portions <= 0) {
            $food->status = 'sold_out';
        }

        $food->save();

        // 🔥 SIMPAN ORDER
        Order::create([
            'user_id' => auth()->id(),
            'food_id' => $food->id,
            'qty' => $qty,
            'total_price' => $qty * $food->rescue_price,
            'status' => 'paid'
        ]);

        $payment = $request->payment;

        return view('payment_success', compact('food', 'qty', 'payment'));
    }

    public function myFoods()
    {
        $foods = Food::where('user_id', Auth::id())->get();
        return view('store.my_foods', compact('foods'));
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('store.edit_food', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('foods', 'public');
            $food->image = $image;
        }

        $food->update([
            'store_name' => $request->store_name,
            'food_name' => $request->food_name,
            'original_price' => $request->original_price,
            'rescue_price' => $request->rescue_price,
            'portions' => $request->portions,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'expired_at' => $request->expired_at
        ]);

        return redirect('/my-foods');
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect('/my-foods');
    }

    public function pesanan()
    {
        $orders = Order::with(['food', 'user'])
            ->where('status', 'paid')
            ->whereHas('food', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('store.pesanan', compact('orders'));
    }
}
