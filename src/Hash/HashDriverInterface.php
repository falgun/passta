<?php

declare(strict_types=1);

namespace Falgun\Passta\Hash;

interface HashDriverInterface
{
    public function hash(string $string): string;

    public function verify(string $hash, string $input): bool;
}
