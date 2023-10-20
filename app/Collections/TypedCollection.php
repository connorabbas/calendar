<?php

namespace App\Collections;

use InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * Or just use https://github.com/henzeb/laravel-typed-collection/tree/master
 */
abstract class TypedCollection extends Collection
{
    protected string $type;

    public function __construct($items = [])
    {
        parent::__construct($items);
        
        if (!$this->type) {
            throw new InvalidArgumentException("Type not specified for TypedCollection");
        }

        foreach ($this->items as $item) {
            if (!is_a($item, $this->type)) {
                throw new InvalidArgumentException("This collection can only contain instances of {$this->type}");
            }
        }
    }

    /**
     * Override collection method to ensure the type
     */
    public function push(...$values)
    {
        foreach ($values as $value) {
            if (!is_a($value, $this->type)) {
                throw new InvalidArgumentException("This collection can only contain instances of {$this->type}");
            }
            $this->items[] = $value;
        }

        return $this;
    }
}
