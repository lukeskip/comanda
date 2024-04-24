<?php
namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class Utils 
{
    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }

    public static function formatDate($date){
        return Carbon::parse($date)->translatedFormat('D d/m Y');
    }

  
}