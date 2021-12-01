<?php

declare(strict_types=1);

namespace Falgun\Passta\Token;

use Falgun\Passta\Hash\HashDriverInterface;

final class Token
{
    private function __construct(
        public readonly string $selector,
        public readonly string $verifierHash,
        public readonly string $token,
    ) {
    }

    public static function fromSplitToken(SplitToken $splitToken, HashDriverInterface $hashDriver): static
    {
        return new static(
            $splitToken->selector,
            $hashDriver->hash($splitToken->verifier),
            $splitToken->toString(),
        );
    }
}
