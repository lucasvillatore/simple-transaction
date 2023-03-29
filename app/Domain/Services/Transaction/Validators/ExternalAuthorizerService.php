<?php

namespace App\Domain\Services\Transaction\Validators;

use Illuminate\Support\Facades\Http;

class ExternalAuthorizerService
{
    private $url;
    
    public function __construct($url = "")
    {
        $this->url = $url;
    }

    public function verifyExternalAuthorizer()
    {
        return true;
        //todo colocar timeout e validar 
        //tb fazer a notificação
        $response = Http::timeout(10)
                        ->post($this->url);

        return $response->successful();
    }
}