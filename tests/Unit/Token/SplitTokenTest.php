<?php

declare(strict_types=1);

namespace Falgun\Passta\Tests\Unit\Token;

use PHPUnit\Framework\TestCase;
use Falgun\Passta\Token\SplitToken;
use Falgun\Passta\Random\DefaultRandomGenerator;
use Falgun\Passta\Random\RandomGeneratorInterface;

final class SplitTokenTest extends TestCase
{
    public function test_static_factory_with_small_token(): void
    {
        $splitToken = SplitToken::fromTokenString('small_token');

        $this->assertSame('small_token', $splitToken->selector);
        $this->assertSame('', $splitToken->verifier);
    }

    public function test_to_string_returns_both_selector_verifier(): void
    {
        $randomString = (new DefaultRandomGenerator())->generate(32);

        $splitToken = SplitToken::fromTokenString($randomString);

        $this->assertSame($randomString, $splitToken->toString());
    }

    public function test_aa(): void
    {
        $fakeRandomString = \bin2hex(\random_bytes(16));

        $randomGenerator = $this->getMockBuilder(RandomGeneratorInterface::class)
            ->getMock();

        $randomGenerator
            ->method('generate')
            ->willReturn($fakeRandomString);

        $splitToken = SplitToken::fromRandomGenerator($randomGenerator);

        $this->assertSame($fakeRandomString . $fakeRandomString, $splitToken->toString());
    }
}
