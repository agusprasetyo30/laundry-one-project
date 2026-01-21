<?php

namespace App\Services;

use App\Models\AdditionalLogic;
use Carbon\Carbon;

class PromoService
{
    /**
     * Get the expiration time for the promo.
     */
    public function getPromoExpiration(): array
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

                $expirePromo = [
                    'days' => intdiv($totalSeconds, 86400),
                    'hours' => intdiv($totalSeconds % 86400, 3600),
                    'minutes' => intdiv($totalSeconds % 3600, 60),
                    'seconds' => $totalSeconds % 60,
                ];
            }
        }

        return $expirePromo;
    }
}
