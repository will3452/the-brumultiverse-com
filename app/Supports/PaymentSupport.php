<?php

namespace App\Supports;

use App\Helpers\MarketingHelper;
use Illuminate\Support\Str;

class PaymentSupport
{
    const SEPARATOR = '-';
    const DIVIDER = '*___*';


    //return string
    public static function getURL($parameters)
    {
        $url = 'http://test.dragonpay.ph/Pay.aspx?';
        if (config('dragonpay.environment') == 1) {
            return 'https://gw.dragonpay.ph/Pay.aspx?';
        }

        $url .= http_build_query($parameters, '', '&');

        return $url; //redirect
    }


    //return string
    public static function generateTransactionId()
    {
        return "BRU" . time() . Str::random(6);
    }

    //return array
    public static function createParameters($amount, $ccy='PHP', $description, $email)
    {
        return [
            'merchantid'=>config('payment.merchant_id'),
            'txnid'=>self::generateTransactionId(),
            'amount'=>number_format($amount, 2, '.', ''),
            'ccy'=>$ccy,
            'description'=>$description,
            'email'=>$email
        ];
    }

    //to set digest, return new paramaters
    public static function getDigestString($parameters)
    {
        $parameters['key'] = config('payment.merchant_password');
        $digestStr = implode(':', $parameters);
        unset($parameters['key']); // unset the key
        $parameters['digest'] = sha1($digestStr);

        return $parameters;
    }
}
