<?php namespace Octobro\DebugPay;

use Backend;
use System\Classes\PluginBase;

/**
 * DebugPay Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['Responsiv.Pay'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'DebugPay',
            'description' => 'Plugin for debugging payment on Responsiv.Pay.',
            'author'      => 'Octobro',
            'icon'        => 'icon-flash'
        ];
    }

    /**
     * Registers any payment gateways implemented in this plugin.
     * The gateways must be returned in the following format:
     * ['className1' => 'alias'],
     * ['className2' => 'anotherAlias']
     */
    public function registerPaymentGateways()
    {
        return [
            'Octobro\DebugPay\PaymentTypes\DebugPay' => 'DebugPay',
        ];
    }
}
