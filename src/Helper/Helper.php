<?php

namespace Tyler36\laravelHelpers;

use Illuminate\Support\Facades\Validator;

/**
 * Class Helper
 *
 * @package tyler36\HelperMacros
 */
class Helper
{
    /**
     * Validate some data.
     * Inspired by: https://murze.be/2015/11/validate-almost-anything-in-laravel/
     *
     * @param string|array $fields
     * @param string|array $rules
     * @return bool
     */
    public static function validate($fields, $rules)
    {
        if (!is_array($fields)) {
            $fields = ['default' => $fields];
        }

        if (!is_array($rules)) {
            $rules = ['default' => $rules];
        }

        return !Validator::make($fields, $rules)->fails();
    }
}
