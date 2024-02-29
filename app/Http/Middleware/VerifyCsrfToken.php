<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'blog/insert_category',
        'master/financial_statement/item/getParentCode',
        'card/emiten/get_city_from_province',
        'card/emiten/get_district_from_city',
        'card/emiten/get_ward_from_district',
        'global/*',
    ];
}
