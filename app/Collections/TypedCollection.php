<?php

namespace App\Collections;

use TypeError;
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
            $this->checkType($item);
        }
    }

    protected function checkType($item): void
    {
        if ((class_exists($this->type) || interface_exists($this->type)) && !is_a($item, $this->type)) {
            throw new TypeError("This collection can only contain instances of {$this->type}");
        } elseif (gettype($item) !== $this->type) {
            throw new TypeError("This collection can only contain values of type {$this->type}");
        }
    }

    public function offsetSet($key, $value): void
    {
        $this->checkType($value);
        parent::offsetSet($key, $value);
    }

    public function push(...$values): self
    {
        foreach ($values as $value) {
            $this->checkType($value);
            parent::push($value);
        }

        return $this;
    }

    public function prepend($value, $key = null): self
    {
        $this->checkType($value);
        return parent::prepend($value, $key);
    }

    public function put($key, $value): self
    {
        $this->checkType($value);
        return parent::put($key, $value);
    }
}
