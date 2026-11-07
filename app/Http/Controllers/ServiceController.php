<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services grouped by category on the home page.
     */
    public function index(): View
    {
        $servicesByCategory = \Illuminate\Support\Facades\Schema::hasTable('services')
            ? Service::all()->groupBy('kategori')
            : collect();

        return view('welcome', compact('servicesByCategory'));
    }

    /**
     * Display the specified service detail page with order form.
     */
    public function show(Service $service): View
    {
        return view('services.show', compact('service'));
    }
}
