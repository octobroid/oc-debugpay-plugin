<?php namespace Octobro\DebugPay\PaymentTypes;

use Redirect;
use ApplicationException;
use Responsiv\Pay\Classes\GatewayBase;

class DebugPay extends GatewayBase
{

    /**
     * {@inheritDoc}
     */
    public function gatewayDetails()
    {
        return [
            'name'        => 'DebugPay',
            'description' => 'DebugPay payment method from DebugPay.'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function defineFormFields()
    {
        return 'fields.yaml';
    }

    /**
     * {@inheritDoc}
     */
    public function processPaymentForm($data, $invoice)
    {
        $status = array_get($data, 'status');

        switch ($status) {
            case 'success':
                $invoice->logPaymentAttempt('Successful payment', 1, [], null, null);
                $invoice->markAsPaymentProcessed();
                $invoice->updateInvoiceStatus('paid');
                return Redirect::to($invoice->getReceiptUrl())->with('success', true);
            case 'error':
                $invoice->logPaymentAttempt('Unsuccessful payment', 0, [], null, null);
                return Redirect::to($invoice->getReceiptUrl())->with('error', true);
        }

        return Redirect::to($invoice->getReceiptUrl());
    }
}
