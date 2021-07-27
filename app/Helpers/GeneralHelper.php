<?php

if (!function_exists('prod_env')) {
    function prod_env(): bool {
        $production_environment = 'PRODUCTION'; // DEVNOTE: Please match with APP_ENV in production
        $environment = \Illuminate\Support\Facades\App::environment();

        if ($environment !== $production_environment) {
            return false;
        }
        return true;
    }
}

if (!function_exists('json_response')) {
    function json_response($type = null, $message = null, $code = null, $additionalParams = [])
    {
        $data = [
            'type' => $type,
            'message' => $message,
        ];

        return response()->json($data + $additionalParams, $code);
    }
}

if (!function_exists('validation_error')) {
    function validation_error($errors) {
       if (!empty($errors)) {
            return response()->json(['errors' => $errors], 422);
       }
    }
}

if (!function_exists('json_exception')) {
    function json_exception($exception, $status = 400)
    {
        $msg = prod_env() ? trans('general.message.global-error') : $exception->getMessage();
        return json_response('error', $msg, $status);
    }
}


if (!function_exists('slugify')) {
    function slugify(string $string, string $delimiter = '-'): string {
        return strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $string))))), $delimiter));
    }
}

if (!function_exists('conv_date')) {
    function conv_date($date): ?string {
        if($date !== null) {
            return $date->isoFormat('DD MMM YYYY HH:mm:ss');
        }
        return null;
    }
}

if (!function_exists('currency')) {
    function currency($number, $with_sign = false, $decimal = 0): ?string {
        if ($number !== null) {
            if ($with_sign) {
                return 'BND '.number_format($number, $decimal, ',', '.');
            } else {
                return number_format($number, $decimal, ',', '.');
            }
        }
        return null;
    }
}
