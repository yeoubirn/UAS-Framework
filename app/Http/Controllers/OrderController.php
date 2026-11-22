<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for the authenticated user.
     */
    public function index(Request $request): View
    {
        $orders = $request->user()
            ->orders()
            ->with(['orderDetails.service.category'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created order for the given service.
     */
    public function store(StoreOrderRequest $request, Service $service): RedirectResponse
    {
        $validated = $request->validated();
        $total = $service->harga * $validated['jumlah'];

        // Format nomor pesanan unik: ORD-YYYYMMDD-XXXX
        $nomorPesanan = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        // 1. Simpan Header Transaksi (Order)
        $order = $request->user()->orders()->create([
            'nomor_pesanan' => $nomorPesanan,
            'tanggal' => $validated['tanggal'],
            'alamat' => $validated['alamat'],
            'catatan' => $validated['catatan'] ?? null,
            'status' => 'pending',
            'total' => $total,
        ]);

        // 2. Simpan Detail Transaksi (OrderDetail)
        $order->orderDetails()->create([
            'service_id' => $service->id,
            'jumlah' => $validated['jumlah'],
            'harga_satuan' => $service->harga,
            'subtotal' => $total,
        ]);

        return redirect()
            ->route('orders.my')
            ->with('success', 'Pesanan (' . $nomorPesanan . ') untuk layanan ' . $service->nama . ' berhasil dibuat!');
    }
}
