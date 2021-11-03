<?php

namespace App\Tests\Unit;

use App\Utils\StateHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class PriceTest
 */
class PriceTest extends TestCase
{

    public function testGetNearestStatus()
    {
        $var = StateHelper::getNearestStatus($this->getData(), 1);

        $this->assertIsInt($var);
        $this->assertSame($var, 5);
    }

    /**
     * @return array
     */
    private function getData()
    {
        return [
            1 => 22.5,
            2 => 50.5,
            5 => 15.20
        ];
    }
}