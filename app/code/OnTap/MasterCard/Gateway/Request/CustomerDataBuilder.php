<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace OnTap\MasterCard\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Payment\Gateway\Helper\SubjectReader;

class CustomerDataBuilder implements BuilderInterface
{
    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        $paymentDO = SubjectReader::readPayment($buildSubject);

        $order = $paymentDO->getOrder();
        $billingAddress = $order->getBillingAddress();

        if ($billingAddress === null) {
            return [];
        }

        return [
            'customer' => [
                'email' => $billingAddress->getEmail(),
                'firstName' => $billingAddress->getFirstname(),
                'lastName' => $billingAddress->getLastname(),
                'phone' => $billingAddress->getTelephone()
            ]
        ];
    }
}