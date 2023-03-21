<?php

namespace Domain\Traits;

use Illuminate\Support\Str;

trait GenerateUrlUuid
{
    public function getUrlName()
    {
        return property_exists($this, 'urlName') ? $this->urlName : 'url';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
        
            $model->{$model->getUrlName()} = Str::uuid()->toString();
        });
    }
}
