<?php

namespace App\Services;

interface CalculatorServiceInterface
{
    public function add(float|int $a, float|int $b): float|int;
    public function subtract(float|int $a, float|int $b): float|int;
    public function multiply(float|int $a, float|int $b): float|int;
    public function divide(float|int $a, float|int $b): float|int;
}
