<?php

namespace Tests\Unit;

use App\Services\CalculatorService;
use App\Services\CalculatorServiceInterface;
use InvalidArgumentException;
use Tests\TestCase;

class CalculatorServiceTest extends TestCase
{
    private CalculatorService $calculatorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculatorService = new CalculatorService();
    }

    public function test_can_add_two_numbers(): void
    {
        $this->assertEquals(5, $this->calculatorService->add(2, 3));
        $this->assertEquals(-1, $this->calculatorService->add(2, -3));
        $this->assertEquals(0, $this->calculatorService->add(0, 0));
        $this->assertEquals(5.5, $this->calculatorService->add(2.5, 3));
    }

    public function test_can_subtract_two_numbers(): void
    {
        $this->assertEquals(-1, $this->calculatorService->subtract(2, 3));
        $this->assertEquals(5, $this->calculatorService->subtract(2, -3));
        $this->assertEquals(0, $this->calculatorService->subtract(0, 0));
        $this->assertEquals(-0.5, $this->calculatorService->subtract(2.5, 3));
    }

    public function test_can_multiply_two_numbers(): void
    {
        $this->assertEquals(6, $this->calculatorService->multiply(2, 3));
        $this->assertEquals(-6, $this->calculatorService->multiply(2, -3));
        $this->assertEquals(0, $this->calculatorService->multiply(2, 0));
        $this->assertEquals(7.5, $this->calculatorService->multiply(2.5, 3));
    }

    public function test_can_divide_two_numbers(): void
    {
        $this->assertEquals(2, $this->calculatorService->divide(6, 3));
        $this->assertEquals(-2, $this->calculatorService->divide(6, -3));
        $this->assertEquals(0, $this->calculatorService->divide(0, 5));
        $this->assertEquals(2.5, $this->calculatorService->divide(5, 2));
    }

    public function test_division_by_zero_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by zero is not allowed.');

        $this->calculatorService->divide(5, 0);
    }

    public function test_service_is_bound_in_container(): void
    {
        $service = $this->app->make(CalculatorServiceInterface::class);
        $this->assertInstanceOf(CalculatorService::class, $service);
    }
}
