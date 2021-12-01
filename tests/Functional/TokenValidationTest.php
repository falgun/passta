<?php

declare(strict_types=1);

namespace Falgun\Passta\Tests\Functional;

use Falgun\Passta\Passta;
use PHPUnit\Framework\TestCase;
use Falgun\Passta\Token\SplitToken;
use Falgun\Passta\Hash\DefaultHashDriver;
use Falgun\Passta\Random\DefaultRandomGenerator;

final class TokenValidationTest extends TestCase
{
    public function test_generated_token_can_be_validated(): void
    {
        $passta = new Passta(
            new DefaultHashDriver(),
            new DefaultRandomGenerator(),
        );

        $token = $passta->generate();

        $splitToken = $passta->convertToSplitToken($token->token);

        $this->assertSame($token->selector, $splitToken->selector);

        $this->assertTrue($passta->verify($splitToken, $token->verifierHash));
    }

    public function test_invalid_token_can_not_be_validated(): void
    {
        $hashDriver = new DefaultHashDriver();

        $passta = new Passta(
            $hashDriver,
            new DefaultRandomGenerator(),
        );

        $token = $passta->generate();

        $splitToken = $passta->convertToSplitToken($token->token);

        $this->assertFalse($passta->verify($splitToken, $hashDriver->hash('invalid')));
    }
}
