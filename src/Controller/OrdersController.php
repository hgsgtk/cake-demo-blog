<?php
declare(strict_types=1);


namespace App\Controller;


use Cake\Http\Exception\MethodNotAllowedException;

/**
 * @property \Cake\Datasource\RepositoryInterface|null Orders
 */
final class OrdersController extends AppController
{
    public function charge()
    {
        $userId = $this->Auth->user('id');

        if ($this->request->is('post')) {
            // Handle POST request
            $postData = $this->request->getData();

            // Calculate order total amount
            $order = $postData['Order'];
            $orderItems = $order['OrderItem'];
            $shippingFee = $order['shippingFee'];
            $totalOrderAmount = 0;
            foreach ($orderItems as $orderItem) {
                $totalOrderAmount += $orderItem['amount'] + $orderItem['tax'];
            }
            $totalOrderAmount += $shippingFee;

            // Save Order
            $saveOrder = [
                'user_id' => $userId,
                'total_amount' => $totalOrderAmount,
                // something...
            ];
            if ($this->Orders->save($saveOrder)) {
                // Error Handling
            }

            // Send charge request to external payment service

            // Redirecting
            return $this->redirect(['action' => 'index']);

        } else if ($this->request->is('get')) {
            // Handle GET request
            // ... Prepare a lot of view variables
            $cart = [
                // something
            ];
            $this->set('cart', $cart);
        } else {
            throw new MethodNotAllowedException();
        }
    }
}
