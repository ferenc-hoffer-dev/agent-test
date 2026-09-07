<?php

namespace App\Services;

use InvalidArgumentException;

readonly class CalculatorService implements CalculatorServiceInterface
{
    public function add(float|int $a, float|int $b): float|int
    {
        return $a + $b;
    }

    public function subtract(float|int $a, float|int $b): float|int
    {
        return $a - $b;
    }

    public function multiply(float|int $a, float|int $b): float|int
    {
        return $a * $b;
    }

    public function divide(float|int $a, float|int $b): float|int
    {
        if ($b == 0) {
            throw new InvalidArgumentException('Division by zero is not allowed.');
        }

        return $a / $b;
    }
}
