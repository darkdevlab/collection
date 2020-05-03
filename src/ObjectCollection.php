<?php

declare(strict_types=1);

namespace DarkDevLab\Collection;

class ObjectCollection extends Collection
{
    public function addItem(object $value): self
    {
        return parent::add($value);
    }
}
