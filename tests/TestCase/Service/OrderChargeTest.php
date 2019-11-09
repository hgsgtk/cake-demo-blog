<?php
declare(strict_types=1);

namespace App\Test\TestCase\Service;

use App\Service\OrderCharge;
use Cake\TestSuite\TestCase;

final class OrderChargeTest extends TestCase
{
    public function testChargeValidOrder(): void
    {
        // arrange
        $sut = new OrderCharge();
        $customerId = 1;
        $purchaseAmount = 100000;

        // act
        $actual = $sut->execute($customerId, $purchaseAmount);

        // assertion
        $this->assertTrue($actual);
    }

}
