<?php
declare(strict_types=1);


namespace App\Service;


use App\Lib\Payment\CardCharger;

final class OrderCharge extends AppService
{
    public function execute(array $customer, int $purchaseAmount): bool
    {
        // Start transaction
        // ...
        // Save transaction

        // Send a charge request to external payment service
        $charge = [
            'customer' => $customer,
            'purchaseAmount' => $purchaseAmount,
            // ...
        ];
        $charger = new CardCharger();
        if (!$charger->send($charge)) {
            // Rollback transaction
        }

        // Commit transaction
    }
}
