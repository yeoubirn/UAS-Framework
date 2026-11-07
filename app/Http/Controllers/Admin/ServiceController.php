<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $services = Service::latest()->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = [
            'Rental Proyektor',
            'Pasang CCTV',
            'WiFi dan Jaringan',
        ];

        return view('admin.services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        Service::create($request->validated());

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service): RedirectResponse
    {
        return redirect()->route('admin.services.edit', $service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): View
    {
        $categories = [
            'Rental Proyektor',
            'Pasang CCTV',
            'WiFi dan Jaringan',
        ];

        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $service->update($request->validated());

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
