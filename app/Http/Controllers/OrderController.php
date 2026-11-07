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
            ->with('service')
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

        $request->user()->orders()->create([
            'service_id' => $service->id,
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'alamat' => $validated['alamat'],
            'catatan' => $validated['catatan'] ?? null,
            'status' => 'pending',
            'total' => $total,
        ]);

        return redirect()
            ->route('orders.my')
            ->with('success', 'Pesanan untuk ' . $service->nama . ' berhasil dibuat!');
    }
}
