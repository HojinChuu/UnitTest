<?php

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function can_set_single_operation()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([40, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);

        $this->assertCount(1, $calculator->getOperations());
    }

    /** @test */
    public function can_set_muliple_operation()
    {
        $addition1 = new \App\Calculator\Addition;
        $addition1->setOperands([40, 10]);

        $addition2 = new \App\Calculator\Addition;
        $addition2->setOperands([90, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition1, $addition2]);

        $this->assertCount(2, $calculator->getOperations());
    }

    /** @test */
    public function operations_are_ignored_if_not_instance_of_operation_interface()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([40, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, 'Hojin', 'Jueun']);

        $this->assertCount(1, $calculator->getOperations());
    }

    /** @test */
    public function can_calculate_result()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([40, 10]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);

        $this->assertEquals(50, $calculator->calculate());
    }

    /** @test */
    public function calculate_method_returns_multiple_results()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([40, 10]); // 50

        $division = new \App\Calculator\Division;
        $division->setOperands([90, 10]); // 9

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, $division]);

        $this->assertIsArray($calculator->calculate());
        $this->assertEquals(50, $calculator->calculate()[0]);
        $this->assertEquals(9, $calculator->calculate()[1]);
    }
}