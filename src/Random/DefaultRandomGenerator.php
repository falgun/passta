<?php

declare(strict_types=1);

namespace Falgun\Passta\Random;

final class DefaultRandomGenerator implements RandomGeneratorInterface
{
    public function generate(int $bytes): string
    {
        return \bin2hex(\random_bytes($bytes));
    }
}
