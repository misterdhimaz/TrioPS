<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanSubscription;
use App\Models\PricingPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlanSubscriptionController extends Controller
{
    // Menyimpan pesanan paket VIP
    public function store(Request $request)
    {
        $request->validate([
            'pricing_plan_id' => 'required|exists:pricing_plans,id',
            'start_date' => 'required|date|after_or_equal:today',
        ]);

        $plan = PricingPlan::findOrFail($request->pricing_plan_id);

        PlanSubscription::create([
            'user_id' => Auth::id(),
            'pricing_plan_id' => $plan->id,
            'start_date' => $request->start_date,
            'price_snapshot' => $plan->price, // Kunci harganya
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Paket VIP berhasil dipesan! Silakan upload bukti pembayaran.');
    }

    // Mengunggah bukti pembayaran paket VIP
    public function uploadPayment(Request $request, PlanSubscription $subscription)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            if ($subscription->payment_proof) {
                Storage::disk('public')->delete($subscription->payment_proof);
            }

            $path = $request->file('payment_proof')->store('payments/vip', 'public');

            $subscription->update([
                'payment_proof' => $path,
                'status' => 'Pending'
            ]);
        }

        return back()->with('success', 'Bukti pembayaran VIP diterima. Tim kami sedang memverifikasi.');
    }

    // Batalkan pesanan paket
    public function destroy(PlanSubscription $subscription)
    {
        if ($subscription->payment_proof) {
            Storage::disk('public')->delete($subscription->payment_proof);
        }
        $subscription->delete();

        return back()->with('success', 'Pesanan paket VIP berhasil dibatalkan.');
    }

    public function vipReceipt($id)
{
    $vip = \App\Models\PlanSubscription::with(['user', 'pricingPlan'])->findOrFail($id);

    // Keamanan
    if (auth()->user()->is_admin !== 1 && auth()->id() !== $vip->user_id) {
        abort(403, 'Akses Ditolak.');
    }

    // Validasi
    if (!in_array(strtolower($vip->status), ['active', 'completed'])) {
        abort(404, 'Nota Belum Tersedia.');
    }

    return view('pages.vip-receipt', compact('vip'));
}
}
