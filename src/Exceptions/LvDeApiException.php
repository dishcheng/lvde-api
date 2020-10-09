<?php

namespace DishCheng\LvDeApi\Exceptions;

use Exception;
use Throwable;

class LvDeApiException extends Exception
{
    public function __construct($message="", $code=0, Throwable $previous=null)
    {
        parent::__construct($message.'[LD-'.$code.']', $code, $previous);
    }
}
