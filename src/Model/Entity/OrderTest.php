<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\TestSuite\TestCase;

final class OrderTest extends TestCase
{
    /**
     * @dataProvider providerGetTotalAmount
     *
     * @param OrderItem[] $orderItems
     * @param int $shippingFee
     * @param int $expected
     */
    public function testGetTotalAmount(array $orderItems, int $shippingFee, int $expected): void
    {
        // arrange
        $sut = new Order([
            'shipping_fee' => $shippingFee
        ]);

        // act
        $actual = $sut->getTotalAmount($orderItems);

        // assertion
        $this->assertSame($expected, $actual);
    }

    public function providerGetTotalAmount(): array
    {
        return [
            'Single Item' => [
               [
                    new OrderItem([
                        'amount' => 10000,
                        'tax' => 100
                    ])
                ],
                100,
                10200,
            ],
            // something
        ];
    }
}
