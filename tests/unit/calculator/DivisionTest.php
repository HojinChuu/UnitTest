<?php

class DivisionTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function divides_given_operands()
    {
        $division = new \App\Calculator\Division;

        $division->setOperands([100, 10]);

        $this->assertEquals(10, $division->calculate());
    }

    /** @test */
    public function no_operands_given_throws_exception_when_calculating()
    {
        $this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

        $division = new \App\Calculator\Division;
        $division->calculate();
    }

    /** @test */
    public function removes_division_by_zero_operands()
    {
        $division = new \App\Calculator\Division;
        
        $division->setOperands([100, 0, 10]);

        $this->assertEquals(10, $division->calculate());
    }
}