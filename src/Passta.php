<?php

declare(strict_types=1);

namespace Falgun\Passta;

use Falgun\Passta\Token\Token;
use Falgun\Passta\Token\SplitToken;
use Falgun\Passta\Hash\HashDriverInterface;
use Falgun\Passta\Random\RandomGeneratorInterface;

final class Passta
{
    public function __construct(
        private HashDriverInterface $hashDriver,
        private RandomGeneratorInterface $randomGenerator,
    ) {
    }

    public function generate(): Token
    {
        $splitToken = SplitToken::fromRandomGenerator($this->randomGenerator);

        return Token::fromSplitToken($splitToken, $this->hashDriver);
    }

    public function convertToSplitToken(string $token): SplitToken
    {
        return SplitToken::fromTokenString($token);
    }

    public function verify(SplitToken $splitToken, string $hashedVerifier): bool
    {
        return $this->hashDriver->verify($hashedVerifier, $splitToken->verifier);
    }
}
