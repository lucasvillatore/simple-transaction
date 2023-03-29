<?php

namespace App\Domain\Services\Transaction\Validators;

use Exception;
use Illuminate\Support\Facades\Http;

class ExternalAuthorizerService
{
    private $url;
    
    public function __construct($url = null)
    {
        $this->url = $url ?: env("EXTERNAL_AUTHORIZER_URL");
    }

    public function verifyExternalAuthorizer()
    {
        $response = Http::timeout(10)
                        ->post($this->url);
        // dd("oi");
        return $response->successful();
    }
}