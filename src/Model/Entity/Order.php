<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Order
 * @package App\Model\Entity
 *
 * @property int $shipping_fee
 * @property int $tax
 */
class Order extends Entity
{
    /**
     * @param OrderItem[] $orderItems
     * @return int
     */
    public function getTotalAmount(array $orderItems): int
    {
        $totalOrderAmount = 0;

        $shippingFee = $this->shipping_fee;
        foreach ($orderItems as $orderItem) {
            $totalOrderAmount += $orderItem->amount + $orderItem->tax;
        }
        $totalOrderAmount += $shippingFee;

        return $totalOrderAmount;
    }
}
