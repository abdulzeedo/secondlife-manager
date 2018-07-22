<?php
namespace CakeApiBaselayer\Lib;

class ApiReturnCode
{
    const SUCCESS = 'success';
    const NOT_AUTHENTICATED = 'not_authenticated';
    const INVALID_PARAMS = 'invalid_params';
    const INVALID_CREDENTIALS = 'invalid_credentials';
    const NOT_AUTHORIZED = 'not_authorized';
    const FORBIDDEN = 'forbidden';
    const VALIDATION_FAILED = 'validation_failed';
    const NOT_FOUND = 'not_found';
    const INTERNAL_ERROR = 'internal_error';

    /**
     * Maps return codes to HTTP Status Codes
     *
     * @return array
     */
    public static function getStatusCodeMapping()
    {
        return [
            self::SUCCESS => 200,
            self::NOT_AUTHENTICATED => 401,
            self::INVALID_CREDENTIALS => 401,
            self::INVALID_PARAMS => 400,
            self::NOT_AUTHORIZED => 403,
            self::FORBIDDEN => 403,
            self::NOT_FOUND => 404,
            self::VALIDATION_FAILED => 400,
            self::INTERNAL_ERROR => 500
        ];
    }
}
