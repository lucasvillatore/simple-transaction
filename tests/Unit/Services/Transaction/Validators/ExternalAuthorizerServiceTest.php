<?php

namespace Tests\Unit\Services\Transaction\Validators;

use App\Domain\Services\Transaction\Validators\ExternalAuthorizerService;
use PHPUnit\Framework\TestCase;

class ExternalAuthorizerServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_verifyExternalAuthorizer(): void
    {
        $service = new ExternalAuthorizerService(env("EXTERNAL_AUTHORIZER_URL"));

        $response = $service->verifyExternalAuthorizer();

        $this->assertEquals($response, true);
    }
}
