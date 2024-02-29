<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    protected static function boot()
    {
        parent::_boot_();

        static::_creating_(function ($model) {
            try {
                $model->id = (string) Str::_uuid_(); 
                // Change id with your primary key
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}