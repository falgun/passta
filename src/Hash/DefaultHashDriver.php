<?php

declare(strict_types=1);

namespace Falgun\Passta\Hash;

final class DefaultHashDriver implements HashDriverInterface
{
    public function hash(string $string): string
    {
        return \hash('sha256', $string, false);
    }

    public function verify(string $hash, string $input): bool
    {
        return \hash_equals($hash, $this->hash($input));
    }
}
