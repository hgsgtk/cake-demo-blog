<?php
declare(strict_types=1);

namespace App\Test\TestCase\Service;

use App\Lib\Payment\CardCharger;
use App\Service\OrderCharge;
use Cake\TestSuite\TestCase;

final class OrderChargeTest extends TestCase
{
    public function testChargeValidOrder(): void
    {
        // arrange
        $customer = [
            'id' => 1
        ];
        $purchaseAmount = 100000;

        $mock = $this->getMockBuilder(CardCharger::class)
            ->onlyMethods(['send'])
            ->getMock();
        $mock->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo([
                    'customer' => $customer,
                    'purchaseAmount' => $purchaseAmount
                ])
            )->willReturn(true);

        $sut = new OrderCharge($mock);

        // act
        $actual = $sut->execute($customer, $purchaseAmount);

        // assertion
        $this->assertTrue($actual);
    }
}
