<?php
declare(strict_types=1);


namespace App\Service;


use App\Lib\Payment\CardCharger;

final class OrderCharge extends AppService
{
    /**
     * @var CardCharger
     */
    private $charger;

    /**
     * OrderCharge constructor.
     * @param CardCharger $charger
     */
    public function __construct(CardCharger $charger)
    {
        parent::__construct();

        $this->charger = $charger;
    }

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
        if (!$this->charger->send($charge)) {
            // Rollback transaction
            return false;
        }

        // Commit transaction
        return true;
    }
}
