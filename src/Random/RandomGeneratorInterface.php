<?php

declare(strict_types=1);

namespace Falgun\Passta\Random;

interface RandomGeneratorInterface
{
    public function generate(int $bytes): string;
}
