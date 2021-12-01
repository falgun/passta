<?php

declare(strict_types=1);

namespace Falgun\Passta\Tests\Unit\Hash;

use PHPUnit\Framework\TestCase;
use Falgun\Passta\Hash\DefaultHashDriver;
use Falgun\Passta\Hash\HashDriverInterface;

final class HashDriverTest extends TestCase
{
    public function test_default_hash_driver(): void
    {
        $hashDriver = new DefaultHashDriver();

        $hash = $hashDriver->hash('some text');

        $this->assertTrue($hashDriver->verify($hash, 'some text'));
    }
}
