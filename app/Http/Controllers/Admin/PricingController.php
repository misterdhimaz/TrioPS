<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $pricing_plans = PricingPlan::latest()->get();
        return view('admin.pricing.index', compact('pricing_plans'));
    }

    public function create()
    {
        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_text' => 'required|string|max:255',
            'features' => 'required|string', // Admin bisa menginput fitur dipisah koma atau enter
            'color_theme' => 'required|string|max:255', // purple, cyan, amber
        ]);

        PricingPlan::create($validated);

        return redirect()->route('pricing.index')->with('success', 'Paket harga berhasil ditambahkan!');
    }

    public function edit(PricingPlan $pricing)
    {
        return view('admin.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, PricingPlan $pricing)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_text' => 'required|string|max:255',
            'features' => 'required|string',
            'color_theme' => 'required|string|max:255',
        ]);

        $pricing->update($validated);

        return redirect()->route('pricing.index')->with('success', 'Paket harga berhasil diperbarui!');
    }

    public function destroy(PricingPlan $pricing)
    {
        $pricing->delete();

        return redirect()->route('pricing.index')->with('success', 'Paket harga berhasil dihapus!');
    }
}
