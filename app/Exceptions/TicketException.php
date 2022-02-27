<?php

namespace App\Exceptions;

use App\Constants\ExceptionConstant;
use Throwable;

/**
 * Class AddressException
 *
 * @package App\Exceptions
 */
class TicketException extends BaseException
{
    private $errorConfig = [
        '20001' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '取票失敗，請重試',
            'sentry'  => false,
        ],
        '20002' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '票卷數量已不足',
            'sentry'  => false,
        ],
        '20003' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '請勿短時間傳送大量相同請求',
            'sentry'  => false,
        ]
    ];

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setErrorConfig($this->errorConfig);
    }
}
