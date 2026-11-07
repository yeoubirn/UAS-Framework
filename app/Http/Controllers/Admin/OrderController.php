<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(): View
    {
        $orders = Order::with(['user', 'service'])->latest()->paginate(10);

        $statuses = [
            'pending' => 'Pending',
            'dikonfirmasi' => 'Dikonfirmasi',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,dikonfirmasi,selesai,ditolak'],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diubah menjadi ' . ucfirst($validated['status']) . '.');
    }
}
