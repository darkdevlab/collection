<?php

declare(strict_types=1);

namespace DarkDevLab\Collection;

class StringCollection extends Collection
{
    public function addItem(string $value): self
    {
        return parent::add($value);
    }
}
