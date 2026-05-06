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
        // 1. Validasi semua kolom yang diminta database
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_text' => 'required|string|max:255',
            'color_theme' => 'required|in:purple,cyan,amber',
            'description' => 'nullable|string',
            'features' => 'required|string',
        ]);

        // 2. Ubah text area 'features' menjadi array JSON agar formatnya aman
        $featuresArray = array_filter(array_map('trim', explode("\n", $validated['features'])));
        $validated['features'] = json_encode(array_values($featuresArray));

        // 3. Simpan ke Database
        PricingPlan::create($validated);

        return redirect()->route('pricing.index')->with('success', 'Pricing Plan berhasil di-deploy ke sistem!');
    }

    public function edit($id)
    {
        $pricing = PricingPlan::findOrFail($id);
        return view('admin.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, $id)
    {
        $pricing = PricingPlan::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_text' => 'required|string|max:255',
            'color_theme' => 'required|in:purple,cyan,amber',
            'description' => 'nullable|string',
            'features' => 'required|string',
        ]);

        $featuresArray = array_filter(array_map('trim', explode("\n", $validated['features'])));
        $validated['features'] = json_encode(array_values($featuresArray));

        $pricing->update($validated);

        return redirect()->route('pricing.index')->with('success', 'Konfigurasi Pricing Plan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pricing = PricingPlan::findOrFail($id);
        $pricing->delete();

        return redirect()->route('pricing.index')->with('success', 'Pricing Plan berhasil dihapus dari radar!');
    }
}
