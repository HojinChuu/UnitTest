<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException;

class Division extends OperationAbstract implements OperationInterface
{
    public function calculate()
    {
        if (count($this->operands) === 0) {
            throw new NoOperandsException;
        }

        // $result = 0;

        // foreach ($this->operands as $index => $operand) {
        //     if ($index === 0) {
        //         $result = $operand;
        //         continue;
        //     }

        //     $result /= $operand;
        // }

        // return $result;

        return array_reduce(array_filter($this->operands), function($a, $b) {
            if ($a !== null && $b !== null) {
                return $a / $b;
            }
            return $b;
        }, null);
    }
}