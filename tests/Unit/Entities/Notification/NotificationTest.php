<?php

namespace Tests\Unit\Entities\Notification;

use App\Domain\Entities\Notification\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    public function test_Notification()
    {
        $data = [
            'id' => 1,
            'message' => 'mensagem',
            'status' => 'status',
            'userId' => 1,
    ];

    $user = new Notification($data);
    
    $this->assertEquals($data, $user->toArray());
}
}
