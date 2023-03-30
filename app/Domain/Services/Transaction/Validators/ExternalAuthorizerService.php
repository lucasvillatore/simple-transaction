<?php

namespace App\Domain\Services\Transaction\Validators;

use Illuminate\Support\Facades\Http;

class ExternalAuthorizerService
{
    private $url;
    
    public function __construct($url)
    {
        $this->url = $url ?? env('EXTERNAL_AUTHORIZER_URL');
    }

    public function verifyExternalAuthorizer()
    {
        $response = Http::timeout(10)
                        ->post($this->url);

        return $response->successful();
    }
}