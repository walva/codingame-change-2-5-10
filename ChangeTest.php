<?php

require_once('optimalChange.php');
require_once('Change.php');

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ChangeTest extends TestCase
{
    public static function noOptimalChangePossible(): array
    {
        return [
            [0],
            [1],
            [3]
        ];
    }

    public static function optimalChange(): array
    {
        return [
            [2, [0, 0, 1]],
            [4, [0, 0, 2]],
            [5, [0, 1, 0]],
            [6, [0, 0, 3]],
            [7, [0, 1, 1]],
            [8, [0, 0, 4]],
            [9, [0, 1, 2]],
            [10, [1, 0, 0]],
            [11, [0, 1, 3]],
            [13, [0, 1, 4]],
            [21, [1, 1, 3]],
            [23, [1, 1, 4]],
            [31, [2, 1, 3]],
            [2147483642, [214748364, 0, 1]],
            [2147483643, [214748363, 1, 4]],
            [2147483647, [214748364, 1, 1]],
        ];
    }

    #[DataProvider('noOptimalChangePossible')]
    public function testOptimalChangeShouldReturnNullWhenItIsNotPossibleToGiveOptimalChange(int $required_change)
    {
        // Arrange

        // Act
        $optimal_change = optimalChange($required_change);

        // Assert
        $this->assertNull($optimal_change);
    }

    #[DataProvider('optimalChange')]
    public function testOptimalChangeShouldReturnAChangeObjectWhenItIsPossibleToReceiveChange(int $required_change)
    {
        // Arrange

        // Act
        $optimal_change = optimalChange($required_change);

        // Assert
        $this->assertInstanceOf(Change::class, $optimal_change);
    }

    #[DataProvider('optimalChange')]
    public function testOptimalChangeShouldReturnCorrectChange(
        int $required_change
    ) {
        // Arrange

        // Act
        $optimal_change = optimalChange($required_change);
        $total_change = $optimal_change->bill10 * 10 + $optimal_change->bill5 * 5 + $optimal_change->coin2 * 2;

        // Assert
        $this->assertEquals($required_change, $total_change);
    }

    #[DataProvider('optimalChange')]
    public function testOptimalChangeShouldReturnOptimalChange(
        int $required_change,
        array $expected_amounts,
    ) {
        // Arrange

        // Act
        $optimal_change = optimalChange($required_change);

        // Assert
        $this->assertEquals($expected_amounts[0], $optimal_change->bill10);
        $this->assertEquals($expected_amounts[1], $optimal_change->bill5);
        $this->assertEquals($expected_amounts[2], $optimal_change->coin2);
    }
}
