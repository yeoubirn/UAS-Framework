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
        $orders = Order::with(['user', 'orderDetails.service.category'])->latest()->paginate(10);

        $statuses = [
            'pending' => 'Pending',
            'dikonfirmasi' => 'Dikonfirmasi',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];

        $counts = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'dikonfirmasi' => Order::where('status', 'dikonfirmasi')->count(),
            'selesai' => Order::where('status', 'selesai')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statuses', 'counts'));
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

        $label = $order->nomor_pesanan ?: '#' . $order->id;

        return back()->with('success', 'Status pesanan ' . $label . ' berhasil diubah menjadi ' . ucfirst($validated['status']) . '.');
    }
}
