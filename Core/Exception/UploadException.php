<?php

namespace Rave\Core\Exception;

class UploadException extends \Exception
{
    const ERROR_CODE = 4;

    public function __construct($message)
    {
        parent::__construct($message, self::ERROR_CODE);
    }

}