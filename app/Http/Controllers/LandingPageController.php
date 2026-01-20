<?php

namespace App\Http\Controllers;

use App\Models\AdditionalLogic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $getExpiredPromodate = AdditionalLogic::where('module_name', 'promo')
            ->where('param_name', 'expired_promo_date')
            ->first();

        $now = Carbon::now();
        $expirePromo = [
            'days' => 0,
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0,
        ];

        if ($getExpiredPromodate && $getExpiredPromodate->attr1_val) {
            try {
                $expiresAt = Carbon::parse($getExpiredPromodate->attr1_val);
            } catch (\Exception $e) {
                $expiresAt = null;
            }

            if ($expiresAt && $expiresAt->greaterThan($now)) {
                $totalSeconds = max(0, $expiresAt->getTimestamp() - $now->getTimestamp());
                $days = intdiv($totalSeconds, 86400);
                $hours = intdiv($totalSeconds % 86400, 3600);
                $minutes = intdiv($totalSeconds % 3600, 60);
                $seconds = $totalSeconds % 60;

                $expirePromo = compact('days', 'hours', 'minutes', 'seconds');
            }
        }

        return view('landing-page.index', compact('expirePromo'));
    }
}
