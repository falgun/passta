<?php

declare(strict_types=1);

namespace Falgun\Passta\Token;

use Falgun\Passta\Random\RandomGeneratorInterface;

final class SplitToken
{
    private const SELECTOR_BYTE_SIZE = 16;
    private const VERIFIER_BYTE_SIZE = 16;

    private function __construct(
        public readonly string $selector,
        public readonly string $verifier,
    ) {
    }

    public static function fromTokenString(string $token): static
    {
        return new static(
            \mb_substr($token, 0, self::SELECTOR_BYTE_SIZE * 2),
            \mb_substr($token, self::SELECTOR_BYTE_SIZE * 2, self::VERIFIER_BYTE_SIZE * 2),
        );
    }

    public static function fromRandomGenerator(RandomGeneratorInterface $randomGenerator): static
    {
        return new static(
            $randomGenerator->generate(self::SELECTOR_BYTE_SIZE),
            $randomGenerator->generate(self::VERIFIER_BYTE_SIZE),
        );
    }

    public function toString(): string
    {
        return $this->selector . $this->verifier;
    }
}
