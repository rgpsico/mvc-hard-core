<?php

namespace app\core\exception;

class ForbiddenException extends  \Exception
{
    protected $message = 'you dont have permissions';
    protected $code = 403;
}
