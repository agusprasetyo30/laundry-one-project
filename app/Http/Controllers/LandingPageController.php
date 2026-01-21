<?php

namespace App\Http\Controllers;

use App\Models\AdditionalLogic;
use App\Services\PromoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    protected $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    public function index()
    {
        $expirePromo = $this->promoService->getPromoExpiration();

        return view('landing-page.index', compact('expirePromo'));
    }
}
