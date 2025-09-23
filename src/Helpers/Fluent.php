<?php

namespace KirschbaumDevelopment\NovaInlineRelationship\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Fluent extends \Illuminate\Support\Fluent
{
    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     *
     * @return $this
     */
    public function fill($attributes)
    {
        // Ensure attributes is an array for Laravel 12 compatibility
        if (!is_array($attributes)) {
            $attributes = (array) $attributes;
        }
        
        foreach ($attributes as $key => $value) {
            $attribute = Str::replace('->', '.', $key);

            if (! Arr::has($this->attributes, $attribute)) {
                Arr::set($this->attributes, $attribute, $value);
            }
        }

        return $this;
    }

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     *
     * @return $this
     */
    public function forceFill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $attribute = Str::replace('->', '.', $key);

            Arr::set($this->attributes, $attribute, $value);
        }

        return $this;
    }
}
